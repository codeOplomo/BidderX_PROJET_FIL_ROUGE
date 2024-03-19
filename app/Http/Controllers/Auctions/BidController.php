<?php

namespace App\Http\Controllers\Auctions;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Bid;
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

        $isAuctionOngoing = $auction->start_time <= now() && ($auction->end_time > now() || is_null($auction->end_time));

        if (!$auction || !$isAuctionOngoing)  {
            return redirect()->back()->with('error', 'This auction is not available for bidding.');
        }

        $highestBid = $auction->current_bid_price;
        if ($request->amount <= $highestBid) {
            return redirect()->back()->with('error', 'Your bid must be higher than the current highest bid.');
        }

        // Create a new bid
        $bid = Bid::create([
            'user_id' => Auth::id(),
            'auction_id' => $request->auction_id,
            'amount' => $request->amount,
        ]);

        if ($bid) {
            $auction->update(['current_bid_price' => $request->amount]);
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