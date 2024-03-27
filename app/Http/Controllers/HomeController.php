<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome(Request $request)
    {

        $topSellers = User::topSellers()->take(4)->get();
//dd($topSellers);

        $newestAuctions = Auction::with('product')
            ->approved()
            ->latest()
            ->take(5)
            ->get();

        $topCollections = Collection::withCount('products')
            ->orderByDesc('products_count')
            ->take(4)
            ->get();

        return view('welcome', compact('newestAuctions', 'topSellers', 'topCollections'));
    }

    public function about()
    {
        $allProducts = Product::count();
        $creators = User::whereHas('roles', function ($query) {
            $query->where('name', 'owner');
        })->count();
        $ownersEarning = Auction::whereNotNull('winner_id')->sum('current_bid_price');
        $xBidderEarnings = $ownersEarning * 0.025;
        return view('about', compact('allProducts', 'creators', 'ownersEarning', 'xBidderEarnings'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function blog()
    {
        $blogPosts = BlogPost::with('category')
            ->recent()
            ->get();
        $categories = Category::all();
        $tags = Tag::all();
        return view('blogs.index', compact('categories', 'blogPosts', 'tags'));
    }


    public function details($id)
    {
        $blog = BlogPost::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        $comments = $blog->comments()->with('user')->get();
        $commentCount = Comment::where('blog_post_id', $id)->whereNull('parent_id')->count();

        return view('blogs.show', compact('blog', 'categories', 'tags', 'comments', 'commentCount'));
    }

}
