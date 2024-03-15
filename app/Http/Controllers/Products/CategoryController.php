<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{

    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name', 
        ]);

        $newCategoryNameLower = strtolower($request->name);

        $existingCategory = Category::whereRaw('LOWER(name) = ?', [$newCategoryNameLower])->first();

        if ($existingCategory) {
            return redirect()->back()->with('error', 'Category already exists.');
        }
    
        // Create the new category
        $category = new Category();
        $category->name = $request->name;
        $category->save();
    
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function editCategory(Request $request, $id): RedirectResponse
{
    $category = Category::findOrFail($id);

    if ($request->name !== $category->name) {
        $newCategoryNameLower = strtolower($request->name);

        $existingCategory = Category::whereRaw('LOWER(name) = ? AND id != ?', [$newCategoryNameLower, $id])->first();

        if ($existingCategory) {
            return redirect()->back()->with('error', 'Category with the same name already exists.');
        }
    }

    $category->update([
        'name' => $request->name,
    ]);

    return redirect()->back()->with('success', 'Category updated successfully.');
}

    
    public function destroyCategory($id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        $category = new Category([
            'name' => $request->name,
        ]);

        $category->save();

        return response()->json([
            'message' => 'Category created successfully!',
            'category' => $category
        ]);
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $id,
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Category updated successfully!',
            'category' => $category
        ]);
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully!']);
    }
}
