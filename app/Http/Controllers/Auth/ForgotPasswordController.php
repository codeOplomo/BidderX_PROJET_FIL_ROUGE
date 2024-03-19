<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.ForgetPassword');
    }


    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    // Find the user by email
    $user = User::where('email', $request->email)->first();


    if (!$user) {
        // If user doesn't exist, redirect with an error message
        return redirect()->route('home')->with('error', 'User not found.');
    }

    // Generate password reset token
    $token = Password::createToken($user);


    // Send password reset email
    Mail::to($user)->send(new ResetPassword($user, $token));

    // Redirect back with success message
    return back()->with('status', 'Password reset link sent successfully.');
}



    protected function broker()
    {
        return Password::broker();
    }
}
