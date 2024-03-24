<?php

namespace App\Http\Controllers\Auctions;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Bid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Display a listing of bids for a specific auction.
     */
    public function index($auctionId)
    {
        $bids = Bid::where('auction_id', $auctionId)->orderByDesc('amount')->get();

        if ($bids->isEmpty()) {
            return response()->json(['message' => 'No bids found for this auction'], 404);
        }

        return response()->json($bids);
    }

    /**
     * Place a new bid on an auction.
     */

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'auction_id' => 'required|exists:auctions,id',
        ]);

        $auction = Auction::find($request->auction_id);

        // Check for instant auction and if a bid has already been placed
        if ($auction->is_instant && !is_null($auction->current_bid_price)) {
            return redirect()->back()->with('error', 'This instant auction has already been sold.');
        }

        // Ensure $auction->start_time and $auction->end_time are instances of Carbon or are null
        $start_time = $auction->start_time ? new Carbon($auction->start_time) : null;
        $end_time = $auction->end_time ? new Carbon($auction->end_time) : null;
        $now = now();

// Check if the auction has started (or has no start time, which means it's immediately active)
        $hasAuctionStarted = !$start_time || $now->greaterThanOrEqualTo($start_time);

// Check if the auction has not ended (or has no end time, which means it remains active indefinitely)
        $hasAuctionNotEnded = !$end_time || $now->lessThanOrEqualTo($end_time);

// Combine checks to determine if the auction is ongoing
        $isAuctionOngoing = $hasAuctionStarted && $hasAuctionNotEnded;

        if (!$isAuctionOngoing) {
            dd($now, $start_time);
            return redirect()->back()->with('error', 'This auction is not currently active.');
        }


        $highestBid = $auction->current_bid_price ?? 0;
        if ($request->amount <= $highestBid) {
            return redirect()->back()->with('error', 'Your bid must be higher than the current highest bid.');
        }

        // Create a new bid
        $bid = Bid::create([
            'user_id' => Auth::id(),
            'auction_id' => $request->auction_id,
            'amount' => $request->amount,
        ]);

        // Update the auction's current bid price and potentially mark it as sold if it's an instant auction
        if ($bid) {
            $auction->current_bid_price = $request->amount;
            $auction->save();

            if ($auction->is_instant) {
                $auction->winner_id = Auth::id();
                $auction->save();
            }
        }

        return redirect()->back()->with('success', 'Bid placed successfully!');
    }


    /**
     * Display the specified bid.
     */
    public function show($id)
    {
        $bid = Bid::find($id);

        if (!$bid) {
            return response()->json(['message' => 'Bid not found'], 404);
        }

        return response()->json($bid);
    }

    /**
     * Deleting a bid (if applicable).
     * Note: Typically, bids are not deleted to maintain auction integrity, but this method is included for completeness.
     */
    public function destroy($id)
    {
        $bid = Bid::find($id);

        if (!$bid) {
            return response()->json(['message' => 'Bid not found'], 404);
        }

        // Add any additional logic here, such as checking if the user is allowed to delete the bid

        $bid->delete();

        return response()->json(['message' => 'Bid deleted successfully']);
    }
}
