<?php

namespace App\Http\Controllers\Blogs;;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.blogs.create', compact('categories', 'tags'));
    }
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'blog_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $blogPost = BlogPost::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => auth()->id(),
            'category_id' => $validatedData['category'],
            'status' => 'published',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('blog_image')) {
            $blogPost->addMedia($request->file('blog_image'))->toMediaCollection('blog_images');
        }

        if (isset($validatedData['tags'])) {
            $blogPost->tags()->attach($validatedData['tags']);
        }

        return redirect()->route('admin.blogs')->with('success', 'Blog post created successfully.');
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
