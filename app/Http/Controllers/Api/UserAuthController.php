<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\otp;
use App\Mail\registerUser;
use App\Mail\VerifyOtpMail;
use App\Mail\welcome;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Mail;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        error_log("Login request: " . json_encode($request->all()));
        // Correct validation rules (do NOT use 'unique' for login)
        $rules = [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => '400',
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Use secure password handling if your passwords are hashed (recommended)
        // If you still use base64 for passwords (not recommended), keep it as-is
        $encodedPassword = base64_encode($request->password);

        $member = DB::table('members')
            ->where('email', $request->email)
            ->where('passwrd', $encodedPassword)
            ->first();

        if (!$member) {
            return response()->json([
                'status' => '400',
                'message' => 'Invalid email or password'
            ], 401); // Unauthorized
        }
        if ($member->status == 0) {
            return response()->json([
                'status' => '400',
                'message' => 'Your account is not activated yet. Please Register Again and verify OTP.'
            ], 401); // Unauthorized
        }

        // Transfer guest cart
        $guest_id = $request->cookie('guest_auth_token') ?? '';
        DB::table('carts')->where('guest_id', $guest_id)->update([
            'user_id' => $member->id
        ]);

        return response()->json([
            'status' => '200',
            'message' => 'Login successful',
            'member' => [
                'id' => $member->id,
                'name' => $member->name,
                'email' => $member->email
            ]
        ], 200);
    }

    public function check($name)
    {
        $firstName = explode(' ', $name)[0];
        $randomNumber = random_int(1000, 9999);
        $mycode = strtolower($firstName) . $randomNumber;
        $checkold = Member::where("affilate_code", $mycode)->first();
        if ($checkold) {
            $this->check($name);
        }
        return $mycode;
    }

    public function register(Request $request)
    {
        // Log the incoming request data
        error_log("Registering: " . json_encode($request->all()));

        // Validation rules
        $rules = [
            'name' => 'required|min:3|max:50',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|string',
            'mobileno' => 'required|string',
        ];

        // Run validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if email already exists
        $existingMember = DB::table('members')->where('email', $request->email)->first();
        error_log("existingMember: " . json_encode($existingMember));

        if ($existingMember) {
            if ($existingMember->status == 1) {
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => [
                        'email' => ["{$request->email} already exists. Please login."]
                    ]
                ], 422);
            } else {
                DB::table('members')->where('email', $request->email)->delete();
            }
        }

        // Secure password hashing — use base64_encode
        $hashedPassword = base64_encode($request->password);

        // Generate affiliate code and OTP
        $code = $this->check($request->name); // Ensure this method exists
        $otp = random_int(1000, 9999);

        // Insert member record
        $memberData = [
            'name' => $request->name,
            'email' => $request->email,
            'otp' => $otp,
            'mobileno' => $request->mobileno,
            'passwrd' => $hashedPassword,
            'gender' => $request->gender,
            'status' => 0,
            'affilate_code' => $code,
            'created_at' => now()
        ];
        error_log("memberData: " . json_encode($memberData));

        $memberId = DB::table('members')->insertGetId($memberData);
        error_log("memberId: " . json_encode($memberId));

        // Load the member model if needed
        $member = Member::find($memberId);
        error_log("New member created: " . json_encode($memberId));

        // TODO: Send email (uncomment in production)

        // Mail::to($email)->send(new otp($otp));
        Mail::to($request->email)->send(new VerifyOtpMail($otp));
        Mail::to('anupkasula012@gmail.com')->send(new registerUser($member));
        error_log("Mail " . json_encode($memberId));

        // Optional: Move guest cart to member
        // if ($request->hasCookie('guest_auth_token')) {
        //     DB::table('carts')->where('guest_id', $request->cookie('guest_auth_token'))->update(['user_id' => $memberId]);
        // }

        return response()->json([
            'message' => 'Signup successful, OTP sent to your email',
            'member_id' => $memberId
        ], 200);
    }


    public function checkotp(Request $request, Member $member)
    {
        error_log("Checking OTP: ");
        // error_log("Checking OTP for request: " . json_encode($member));

        $rules = [
            'otp' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }
        if ($member->otp == $request->otp) {
            $member->status = 1;
            $member->save();
            Auth::guard('member')->login($member);
            Mail::to($member->email)->send(new welcome('Thank You'));
            return response()->json([
                'message' => 'OTP verified successfully',
                'member_id' => $member->id
            ], 200);
        }
        return response()->json([
            'message' => 'Invalid OTP'
        ], 400);
    }


    public function forgotpasswords(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:members,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Email Not found',
                'errors' => $validator->errors()
            ], 422);
        }

        $member = Member::where('email', $request->email)->first();

        $otp = rand(1000, 9999);

        $member->otp = $otp;
        $member->save();

        Mail::to($member->email)->send(new otp($otp));



        return response()->json([
            'message' => 'OTP sent to your email address',
            'member_id' => $member->id

        ], 200);
    }


    public function resendOtp(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
        ]);

        $member = Member::find($request->member_id);
        $otp = rand(1000, 9999);
        $member->otp = $otp;
        $member->save();

        Mail::to($member->email)->send(new otp($otp));

        return response()->json([
            'message' => 'OTP resent successfully',
            'member_id' => $member->id
        ], 200);
    }




    public function changePassword(Request $request)
    {
        $rules = [
            'member_id' => 'required|exists:members,id',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'confirm_password' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $member = Member::find($request->member_id);
        $hashedpw = base64_encode($request->password);

        $member->passwrd = $hashedpw;

        $member->save();

        return response()->json([
            'message' => 'Password updated successfully'
        ], 200);
    }






public function getuserdata($id)
{
    $member = Member::find($id);

    if (!$member) {
        return response()->json([
            'message' => 'User not found',
        ], 404);
    }

    return response()->json([
        'message' => 'User data fetched successfully',
        'data' => [
            'id' => $member->id,
            'name' => $member->name,
            'email' => $member->email,
            'mobileno' => $member->mobileno,
            'gender' => $member->gender,
            'address' => $member->address,
            'total_points' => $member->total_points,
        ]
    ], 200);
}






public function updateuserdata(Request $request, $id)
{
    $member = Member::find($id);

    if (!$member) {
        return response()->json([
            'message' => 'User not found',
        ], 404);
    }

    $rules = [];

    if ($request->has('name')) {
        $rules['name'] = 'required|string|max:255';
    }

    if ($request->has('email')) {
        $rules['email'] = 'required|email|unique:members,email,' . $id;
    }

    if ($request->has('mobileno')) {
        $rules['mobileno'] = 'required|string|max:20';
    }

    if ($request->has('gender')) {
        $rules['gender'] = 'nullable|string';
    }

    if ($request->has('address')) {
        $rules['address'] = 'nullable|string|max:255';
    }

    $validatedData = $request->validate($rules);

    $member->update($validatedData);

    return response()->json([
        'message' => 'User data updated successfully',
        'data' => $member,
    ], 200);
}




}
