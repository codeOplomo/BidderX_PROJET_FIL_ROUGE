<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'condition',
        'manufacturer',
        'production_year',
        // Add any other attributes you want to be mass assignable
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function auction()
    {
        return $this->hasOne(Auction::class);
    }

    // Scope for filtering products by condition
public function scopeCondition($query, $condition)
{
    return $query->where('condition', $condition);
}

// Scope for filtering products by year of production
public function scopeProducedInYear($query, $year)
{
    return $query->where('production_year', $year);
}

}

