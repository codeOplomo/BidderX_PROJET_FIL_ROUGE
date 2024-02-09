<?php

// app/Models/BlogPost.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        // Add any other attributes you want to be mass assignable
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

