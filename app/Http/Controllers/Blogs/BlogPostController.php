<?php

namespace App\Http\Controllers\Blogs;;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the blog posts.
     */
    public function index()
    {
        $blogPosts = BlogPost::with('user', 'category') // Optionally eager load relationships
                             ->recent()
                             ->get();
        return response()->json($blogPosts);
    }

    /**
     * Store a newly created blog post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id', // Assuming blog posts are associated with users
            'category_id' => 'required|exists:categories,id', // Assuming blog posts are categorized
        ]);

        $blogPost = BlogPost::create($request->all());

        return response()->json([
            'message' => 'Blog post created successfully!',
            'blogPost' => $blogPost
        ], 201);
    }

    /**
     * Display the specified blog post.
     */
    public function show($id)
    {
        $blogPost = BlogPost::with('user', 'category') // Optionally eager load relationships
                             ->find($id);

        if (!$blogPost) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }

        return response()->json($blogPost);
    }

    /**
     * Update the specified blog post in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            // user_id and category_id are typically not updated, but you can add validation if needed
        ]);

        $blogPost = BlogPost::find($id);

        if (!$blogPost) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }

        $blogPost->update($request->all());

        return response()->json([
            'message' => 'Blog post updated successfully!',
            'blogPost' => $blogPost
        ]);
    }

    /**
     * Remove the specified blog post from storage.
     */
    public function destroy($id)
    {
        $blogPost = BlogPost::find($id);

        if (!$blogPost) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }

        $blogPost->delete();

        return response()->json(['message' => 'Blog post deleted successfully']);
    }
}
