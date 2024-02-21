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
        'user_id', 
        'category_id',
        // Add any other attributes you want to be mass assignable
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // Scope for retrieving recent blog posts
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Scope for searching blog posts by title
    public function scopeTitleContains($query, $title)
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }

}

