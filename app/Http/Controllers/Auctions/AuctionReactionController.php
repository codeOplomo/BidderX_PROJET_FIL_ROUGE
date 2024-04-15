<?php

namespace App\Http\Controllers\Auctions;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\AuctionReaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuctionReactionController extends Controller
{
    public function toggle(Request $request, $auctionId)
    {
        $user = auth()->user();
        $this->authorize('react', $user);

        $auction = Auction::findOrFail($auctionId);

        $reaction = $user->auctionReactions()->where('auction_id', $auctionId)->first();

        if ($reaction) {
            $reaction->delete();
        } else {
            // If no reaction exists, create a new one to toggle on the reaction
            AuctionReaction::create([
                'user_id' => $user->id,
                'auction_id' => $auctionId,
                'liked' => true, // Assuming you're just tracking likes
            ]);
        }

        // Calculate the new react count after the toggle
        $newReactCount = $auction->reactions()->count();

        // Return a JSON response with the success status and new react count
        return response()->json([
            'success' => true,
            'newCount' => $newReactCount,
        ]);
    }


}
