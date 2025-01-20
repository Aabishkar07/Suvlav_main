<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\registerUser;
use App\Models\Member;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        if ($request->user()->usertype === 'admin') {
            return redirect('admin/dashboard');
        }
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function redirectToGmail()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGmailCallback(Request $request)
    {

        // dd("aa");    
        // Create a Guzzle HTTP client with SSL verification disabled
        $httpClient = new Client(['verify' => false]);

        // Set the HTTP client for the Google provider
        Socialite::driver('google')->setHttpClient($httpClient);

        // Retrieve the user information
        $googleUser = Socialite::driver('google')->stateless()->user();
        // dd($googleUser->id);

        $exist = Member::where('email', $googleUser->email)->first();
        if ($exist) {
            $user = Member::where('googleauth_id', $googleUser->id)->first();
            if (!$user) {
                return redirect('/memberloginform')->withErrors(['msg' => "$googleUser->email is already exist."]);
            }
            $request->session()->put('memeber_name_ss', $user->name);
            $request->session()->put('memeber_email_ss', $user->email);
            $request->session()->put('memeber_id_ss', $user->id);
            Auth::guard('member')->login($user);
            return redirect("/");
        } else {
            $pd = rand(100000, 999999);
            $hashedpw = base64_encode($pd);

            $code = $this->check($googleUser->name);
            $memberData = [
                'name' => $googleUser->name,
                'email' =>  $googleUser->email,
                'mobileno' => "",
                'googleauth_id' => $googleUser->id,
                'passwrd' => $hashedpw,
                'gender' => "",
                'status' => 1,
                'affilate_code' => $code,
                'created_at' => @date('Y-m-d H:i')
            ];
            $new_user = Member::create($memberData);
            $request->session()->put('memeber_name_ss', $new_user->name);
            $request->session()->put('memeber_email_ss', $new_user->email);
            $request->session()->put('memeber_id_ss', $new_user->id);
            Mail::to('anupkasula012@gmail.com')->send(new registerUser($new_user));

            \Auth::guard('member')->login($new_user);
            return redirect("/");
        }

        // $user = User::where('email', $googleUser->email)->first();
        // if (!$user) {
        //     $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => \Hash::make(rand(100000, 999999))]);
        // }
        // \Auth::guard('web')->login($user);

        // return redirect()->route('index');
    }


    // facebook
    public function redirect()
    {

        return Socialite::driver('facebook')->redirect();
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

    public function callbackFacebook(Request $request)
    {
        try {

            $facebook_user = Socialite::driver('facebook')->user();
            $check_email = $facebook_user->getEmail();
            // dd($facebook_user);

            $exist = Member::where('email', $facebook_user->getEmail())->first();
            if ($exist) {
                $user = Member::where('fbauth_id', $facebook_user->getId())->first();
                if (!$user) {
                    return redirect('/memberloginform')->withErrors(['msg' => "$check_email is already exist."]);
                }
                $request->session()->put('memeber_name_ss', $user->name);
                $request->session()->put('memeber_email_ss', $user->email);
                $request->session()->put('memeber_id_ss', $user->id);
                Auth::guard('member')->login($user);
                return redirect("/");
            } else {
                $pd = rand(100000, 999999);
                $hashedpw = base64_encode($pd);

                $code = $this->check($facebook_user->getName());
                $memberData = [
                    'name' => $facebook_user->getName(),
                    'email' =>  $facebook_user->getEmail(),
                    'mobileno' => "",
                    'fbauth_id' => $facebook_user->getId(),
                    'passwrd' => $hashedpw,
                    'gender' => "",
                    'status' => 1,
                    'affilate_code' => $code,
                    'created_at' => @date('Y-m-d H:i')
                ];
                $new_user = Member::create($memberData);
                $request->session()->put('memeber_name_ss', $new_user->name);
                $request->session()->put('memeber_email_ss', $new_user->email);
                $request->session()->put('memeber_id_ss', $new_user->id);
                Mail::to('anupkasula012@gmail.com')->send(new registerUser($new_user));

                \Auth::guard('member')->login($new_user);
                return redirect("/");
            }
        } catch (\Throwable $th) {
            dd('something went wrong: ' . $th->getMessage(), $th->getTraceAsString());
        }
    }
}
