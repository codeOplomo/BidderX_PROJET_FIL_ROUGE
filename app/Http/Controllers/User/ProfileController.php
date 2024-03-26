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

    public function storeImages(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|max:2048',
            'cover_image' => 'required|image|max:2048',
        ]);

        $user = Auth::user(); // Assuming you're storing images for the authenticated user

        // Store the profile image using MediaLibrary
        $user->addMedia($request->file('profile_image'))->toMediaCollection('profile_images');

        // Store the cover image using MediaLibrary
        $user->addMedia($request->file('cover_image'))->toMediaCollection('cover_images');

        return redirect()->route('ownerProfile')->with('success', 'Images uploaded successfully!');
    }
}
