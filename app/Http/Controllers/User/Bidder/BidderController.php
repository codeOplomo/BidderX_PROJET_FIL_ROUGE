<?php

namespace App\Http\Controllers\User\Bidder;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidderController extends Controller
{

    public function index()
{
    $user = auth()->user();

    if ($user->hasRole('bidder')) {
        $bidderData = $user;
        $tabTitles = ['liked', 'owned'];

        $likedAuctions = Auction::likedByUser($user->id)->with('product')->get();
        $ownedAuctions = $user->wonProducts;

        return view('profiles.index', compact('bidderData', 'tabTitles', 'likedAuctions', 'ownedAuctions'));
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
