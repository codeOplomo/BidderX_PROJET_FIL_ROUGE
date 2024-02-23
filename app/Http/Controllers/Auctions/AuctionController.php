<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
