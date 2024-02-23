<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    /**
     * Post a rating for a product.
     */
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5', // Assuming a 1-5 rating scale
        ]);

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Check if the user has already rated this product
        $existingRating = ProductRating::where('product_id', $productId)
                                        ->where('user_id', Auth::id())
                                        ->first();
        if ($existingRating) {
            return response()->json(['message' => 'You have already rated this product'], 422);
        }

        $rating = ProductRating::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'message' => 'Rating added successfully!',
            'rating' => $rating
        ], 201);
    }

    /**
     * Get the average rating for a product.
     */
    public function show($productId)
    {
        $averageRating = ProductRating::where('product_id', $productId)
                                      ->avg('rating');

        if (is_null($averageRating)) {
            return response()->json(['message' => 'No ratings found for this product'], 404);
        }

        return response()->json(['averageRating' => round($averageRating, 2)]);
    }
}
