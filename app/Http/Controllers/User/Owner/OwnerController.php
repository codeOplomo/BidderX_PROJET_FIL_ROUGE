<?php

namespace App\Http\Controllers\User\Owner;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{

    public function showCreators()
    {
        $creators = User::with('roles')
        ->whereHas('roles', function($query) {
            $query->where('name', 'owner');
        })
            ->topSellers(30)
            ->get();
//dd($creators);
        return view('auctions.creators', compact('creators'));
    }

    public function sortCreators(Request $request)
    {
        $sort = $request->query('sort', 'recent_added');
        $timeframe = 30;

        switch ($sort) {
            case 'recent_added':
                $creators = User::with('roles')
                    ->whereHas('roles', function($query) {
                        $query->where('name', 'owner');
                    })
                    ->where('created_at', '>=', now()->subDays(30)) // Filtering users added within the last 30 days
                    ->orderByDesc('created_at')
                    ->select([
                        'users.*',
                        DB::raw('COALESCE((SELECT SUM(auctions.current_bid_price)
                FROM auctions
                WHERE auctions.user_id = users.id
                AND auctions.winner_id IS NOT NULL), 0) AS total_revenue') // Removed start_time constraint
                    ])
                    ->get();
                break;
            default:
                $creators = User::with('roles')
                    ->whereHas('roles', function($query) {
                        $query->where('name', 'owner');
                    })
                    ->topSellers($timeframe)
                    ->get();
                break;
        }
        return view('component.creator-list', compact('creators'))->render();
    }


    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('owner')) {
            //$ownerData = $user;
            $tabTitles = ['liked', 'owned', 'created', 'collection'];

            // Fetch the auctions and products associated with the owner
            $likedAuctions = Auction::likedByUser($user->id)->with('product')->get();
            $createdAuctions = $user->auctionedProducts;
            //$ownedProducts = Product::ownedByUser($user->id)->get();
            $ownedAuctions = $user->wonProducts;
            $collections = $user->collections()->withCount('products')->get();


            return view('profiles.index', compact('user', 'tabTitles', 'likedAuctions', 'createdAuctions', 'ownedAuctions', 'collections'));
        } else {
            return abort(403, 'Unauthorized access');
        }
    }




    public function profileEdit()
    {
        $user = auth()->user();

        return view('profiles.edit', compact('user'));
    }

    public function storeAuction(Request $request)
{
    //dd($request->all());

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
        'auctionDuration' => 'nullable|integer|min:1|required_if:auctionType,auction',
        'product_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        'collection' => 'nullable|exists:collections,id',
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
            $product->addMediaFromRequest('product_picture')->toMediaCollection('product_picture');

            if ($request->auctionType === 'instantSale') {
                Auction::create([
                    'product_id' => $product->id,
                    'starting_bid_price' => $validatedData['price'],
                    'is_instant' => true,
                    'user_id' => auth()->id(),
                    // Set other auction attributes as needed
                ]);
            } else {
                // Create an auction with start time and end time from the form inputs
                Auction::create([
                    'product_id' => $product->id,
                    'duration' => $validatedData['auctionDuration'],
                    'starting_bid_price' => $validatedData['price'],
                    'user_id' => auth()->id(),
                    // Set other auction attributes as needed
                ]);
            }

            if ($request->filled('collection')) {
                $product->collections()->sync($validatedData['collection']);
            }
            // Redirect the user to the owner's profile page with success message
            return redirect()->route('ownerProfile')->with('success', 'Auction created successfully!');
        } else {
        // Redirect back with error message if product creation failed
        return redirect()->back()->withInput()->with('error', 'Image upload failed!');
    }
}




}
