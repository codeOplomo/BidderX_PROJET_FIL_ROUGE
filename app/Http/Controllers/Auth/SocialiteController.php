<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            Log::info('Google User:', ['user' => $user]);

            $nameParts = explode(' ', $user->getName(), 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? '';

            $existingUser = User::where('email', $user->getEmail())->first();

            if ($existingUser) {
                Auth::login($existingUser, true);
                $existingUser->update(['is_active' => true]);
            } else {
                $newUser = User::create([
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $user->getEmail(),
                    'google_id' => $user->getId(),
                    'password' => Hash::make(uniqid()),
                ]);

                $defaultRole = Role::where('name', 'bidder')->firstOrFail();
                $newUser->roles()->attach($defaultRole);

                $newUser->update(['is_active' => true]);
                Auth::login($newUser, true);
            }
            return redirect()->route('profile.index');
        } catch (\Exception $e) {
            Log::error('Google Auth error: ' . $e->getMessage());
            return redirect('login')->withErrors('Something went wrong or you have refused the app!');
        }
    }


}
