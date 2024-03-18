<?php

namespace App\Http\Controllers\Auctions;

use App\Models\Auction;
use App\Models\Category;
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
        $auctions = Auction::with('product')->get(); // Assuming each auction is related to a product

        return response()->json($auctions);
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
                'is_approved' => true,
            ]);
        } else {
            // For instant auctions, only update start time
            $auction->update(['start_time' => now(), 'is_approved' => true]);
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
        return view('owner.auction.auctionCreate', compact('categories'));
    }

    /**
     * Store a newly created auction in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'starting_price' => 'required|numeric',
            'ending_at' => 'required|date|after:now',
        ]);

        $auction = Auction::create([
            'user_id' => Auth::id(), // Assuming the auction is created by the authenticated user
            'product_id' => $request->product_id,
            'starting_price' => $request->starting_price,
            'ending_at' => $request->ending_at,
        ]);

        return response()->json([
            'message' => 'Auction created successfully!',
            'auction' => $auction
        ], 201);
    }

    /**
     * Display the specified auction.
     */
    public function show($id)
    {
        $auction = Auction::with('product')->find($id);

        if (!$auction) {
            return response()->json(['message' => 'Auction not found'], 404);
        }

        return response()->json($auction);
    }

    /**
     * Update the specified auction in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'starting_price' => 'sometimes|numeric',
            'ending_at' => 'sometimes|date|after:now',
            // Add other fields as necessary
        ]);

        $auction = Auction::find($id);

        if (!$auction) {
            return response()->json(['message' => 'Auction not found'], 404);
        }

        $auction->update($request->all());

        return response()->json([
            'message' => 'Auction updated successfully!',
            'auction' => $auction
        ]);
    }

    /**
     * Remove the specified auction from storage.
     */
    public function destroy($id)
    {
        $auction = Auction::find($id);

        if (!$auction) {
            return response()->json(['message' => 'Auction not found'], 404);
        }

        $auction->delete();

        return response()->json(['message' => 'Auction deleted successfully']);
    }
}
