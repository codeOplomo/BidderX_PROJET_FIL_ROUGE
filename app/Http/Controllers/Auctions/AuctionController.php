<?php

namespace App\Http\Controllers\Auctions;

use App\Models\Auction;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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

    public function showAuctionsExplore(Request $request)
    {
        $query = $request->input('query');

        if (!empty($query)) {
            $auctions = Auction::whereHas('product', function (Builder $queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhere('manufacturer', 'like', '%' . $query . '%');
            })->get();
        } else {
            $auctions = Auction::approved()->get();
        }

        $categories = Category::all();
        $collections = Collection::all();

        return view('auctions.auctions-explore', compact('auctions', 'categories', 'collections'));
    }

    public function filterAuctions(Request $request)
    {
        $query = Auction::query();

        // Apply category filter if provided
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('product.category', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        // Apply collection filter if provided
        if ($request->has('collection') && !empty($request->collection)) {
            $query->whereHas('product.collections', function ($q) use ($request) {
                $q->where('collections.id', $request->collection);
            });
        }

        // Apply price range filter if provided
        if ($request->has('minPrice') && $request->has('maxPrice')) {
            $minPrice = $request->minPrice;
            $maxPrice = $request->maxPrice;

            // Ensure that the minimum price is not greater than the maximum price
            if ($minPrice <= $maxPrice) {
                $query->whereBetween('current_bid_price', [$minPrice, $maxPrice]);
            }
        }

        if ($request->has('saleType')) {
            $saleType = $request->saleType;
            if ($saleType == "1") {
                $query->where('is_instant', true);
            } elseif ($saleType == "0") {
                $query->where('is_instant', false);
            }
        }

        // Eager load the 'product' relationship with specific fields
        $auctions = $query->with(['product' => function ($query) {
            $query->select('id', 'title', 'description', 'manufacturer');
        }])->get();

        // Return the response as JSON
        return response()->json([
            'success' => true,
            'message' => 'Search successful.',
            'auctions' => $auctions,
        ]);
    }


    public function searchForAuctions(Request $request)
    {
        $query = $request->input('query');

        $auctions = Auction::whereHas('product', function (Builder $queryBuilder) use ($query) {
            $queryBuilder->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('manufacturer', 'like', '%' . $query . '%');
        })->with('product:id,title,description,manufacturer')->get();

        return response()->json([
            'success' => true,
            'message' => 'Search successful.',
            'auctions' => $auctions,
        ]);
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
