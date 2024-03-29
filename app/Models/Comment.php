<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'blog_post_id',
        'comment',
        'parent_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blog()
    {
        return $this->belongsTo(BlogPost::class);
    }

    // Parent comment relationship: defines a comment's parent
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Child comments relationship: defines the child comments of a comment
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // You can also add scopes here for querying parent comments or child comments if needed
}


