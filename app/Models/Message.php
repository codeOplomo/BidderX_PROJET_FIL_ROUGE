<?php

// app/Models/Message.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'is_read',
        'sender_name',
        // Add any other attributes you want to be mass assignable
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

