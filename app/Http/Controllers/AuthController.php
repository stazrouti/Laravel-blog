<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\middleware\RedirectToPreviousPage;
use Carbon\Carbon;

use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AuthController extends Controller
{

    public function Signin(Request $request): RedirectResponse
    {
        // Try to identify
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->update(['last_visit' => Carbon::now()]);
        
            if($user->update(['last_visit' => Carbon::now()]))
            {
                return redirect()->back()->withErrors([
                    'email' => 'error updating lastvists.',
                ]);
            }
    
            // Check if the "remember" checkbox is checked
            $remember = $request->has('remember');
        
            if (Auth::attempt($credentials, $remember)) {
                // Regenerate the session for security
                $request->session()->regenerate();
        
                //set a session for the user
                $request->session()->put('UserEmail', $request->email);
                //set a cookie if he vlick on remember
                if ($remember) {
                    // Set a "remember me" cookie
                    $cookie = cookie('UserEmail', $request->email, 60); // 30 days (adjust the expiration as needed)
                    //return redirect()->intended('/')->withCookie($cookie);
                }
        
                if ($request->session()->has('previous_url')) {
                    $previousUrl = $request->session()->get('previous_url');
                    //dd($previousUrl);
                    $request->session()->forget('previous_url'); // Clear the stored URL
                    return redirect()->intended($previousUrl);
                }
                return redirect()->intended('/');
            }
    }
    
        // If authentication fails, store user email in the session
    
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    

    public function Signup(Request $request)
    {
        // Validate the user input
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|max:40',
        ]);
    
        // Generate a verification code (e.g., a random 6-character code)
        $verificationCode = Str::random(6);
    
        // Store the email and verification code in the session
        $request->session()->put('User_Email', $request->email);
        
        $request->session()->put('Name', $request->name);
        $request->session()->put('VerificationCode', $verificationCode);
    
        // Send the verification email (pass the verification code to the email template)
        Mail::to($request->email)->send(new RegisterMail($request->email, $verificationCode));
    
        // Redirect to the verification page
        return redirect()->route('VerifyEmail');
    }
    
    public function verifyEmail(Request $request)
    {
        // Retrieve the email and verification code from the session
        $userEmail = $request->session()->get('User_Email');
        $verificationCode = $request->session()->get('VerificationCode');
        $Username = $request->session()->get('Name');
    
        // Validate the verification code entered by the user
        $request->validate([
            'verification_code' => 'required|size:6',
        ]);
    
        if ($request->verification_code === $verificationCode) {
            // Verification code matches
            // Create the user and mark their email as verified
            $createdUser = User::create([
                'name' => $Username, // You might need to add name to the registration form
                'email' => $userEmail,
                'password' => Hash::make($request->password), // Use the password from the form
                'email_verified_at' => now(), // Mark email as verified
            ]);
            $request->session()->put('UserEmail', $userEmail);

            // Authenticate the user
            Auth::login($createdUser);
    
            // Clear the session data
            
            if ($request->session()->has('previous_url')) {
                $previousUrl = $request->session()->get('previous_url');
                $request->session()->forget('previous_url'); // Clear the stored URL
                return redirect()->intended($previousUrl);
            }
            /* $request->session()->forget(['Name', 'VerificationCode']); */
            return redirect('/')->with('success', 'Email verified successfully.');
        } else {
            // Verification code doesn't match
            return back()->withErrors(['verification_code' => 'The code is incorrect.']);
        }
    }
    

    public function Logout(Request $request)
    {
        if ($request->session()->has('previous_url')) {
            $previousUrl = $request->session()->get('previous_url');
            //dd($previousUrl);
            $request->session()->forget('previous_url'); // Clear the stored URL
            Auth::logout(); // Log the user out
            //session()->flush(); // Destroy the session
            $request->session()->forget('UserEmail');
            $cookie = cookie('UserEmail', '', -1); // Set the expiration to a past date to remove the cookie
            return redirect()->intended($previousUrl);
        }
        $request->session()->forget('UserEmail');
        /* return redirect()->intended('/')->withCookie($cookie); */
        return redirect()->intended('/');
        

        return redirect('/'); // Redirect to the homepage or another appropriate page
    }
    /*     public function Signup(Request $request)
    {
        //first time
        $this->validate($request, [
            'name' => 'bail|required|string|max:50',
            "email" => 'bail|required|string|max:50',
            "password" => 'bail|required|string|max:40',
        ]);
        try {
            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]); 
    
            // Send the verification email
            Mail::to($user->email)->send(new RegisterMail($user));

            $request->session()->put('UserEmail', $user->email);
    
            // Redirect or perform any other actions as needed
            // You can add a flash message or return a view here
            return redirect()->intended('VerifyEmail');
        } catch (\Exception $e) {
            // Handle any errors that may occur (e.g., user creation or email sending failed)
            return back()->withError('Registration failed. Please try again.');
        } */

       /*  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->put('UserEmail', $request->email); */

        /* return redirect()->intended('/');

    } */
    // ...
}
