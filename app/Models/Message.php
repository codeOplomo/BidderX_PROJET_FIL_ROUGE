<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content', 'is_read', 'sender_id', 'receiver_id',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function getContent()
    {
        return $this->content;
    }

    // Scope for unread messages
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Add scopes for sender and receiver
    public function scopeSentBy($query, $userId)
    {
        return $query->where('sender_id', $userId);
    }

    public function scopeReceivedBy($query, $userId)
    {
        return $query->where('receiver_id', $userId);
    }
}


