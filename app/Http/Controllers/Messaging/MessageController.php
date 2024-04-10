<?php

namespace App\Http\Controllers\Messaging;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;


class MessageController extends Controller
{
    public function chatPage()
    {
        $activeUsers = User::where('is_active', true)->get(['id', 'firstname', 'lastname']); // Add more fields as needed

        return view('messaging.chat', compact('activeUsers'));
    }


    public function fetchChatHistory($userId)
    {
        $user = User::find($userId);
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $userId);
        })
            ->orWhere(function ($query) use ($userId) {
                $query->where('sender_id', $userId)->where('receiver_id', Auth::id());
            })
            ->get();

        return response()->json(['user' => $user, 'messages' => $messages]);
    }



    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'receiver_id' => 'required|exists:users,id',
                'content' => 'required|string',
            ]);


            // Create a new message in the database
            $message = Message::create([
                'sender_id' => Auth::id(), // Use the authenticated user's ID as the sender
                'receiver_id' => $request->input('receiver_id'), // Use the provided receiver_id from the request
                'content' => $request->input('content'), // Use the content from the request
                'is_read' => false, // Default to false when a message is first created
            ]);

            // Dispatch an event for real-time broadcasting
            broadcast(new MessageSent($message))->toOthers();
            //event(new MessageSent($message));

            // Return a successful response with the message data
            return response()->json(['message' => 'Message sent successfully!', 'data' => $message], 201);
        } catch (\Exception $e) {
            Log::error('Error sending message: ' . $e->getMessage());
            return response()->json(['error' => 'Message sending failed'], 500);
        }
    }

    /**
     * Display a listing of messages for the authenticated user.
     */
    public function index()
    {
        $userId = Auth::id();
        $messages = Message::where('receiver_id', $userId)->get();

        return response()->json($messages);
    }


    /**
     * Display the specified message.
     */
    public function show($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        // Optionally mark the message as read when it is viewed
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return response()->json($message);
    }

    /**
     * Update the specified message in storage.
     * Note: Typically, messages are not updated, but this method is included for completeness.
     */
    public function update(Request $request, $id)
    {
        // Implement as needed, based on your application's rules around message mutability
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted successfully']);
    }
}
