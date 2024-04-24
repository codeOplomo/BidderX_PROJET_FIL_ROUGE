<?php

namespace App\Http\Controllers\Auctions;

use App\Enums\WalletEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\BidRequest;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
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

    public function store(BidRequest $request)
    {
        //dd($request->all());
        $auction = Auction::find($request->auction_id);

        $this->authorize('bid', User::class);

        if ($auction->is_instant && $auction->winner_id) {
            return redirect()->back()->with('error', 'This instant auction has already been sold.');
        }

        if (!$auction->isActive()) {
            return redirect()->back()->with('error', 'This auction is not currently active.');
        }

        $previousBid = $auction->bids()->highest()->first();
        if ($previousBid) {
            $previousBidder = $previousBid->user;
            if ($previousBidder) {
                $previousBidder->deposit(WalletEnums::DEPOSIT->value, $auction->current_bid_price);
            }
        }


        $bid = Bid::create([
            'user_id' => Auth::id(),
            'auction_id' => $request->auction_id,
            'amount' => $request->amount,
        ]);

        if ($bid) {
            $auction->current_bid_price = $request->amount;
            if ($auction->is_instant) {
                $auction->winner_id = Auth::id();
            }
            $auction->save();

            $serviceFee = 10;
            $totalBidAmount = $request->amount + $serviceFee;

            // Update user's wallet balance
            $user = Auth::user();
            try {
                $user->pay($totalBidAmount);
                return redirect()->back()->with('success', 'Bid placed successfully!');
            } catch (\Exception $e) {
                // Handle exception if payment fails
                return redirect()->back()->with('error', 'Failed to deduct the total bid amount from your wallet.');
            }
        }

        return redirect()->back()->with('error', 'Failed to place the bid.');
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
