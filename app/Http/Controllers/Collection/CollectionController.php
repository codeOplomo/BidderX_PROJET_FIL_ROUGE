<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public function show(Collection $collection)
    {
        return view('collections.show', compact('collection'));
    }
    public function create()
    {
        $categories = Category::all();

        return view('collections.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'category' => 'required|exists:categories,id', // Assuming categories are stored in a table named 'categories'
            'description' => 'nullable|string',
            'logo_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            // Add more validation rules as needed
        ]);

        //dd($request->all());
        $owner = auth()->user();

        // Create a new collection using the validated data
        $collection = Collection::create([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category'],
            'description' => $validatedData['description'],
            'owner_id' => $owner->id,
        ]);


        // Associate the logo image with the collection under the media collection named "collection"
        $collection->addMediaFromRequest('logo_image')->toMediaCollection('collection');

        // Check if cover_image is present and add it to the media collection if so
        if ($request->hasFile('cover_image')) {
            $collection->addMediaFromRequest('cover_image')->toMediaCollection('collection');
        }

        // Check if featured_image is present and add it to the media collection if so
        if ($request->hasFile('featured_image')) {
            $collection->addMediaFromRequest('featured_image')->toMediaCollection('collection');
        }

        // Optionally, you can redirect the user to a relevant page after storing the collection
        return redirect()->route('ownerProfile')->with('success', 'Collection created successfully!');
    }

}
