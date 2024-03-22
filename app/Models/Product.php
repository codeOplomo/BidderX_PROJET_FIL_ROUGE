<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'title',
        'description',
        'condition',
        'manufacturer',
        'production_year',
        'user_id',
        'category_id',
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

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function scopeOwnedByUser($query, $userId)
    {
        return $query->whereHas('auctions', function ($query) use ($userId) {
            $query->where('winner_id', $userId);
        });
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

