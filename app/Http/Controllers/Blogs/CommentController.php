<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Pusher\Pusher;

class CommentController extends Controller
{
    // Store a newly created comment in storage.
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'blog_post_id' => 'required|exists:blog_posts,id',
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
            'reply_flag' => 'boolean',
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

            // Broadcast the comment event using Pusher
            $this->broadcastCommentEvent($reply);

            // Render the single comment view and return it as JSON
            $replyView = view('component.single-comment', ['comments' => $reply])->render();
            return response()->json(['reply' => $replyView]);
        } else {
            // This is a regular comment
            $comment = new Comment();
            $comment->user_id = $user->id;
            $comment->blog_post_id = $request->blog_post_id;
            $comment->comment = $request->comment;
            $comment->parent_id = null; // Set parent_id to null for regular comments
            $comment->save();

            // Broadcast the comment event using Pusher
            $this->broadcastCommentEvent($comment);

            // Render the single comment view and return it as JSON
            $commentView = view('component.single-comment', ['comments' => $comment])->render();
            return response()->json(['comment' => $commentView]);
        }
    }



    // Broadcast comment event using Pusher
    private function broadcastCommentEvent($comment)
    {
        try {
            $pusher = new Pusher(
                config('broadcasting.connections.pusher.key'),
                config('broadcasting.connections.pusher.secret'),
                config('broadcasting.connections.pusher.app_id'),
                config('broadcasting.connections.pusher.options')
            );

            $pusher->trigger('comment-channel', 'new-comment', [
                'comment' => $comment,
            ]);
        } catch (\Exception $e) {
            Log::error('Error broadcasting comment event: ' . $e->getMessage());
        }
    }


    // Delete the specified comment from storage.
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the authenticated user is the owner of the comment or has permission to delete comments
        if (Auth::user()->id === $comment->user_id) {
            $comment->delete();

            // Broadcast comment deletion event using Pusher
            $this->broadcastCommentDeletionEvent($id);

            return redirect()->back()->with('success', 'Comment deleted successfully');
        }

        return redirect()->back()->with('error', 'Unauthorized action');
    }


    // Broadcast comment deletion event using Pusher
    private function broadcastCommentDeletionEvent($commentId)
    {
        try {
            $pusher = new Pusher(
                config('broadcasting.connections.pusher.key'),
                config('broadcasting.connections.pusher.secret'),
                config('broadcasting.connections.pusher.app_id'),
                config('broadcasting.connections.pusher.options')
            );

            $pusher->trigger('comment-channel', 'delete-comment', [
                'comment_id' => $commentId,
            ]);
        } catch (\Exception $e) {
            Log::error('Error broadcasting comment deletion event: ' . $e->getMessage());
        }
    }
}
