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
    public function determineWinner()
    {
        // Example logic to determine winner
        // This should be replaced with actual logic based on your application's requirements
        $highestBid = $this->bids()->orderBy('amount', 'desc')->first();
        return $highestBid ? $highestBid->user_id : null;
    }


    public function finalize(Request $request, Auction $auction)
    {
        if (!$auction->isActive()) {
            return response()->json(['message' => 'This auction is not active or has already been finalized.'], 400);
        }

        $winnerId = $auction->determineWinner();
        if (!$winnerId) {
            return response()->json(['message' => 'No winner could be determined.'], 422);
        }

        $auction->winner_id = $winnerId;
        $auction->is_active = false; // Ensure you are correctly setting the status
        $auction->save();

        return response()->json([
            'message' => 'Auction finalized successfully.',
            'winner_id' => $winnerId
        ]);
    }



    public function topOwners(Request $request)
    {
        $timeframe = $request->input('timeframe');
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
        $user = Auth::user();
        $query = Auction::with([
            'product:id,title,description,manufacturer',
            'winner:id,firstname,lastname',
            'bids.user:id,firstname,lastname',
        ])->withCount('reactions as total_reactions');

        // Apply category filter if provided
        $query->when($request->filled('category'), function ($q) use ($request) {
            return $q->whereHas('product.category', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        });

        // Apply collection filter if provided
        $query->when($request->filled('collection'), function ($q) use ($request) {
            return $q->whereHas('product.collections', function ($q) use ($request) {
                $q->where('collections.id', $request->collection);
            });
        });

        // Apply price range filter if provided
        $query->when($request->filled('minPrice') && $request->filled('maxPrice'), function ($q) use ($request) {
            $minPrice = $request->minPrice;
            $maxPrice = $request->maxPrice;

            // Ensure that the minimum price is not greater than the maximum price
            if ($minPrice <= $maxPrice) {
                return $q->whereBetween('current_bid_price', [$minPrice, $maxPrice]);
            }
        });

        $query->when($request->filled('saleType'), function ($q) use ($request) {
            $saleType = $request->saleType;
            if ($saleType == "1") {
                return $q->where('is_instant', true);
            } elseif ($saleType == "0") {
                return $q->where('is_instant', false);
            }
        });

        $query->when($request->filled('likes'), function ($q) use ($request) {
            if ($request->likes == "0") {
                return $q->mostLiked();
            } elseif ($request->likes == "1") {
                return $q->leastLiked();
            }
        });

        $auctions = $query->get();

        $auctions->each(function ($auction) use ($user) {
            $auction->canReact = $user ? $user->can('react', $auction) : false;
        });

        if ($auctions->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No auctions found matching the criteria.',
                'auctions' => $auctions,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Search successful.',
            'auctions' => $auctions,
        ]);
    }


    public function searchForAuctions(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('query');

        $auctions = Auction::with([
            'product:id,title,description,manufacturer',
            'winner:id,firstname,lastname',
            'bids.user:id,firstname,lastname'
        ])->withCount('reactions as total_reactions')->whereHas('product', function ($queryBuilder) use ($query) {
            $queryBuilder->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('manufacturer', 'like', '%' . $query . '%');
        })->get();

        $auctions->each(function ($auction) use ($user) {
            $auction->canReact = $user ? $user->can('react', $auction) : false;
        });

        return response()->json([
            'success' => true,
            'message' => 'Search successful.',
            'auctions' => $auctions
        ]);
    }


    public function getPriceRange()
    {
        // Fetch the minimum and maximum of the current bid prices
        $minPrice = Auction::min('current_bid_price');
        $maxPrice = Auction::max('current_bid_price');

        return response()->json([
            'minPrice' => $minPrice ?? 1,
            'maxPrice' => $maxPrice ?? 500,
        ]);
    }

    public function timedAuctions()
    {
        $timedAuctions = Auction::approved()->where('is_instant', false)->get();
        return view('auctions.timed_auctions', compact('timedAuctions'));
    }

    public function instantAuctions()
    {
        $instantAuctions = Auction::approved()->where('is_instant', true)->get();
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
        $this->authorize('createAuction', User::class);

        $categories = Category::all();
        $collections = Auth::user()->collections;

        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('profile');
        }

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
