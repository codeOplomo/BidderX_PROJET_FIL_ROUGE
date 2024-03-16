<?php

namespace App\Http\Controllers\User\Owner;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function index()
{
    $user = auth()->user();

    if ($user->hasRole('owner')) {
        $ownerData = $user;
        $tabTitles = ['On Sale', 'Owned', 'Created', 'Liked'];
        
        // Fetch the auctions and products associated with the owner
        $auctions = $user->auctions;
        $auctionedProducts = $user->auctionedProducts;

        return view('owner.profile.ownerProfile', compact('ownerData', 'tabTitles', 'auctions', 'auctionedProducts'));
    } else {
        return abort(403, 'Unauthorized access');
    }
}


    public function storeAuction(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'condition' => 'required|string',
        'price' => 'required|numeric', 
        'category' => 'required|exists:categories,id',
        'productionYear' => 'nullable|integer',
        'manufacturer' => 'nullable|string',
        'auctionType' => 'required|string|in:instantSale,auction',
        'startDate' => 'required_if:auctionType,auction|date',
        'endDate' => 'required_if:auctionType,auction|date|after:startDate', 
        'product_picture' => 'required|image|max:2048', 
    ]);
        // Associate the image with the product
        $product = Product::create([
            'title' => $validatedData['name'],
            'description' => $validatedData['description'],
            'production_year' => $validatedData['productionYear'],
            'manufacturer' => $validatedData['manufacturer'],
            'user_id' => auth()->id(),
            'category_id' => $validatedData['category'], 
            'condition' => $validatedData['condition'],
        ]);

        if ($product) {
            $product->addMediaFromRequest('product_picture')
                ->toMediaCollection(); // Use the default collection name
    
            if ($request->auctionType === 'instantSale') {
                Auction::create([
                    'product_id' => $product->id,
                    'start_time' => now(), // Current time
                    'starting_bid_price' => $validatedData['price'],
                    'user_id' => auth()->id(),
                    // Set other auction attributes as needed
                ]);
            } else {
                // Create an auction with start time and end time from the form inputs
                Auction::create([
                    'product_id' => $product->id,
                    'start_time' => $validatedData['startDate'],
                    'end_time' => $validatedData['endDate'],
                    'starting_bid_price' => $validatedData['price'],
                    'user_id' => auth()->id(), 
                    // Set other auction attributes as needed
                ]);
            }
    
            // Redirect the user to the owner's profile page with success message
            return redirect()->route('ownerProfile')->with('success', 'Auction created successfully!');
        } else {
        // Redirect back with error message if product creation failed
        return redirect()->back()->withInput()->with('error', 'Image upload failed!');
    }
}




}
