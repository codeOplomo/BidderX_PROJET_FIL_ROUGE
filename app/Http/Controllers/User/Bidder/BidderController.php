<?php

namespace App\Http\Controllers\User\Bidder;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidderController extends Controller
{

    public function applicationForm()
    {
        return view('bidder.application');
    }

    public function submitApplication(Request $request)
    {
        $request->validate([
            'experience_description' => 'required|string|max:5000',
            'professional_qualifications' => 'required|file|mimes:pdf|max:2048', // 2MB Max
        ]);

        $user = Auth::user();
        $user->experience_description = $request->input('experience_description');
        $user->request_role_upgrade = true;

        if ($request->hasFile('professional_qualifications') && $request->file('professional_qualifications')->isValid()) {
            // Directly add the uploaded file to the user's media collection
            $user->addMediaFromRequest('professional_qualifications')
                ->toMediaCollection('qualifications');
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Application submitted successfully. Awaiting approval.');
    }


    public function index()
{
    $user = auth()->user();

    if ($user->hasRole('bidder')) {
        //$bidderData = $user;
        $tabTitles = ['liked', 'owned'];

        $likedAuctions = Auction::likedByUser($user->id)->with('product')->get();
        $ownedAuctions = $user->wonProducts;

        return view('profiles.index', compact('user', 'tabTitles', 'likedAuctions', 'ownedAuctions'));
    } else {
        return abort(403, 'Unauthorized access');
    }
}


public function profileEdit()
    {
        $user = auth()->user();

        return view('profiles.edit', compact('user'));
    }

}
