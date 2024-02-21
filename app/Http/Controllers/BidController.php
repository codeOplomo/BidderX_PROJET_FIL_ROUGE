<?php

namespace App\Http\Controllers;

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
    public function store(Request $request, $auctionId)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $auction = Auction::find($auctionId);
        if (!$auction) {
            return response()->json(['message' => 'Auction not found'], 404);
        }

        // Optionally, check if the auction is still open
        if ($auction->ending_at < now()) {
            return response()->json(['message' => 'This auction has ended'], 403);
        }

        // Ensure the bid is higher than the current highest bid
        $highestBid = Bid::where('auction_id', $auctionId)->max('amount');
        if ($request->amount <= $highestBid) {
            return response()->json(['message' => 'Your bid must be higher than the current highest bid'], 422);
        }

        $bid = Bid::create([
            'user_id' => Auth::id(),
            'auction_id' => $auctionId,
            'amount' => $request->amount,
        ]);

        return response()->json([
            'message' => 'Bid placed successfully!',
            'bid' => $bid
        ], 201);
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