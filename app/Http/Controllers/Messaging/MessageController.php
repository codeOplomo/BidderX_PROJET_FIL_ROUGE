<?php

namespace App\Http\Controllers\Messaging;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
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
     * Store a newly created message in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'is_read' => false, // Default to false when a message is created
        ]);

        return response()->json(['message' => 'Message sent successfully!', 'data' => $message], 201);
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
