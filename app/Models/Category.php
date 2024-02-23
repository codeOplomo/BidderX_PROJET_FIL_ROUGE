<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // Add any other attributes you want to be mass assignable
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Scope for searching categories by name
    public function scopeWithName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

}
