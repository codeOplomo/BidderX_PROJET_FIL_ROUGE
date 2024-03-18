<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function profile(Request $request)
{
    $user = Auth::user();
    return view('admin.profile.DashProfile', compact('user'));
}



public function profileEdit()
    {
        // Redirect to the profile edit page
        return view('admin.profile.editProfile');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $user = Auth::user();
    return view('admin.DashBoard', compact('user'));
}


public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->query('query');

        // Perform the search. This is just an example; adjust according to your needs
        $results = User::where('firstname', 'like', '%' . $query . '%')
            ->orWhere('lastname', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->get();

        // Return the search results view, passing the results
        return view('admin.search_results', compact('results'));
    }

    public function categories(Request $request)
    {
        $categories = Category::all();
        return view('admin.DashCategory', compact('categories'));
    }

    /**
     * Display a listing of auctions.
     */
    public function auctions()
    {
        $pendingAuctions = Auction::pending()->paginate(10);

        return view('admin.auctions.DashAuction', compact('pendingAuctions'));
    }

    /**
     * Display a listing of bids.
     */
    public function bids(Request $request)
    {
        $bids = Bid::all();
        return view('admin.DashBids', compact('bids'));
    }

    /**
     * Display a single category.
     */
    public function category(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('admin.DashCategory', compact('category'));
    }

    /**
     * Display a single product.
     */
    public function products()
    {
        $products = Product::paginate(12); 

        return view('admin.DashProduct', compact('products'));
    }

    /**
     * Display a listing of users.
     */
    public function users(Request $request)
    {
        $users = User::paginate(12);
        return view('admin.users.DashUsers', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
