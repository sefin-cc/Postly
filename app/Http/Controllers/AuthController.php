<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Events\UserSubscribed;

class AuthController extends Controller
{
    // Register User
    public function register(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'username' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed']
        ]);

        // Register
        $user = User::create($fields);

        // Login
        Auth::login($user);

        event(new Registered($user));

        if ($request->subscribe) {
            event(new UserSubscribed($user));
        }

        // Redirect
        return redirect()->route('dashboard');
    }

    // Verify Email Notice Handler
    public function verifyEmailNotice()
    {
        return view('auth.verify-email');
    }

    // Email Verification Handler
    public function verifyEmailHandler(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('dashboard');
    }

    // Resending the Verification Email Handler
    public function verifyEmailResend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

        //login User
    public function login(Request $request){
        
        //Validates the fields, laravel has a build in functions for different kinds of validation methods
       $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);

        //try to logging in
        if (Auth::attempt($fields, $request->remember)) {
            return redirect()->intended('dashboard');
        }else{
            return back()->withErrors([
                    'failed' => 'The provided credentials do not match our records!'
                ]);
        }

        //Redirect the route to the intended page of the users before logging in
        return redirect()->intended();
    }

    //logout user
    public function logout(Request $request){
        //logout the user
        Auth::logout();

        //invalidate user's session
        $request->session()->invalidate();

        //regenerate CSRF token
        $request->session()->regenerateToken();

        //Redirect the route to the home page
        return redirect('login');
    }


}
