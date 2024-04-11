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


            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $request->input('receiver_id'),
                'content' => $request->input('content'),
                'is_read' => false,
            ]);

            // Dispatch an event for real-time broadcasting
            broadcast(new MessageSent($message))->toOthers();
            //event(new MessageSent($message));

            return response()->json(['message' => 'Message sent successfully!', 'data' => $message], 201);
        } catch (\Exception $e) {
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
