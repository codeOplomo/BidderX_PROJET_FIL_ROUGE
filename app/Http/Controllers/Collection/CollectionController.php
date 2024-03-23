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
            // Add more validation rules as needed
        ]);

        $owner = auth()->user();
        // Create a new collection using the validated data
        $collection = Collection::create([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category'],
            'description' => $validatedData['description'],
            'owner_id' => $owner->id,
        ]);

        // Optionally, you can redirect the user to a relevant page after storing the collection
        return redirect()->route('ownerProfile')->with('success', 'Collection created successfully!');
    }
}
