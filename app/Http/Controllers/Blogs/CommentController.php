<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a newly created comment in storage.
    public function store(Request $request)
    {
        $request->validate([
            'blog_post_id' => 'required|exists:blog_posts,id',
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
            'reply_flag' => 'boolean', // Add validation for reply_flag
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Create the comment or reply based on the presence of the "reply_flag" field
        if ($request->has('reply_flag') && $request->input('reply_flag')) {
            // This is a reply
            $parentComment = Comment::findOrFail($request->parent_id);

            $reply = new Comment();
            $reply->user_id = $user->id;
            $reply->blog_post_id = $request->blog_post_id;
            $reply->comment = $request->comment;
            $reply->parent_id = $parentComment->id; // Set parent_id to the ID of the parent comment
            $reply->save();

            return redirect()->back()->with('success', 'Reply added successfully');
        } else {
            // This is a regular comment
            $comment = new Comment();
            $comment->user_id = $user->id;
            $comment->blog_post_id = $request->blog_post_id;
            $comment->comment = $request->comment;
            $comment->parent_id = null; // Set parent_id to null for regular comments
            $comment->save();

            return redirect()->back()->with('success', 'Comment added successfully');
        }
    }


    // Delete the specified comment from storage.
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the authenticated user is the owner of the comment or has permission to delete comments
        if (Auth::user()->id === $comment->user_id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully');
        }

        return redirect()->back()->with('error', 'Unauthorized action');
    }
}
