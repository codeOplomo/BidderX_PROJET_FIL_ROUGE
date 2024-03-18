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
        $tabTitles = ['On Sale', 'Owned', 'Liked'];
        
        // Fetch the auctions and products associated with the bidder
        $auctions = $user->auctions;
        $auctionedProducts = $user->auctionedProducts;

        return view('bidder.profile.bidderProfile', compact('bidderData', 'tabTitles', 'auctions', 'auctionedProducts'));
    } else {
        return abort(403, 'Unauthorized access');
    }
}


public function profileEdit()
    {
        $user = auth()->user();

        return view('owner.profile.editProfile', compact('user'));
    }

}