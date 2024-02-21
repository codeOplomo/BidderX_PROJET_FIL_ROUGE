<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products, with optional filtering.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Optional filtering by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Optional filtering by condition
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        $products = $query->with('category', 'user')->get(); // Eager load relationships

        return response()->json($products);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'condition' => 'required|string',
            'manufacturer' => 'required|string',
            'production_year' => 'nullable|integer',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with('category', 'user')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'condition' => 'sometimes|string',
            'manufacturer' => 'sometimes|string',
            'production_year' => 'nullable|integer',
            // Assuming the user_id and category_id do not change frequently
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
