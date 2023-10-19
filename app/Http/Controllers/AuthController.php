<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\middleware\RedirectToPreviousPage;
use Carbon\Carbon;



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
        $user->update(['last_visit' => Carbon::now()]);
        /* if($user->update(['last_visit' => Carbon::now()]))
        {
            return redirect()->back()->withErrors([
                'email' => 'error updating lastvists.',
            ]);
        } */
    
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
            //return redirect()->intended('/');
        }
    
        // If authentication fails, store user email in the session
    
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    
    public function Signup(Request $request)
    {
        //first time
        $this->validate($request, [
            'name' => 'bail|required|string|max:50',
            "email" => 'bail|required|string|max:50',
            "password" => 'bail|required|string|max:40',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $request->session()->put('UserEmail', $request->email);
        return redirect()->intended('/');

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
        return redirect()->intended('/')->withCookie($cookie);
        

        return redirect('/'); // Redirect to the homepage or another appropriate page
    }

    // ...
}
