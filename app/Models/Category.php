<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }

    // Scope for searching categories by name
    public function scopeWithName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

}
