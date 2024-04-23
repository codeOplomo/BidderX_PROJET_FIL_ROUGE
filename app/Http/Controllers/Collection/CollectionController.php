<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public function searchForCollection()
    {
        $query = $request->input('query');

    }
    public function show(Collection $collection)
    {
        return view('collections.show', compact('collection'));
    }

    public function create()
    {
        $this->authorize('createCollection', User::class);

        $categories = Category::all();
        return view('collections.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('createCollection', User::class);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'category' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'logo_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'featured_image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'featured_image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        //dd($request->all());
        $owner = auth()->user();

        $collection = Collection::create([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category'],
            'description' => $validatedData['description'],
            'owner_id' => $owner->id,
        ]);


        // Associate the logo image with the collection under the media collection named "collection"
        $collection->addMediaFromRequest('logo_image')->toMediaCollection('blog_logo_image');

        if ($request->hasFile('cover_image')) {
            $collection->addMediaFromRequest('cover_image')->toMediaCollection('blog_cover_image');
        }

        if ($request->hasFile('featured_image')) {
            $collection->addMediaFromRequest('featured_image')->toMediaCollection('blog_featured_image');
        }

        if ($request->hasFile('featured_image1')) {
            $collection->addMediaFromRequest('featured_image1')->toMediaCollection('blog_featured_image');
        }

        if ($request->hasFile('featured_image2')) {
            $collection->addMediaFromRequest('featured_image2')->toMediaCollection('blog_featured_image');
        }

        return redirect()->back()->with('success', 'Collection created successfully!');
    }

    public function collectionExplore(Request $request)
    {
        $query = $request->input('query');
//dd($query);
        if (!empty($query)) {
            $collections = Collection::where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->withCount('products')
                ->orderByDesc('products_count')
                ->get();
//dd($collections);
            } else {
                $collections = Collection::withCount('products')
                    ->orderByDesc('products_count')
                    ->get();
            }

            //$categories = Category::all();
//dd($collections);
            return view('collections.collections-explore', compact('collections'));

    }
}
