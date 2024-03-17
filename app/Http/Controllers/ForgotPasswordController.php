<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        // Send password reset link
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        // Redirect back with success message
        return $response == Password::RESET_LINK_SENT
                    ? back()->with('status', trans($response))
                    : back()->withErrors(['email' => trans($response)]);
    }

    protected function broker()
    {
        return Password::broker();
    }
}
