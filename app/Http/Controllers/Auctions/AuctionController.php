<?php

namespace App\Http\Controllers\Auctions;

use App\Models\Auction;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuctionController extends Controller
{
    /**
     * Display a listing of auctions.
     */
    public function index()
    {

    }

    public function topOwners(Request $request)
    {
        $timeframe = $request->input('timeframe'); // No default value provided
        $topSellers = User::topSellers($timeframe)->get();

        return response()->json($topSellers);
    }

    public function showAuctionsExplore()
    {
        $auctions = Auction::approved()->get();
        return view('auctions.auctions-explore', compact('auctions'));
    }

    public function timedAuctions()
    {
        $timedAuctions = Auction::where('is_instant', false)->get();
        return view('auctions.timed_auctions', compact('timedAuctions'));
    }

    public function instantAuctions()
    {
        $instantAuctions = Auction::where('is_instant', true)->get();
        return view('auctions.instant_auctions', compact('instantAuctions'));
    }

    public function accept(Request $request, Auction $auction)
    {
        try {
            if (!$auction->is_instant) {
                $duration = $auction->duration;
                $endTime = now()->addHours($duration);

                // Update start time and end time
                $auction->update([
                    'start_time' => now(),
                    'end_time' => $endTime,
                ]);
            } else {
                // For instant auctions, only update start time
                $auction->update(['start_time' => now()]);
            }

            return redirect()->back()->with('success', 'Auction accepted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to accept auction.');
        }
    }



    public function reject(Request $request, Auction $auction)
    {
        $request->validate([
            'motif' => 'required|string|max:255',
        ]);

        try {
            $auction->update([
                'motif' => $request->motif,
            ]);
            return redirect()->back()->with('success', 'Auction rejected successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to reject auction.');
        }
    }

    public function create()
    {
        $categories = Category::all();
        $collections = Auth::user()->collections;
        return view('owner.auction.auctionCreate', compact('categories', 'collections'));
    }


    public function searchForExplore(Request $request)
    {
        // Handle the search logic for the explore page
        // Access the search query using $request->query('query')

        // Perform the search logic here and return the results
        // For now, let's just return a dummy response
        return response()->json(['message' => 'Search request received for explore page']);
    }
    /**
     * Store a newly created auction in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified auction.
     */
    public function show($id)
    {
        $auction = Auction::findOrFail($id);
        $auction->load('product.category', 'product.collections');
        // Assuming that the highest bid is always the current bid price,
        // Find the bid with the amount equal to the current_bid_price and load the associated user.
        // This approach assumes that there will not be multiple bids with the exact same amount as the current bid price,
        // or if there are, that fetching the latest one is acceptable.
        $winningBid = $auction->bids()
            ->with('user')
            ->where('amount', $auction->current_bid_price)
            ->first();


        $userBidHistory = null;
        if (Auth::check()) {
            $userId = Auth::id();
            $userBidHistory = $auction->bids()
                ->where('user_id', $userId)
                ->with('user')
                ->get()
                ->sortByDesc('created_at');
        }

        $allBids = $auction->bids()->with('user')->orderByDesc('created_at')->get();

        // Pass both the auction and the winningBid (if any) to the view
        return view('auctions.auction-detail', compact('auction', 'winningBid', 'userBidHistory', 'allBids'));
    }


    /**
     * Update the specified auction in storage.
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified auction from storage.
     */
    public function destroy($id)
    {

    }
}
