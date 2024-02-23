<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of comments for a given product or blog post.
     */
    public function index(Request $request)
    {
        $request->validate([
            'product_id' => 'sometimes|required|exists:products,id',
            'blog_post_id' => 'sometimes|required|exists:blog_posts,id',
        ]);

        $query = Comment::query();

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('blog_post_id')) {
            $query->where('blog_post_id', $request->blog_post_id);
        }

        $comments = $query->with('user')->get(); // Eager load the user who made each comment

        return response()->json($comments);
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'product_id' => 'sometimes|required|exists:products,id',
            'blog_post_id' => 'sometimes|required|exists:blog_posts,id',
            // Ensure at least one of product_id or blog_post_id is provided
        ]);

        $comment = new Comment([
            'content' => $request->content,
            'user_id' => Auth::id(), // Assuming the commenter is the authenticated user
            'product_id' => $request->input('product_id', null),
            'blog_post_id' => $request->input('blog_post_id', null),
        ]);

        $comment->save();

        return response()->json(['message' => 'Comment created successfully!', 'comment' => $comment], 201);
    }

    /**
     * Display the specified comment.
     */
    public function show($id)
    {
        $comment = Comment::with('user')->find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return response()->json($comment);
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        // Optionally check if the authenticated user is the one who made the comment
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->content = $request->content;
        $comment->save();

        return response()->json(['message' => 'Comment updated successfully!', 'comment' => $comment]);
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        // Optionally check if the authenticated user is the one who made the comment
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
