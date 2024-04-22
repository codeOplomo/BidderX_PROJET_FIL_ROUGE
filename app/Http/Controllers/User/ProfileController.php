<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Auction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Initialize an empty array for data
        $data = [
            'liked' => [],
            'owned' => []
        ];

        // Fetch data for 'liked' and 'owned' tabs, these are common to all users
        $data['liked'] = Auction::likedByUser($user->id)->with('product')->get();
        $data['owned'] = $user->wonProducts;

        // Initialize tabTitles with common tabs
        $tabTitles = ['liked', 'owned'];

        if ($user->hasRole('owner')) {
            $data['created'] = $user->auctionedProducts;
            $data['collection'] = $user->collections()->withCount('products')->get();
            $tabTitles = array_merge($tabTitles, ['created', 'collection']);
        }

        return view('profiles.index', compact('user', 'tabTitles', 'data'));
    }

    public function updateInfo(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $validatedData = $request->validated();

        $userData = Arr::only($validatedData, ['firstname', 'lastname', 'bio', 'phone']);
        $addressData = Arr::only($validatedData, ['country', 'city', 'street', 'postal_code']);

        //dd($userData, $addressData);

        if (!empty($userData)) {
            $user->update($userData);
        }

        if (!empty($addressData)) {
            $user->address()->updateOrCreate([], $addressData);
        }

        return back()->with('success', 'Profile updated successfully!');
    }



    public function showProfile($id)
    {

        $user = User::findOrFail($id);
        //dd($user);
        $data = [
            'liked' => [],
            'owned' => []
        ];

        // Fetch data for 'liked' and 'owned' tabs, these are common to all users
        $data['liked'] = Auction::likedByUser($user->id)->with('product')->get();
        $data['owned'] = $user->wonProducts;

        // Initialize tabTitles with common tabs
        $tabTitles = ['liked', 'owned'];

        if ($user->hasRole('owner')) {
            // Additional data and tabs for owners
            $data['created'] = $user->auctionedProducts;
            $data['collection'] = $user->collections()->withCount('products')->get();
            $tabTitles = array_merge($tabTitles, ['created', 'collection']);
        }

        return view('profiles.index', compact('user', 'tabTitles', 'data'));
    }

    public function userProfileEdit()
    {
        $user = auth()->user();

        return view('profiles.edit', compact('user'));
    }


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

        return redirect()->route('profile.index')->with('success', 'Images uploaded successfully!');
    }
}
