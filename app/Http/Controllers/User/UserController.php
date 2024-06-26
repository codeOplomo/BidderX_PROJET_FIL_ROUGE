<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function getUserDetails($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $imageUrl = $user->getFirstMediaUrl('profile_images', 'thumb') ?: asset('assets/images/slider/banner-06.png');
        // Customize the data as needed
        return response()->json([
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'imageUrl' => $imageUrl,
        ]);
    }

    public function index()
    {
        $user = auth()->user();

        if (Gate::allows('is-owner', $user)) {
            $tabTitles = ['liked', 'owned', 'created', 'collection'];
            $likedAuctions = Auction::likedByUser($user->id)->with('product')->get();
            $ownedAuctions = $user->wonProducts;
            $collections = $user->collections()->withCount('products')->get();
            $createdAuctions = $user->auctionedProducts;
        } elseif (Gate::allows('is-bidder', $user)) {
            $tabTitles = ['liked', 'owned'];
            $likedAuctions = Auction::likedByUser($user->id)->with('product')->get();
            $ownedAuctions = $user->wonProducts;
        } else {
            abort(403, 'Unauthorized access');
        }

        return view('profiles.index', compact('user', 'tabTitles', 'likedAuctions', 'ownedAuctions', 'createdAuctions', 'collections'));
    }

    public function ban(User $user)
{
    $user->update(['is_banned' => true]);
    return redirect()->back()->with('success', 'User has been banned successfully.');
}

public function unban(User $user)
{
    $user->update(['is_banned' => false]);
    return redirect()->back()->with('success', 'User has been unbanned successfully.');
}

    public function approveApplication(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!$user->hasRole('owner')) {
            $ownerRole = Role::where('name', 'owner')->firstOrFail();

            $user->roles()->attach($ownerRole->id);

            $user->request_role_upgrade = false;
            $user->save();

            $user->clearMediaCollection('qualifications');
        }

        return redirect()->back()->with('success', 'Application approved successfully!');
    }

    public function rejectApplication(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->request_role_upgrade = false;
        $user->save();

        $user->clearMediaCollection('qualifications');

        // Optionally, you could implement a notification system to inform the user of the rejection
        // $user->notify(new ApplicationRejectedNotification());

        return redirect()->back()->with('error', 'Application rejected. Invalid qualifications.');
    }


    /**
     * Display the authenticated user's profile.
     */
    public function profile()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    /**
     * Update the authenticated user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8|confirmed',
            // Add other fields as necessary
        ]);

        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->all());

        return response()->json([
            'message' => 'Profile updated successfully!',
            'user' => $user
        ]);
    }


    public function userUpdate(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
        ]);

        $user->update($validatedData);

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }


public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

public function destroy(User $user)
{
    $user->roles()->detach();
    $user->delete();
    return redirect()->back()->with('success', 'User deleted successfully.');
}


}
