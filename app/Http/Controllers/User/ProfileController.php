<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    
public function changePassword(Request $request)
{
    $request->validate([
        'email' => ['required', 'email', 'exists:users,email'],
        'old_password' => ['required'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = Auth::user();

    if (!Hash::check($request->old_password, $user->password)) {
        return back()->withErrors(['old_password' => 'The old password is incorrect.']);
    }

    // Update the user's password
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Password changed successfully.');
}


}