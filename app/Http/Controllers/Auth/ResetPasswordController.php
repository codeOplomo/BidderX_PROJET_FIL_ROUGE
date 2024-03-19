<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function showResetForm(Request $request, $token = null)
{
    // dd($token);
    // If $token is null, retrieve it from the request
    if (is_null($token)) {
        $token = $request->input('token');
    }

    // If $token is still null, redirect with an error message
    if (is_null($token)) {
        return redirect()->route('password.request')->with('error', 'Invalid password reset link.');
    }

    // dd($email);
    // Retrieve the email from the request
    $email = $request->email;

    // Return the view with the token and email
    return view('auth.passwords.ResetPassword')->with(compact('token', 'email'));
}


    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Reset the user's password
        $response = $this->broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        // Redirect back with success message or error
        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }

    protected function broker()
    {
        return Password::broker();
    }
}
