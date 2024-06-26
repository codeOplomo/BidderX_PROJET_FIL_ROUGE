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
    public function markMessagesAsRead($userId)
    {
        $currentUser = auth()->id();
        Message::where('receiver_id', $currentUser)
            ->where('sender_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['message' => 'Messages marked as read']);
    }

    public function unreadMessagesCount()
    {
        $userId = auth()->id();
        // Count unique conversations with unread messages
        $count = Message::where('receiver_id', $userId)
            ->where('is_read', false)
            ->distinct('sender_id')
            ->count('sender_id');
        return response()->json(['count' => $count]);
    }


    public function startChat($userId)
    {
        return redirect()->route('chat.page', ['userId' => $userId]);
    }

    public function chatPage(Request $request)
    {
        $userId = $request->query('userId');
        $currentUserId = auth()->id();

        $activeUsers = User::where('is_active', true)
            ->where('id', '!=', $currentUserId)
            ->withCount(['receivedMessages as unread_count' => function ($query) use ($currentUserId) {
                $query->where('receiver_id', $currentUserId)
                    ->where('is_read', false);
            }])
            ->get();

        // Map through each user to add custom data about unread messages by sender
        $activeUsers->map(function ($user) use ($currentUserId) {
            $user->unreadMessagesBySender = Message::selectRaw('sender_id, count(*) as unread_count')
                ->where('receiver_id', $currentUserId)
                ->where('sender_id', $user->id)
                ->where('is_read', false)
                ->groupBy('sender_id')
                ->get()
                ->pluck('unread_count', 'sender_id');
        });

        $user = null;
        if ($userId) {
            $user = User::find($userId);
        }
        return view('messaging.chat', compact('activeUsers', 'user'));
    }



    public function fetchChatHistory($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
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

            //broadcast(new MessageSent($message))->toOthers();

            return response()->json(['message' => 'Message sent successfully!', 'data' => $message], 201);
        } catch (\Exception $e) {
            Log::error("Message sending failed: " . $e->getMessage());  // Log error message
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
