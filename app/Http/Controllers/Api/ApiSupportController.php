<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiSupportController extends Controller
{
    //
    public function getsupport()
    {
        $supports = Faq::latest()->get();


        return response()->json([
            'status' => '200',
            'data' => $supports
        ], 200);
    }

    public function getemail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:emails,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }
        $email = Email::create([
            'email' => $request->email,
        ]);

        return response()->json([
            'status' => '200',
            'message' => 'Email saved successfully!',
            'data' => $email,
        ], 200);
    }



public function getprivacypolicy()
{
    $privacypolicy = Page::where('id', 4)->first();

    if (!$privacypolicy) {
        return response()->json([
            'status' => 404,
            'message' => 'Privacy policy not found'
        ], 404);
    }

    return response()->json([
        'status' => 200,
        'data' => $privacypolicy
    ], 200);
}


}
