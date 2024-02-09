<?php

// app/Models/Auction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'starting_bid_price',
        'current_bid_price',
        'user_id',
        // Add any other attributes you want to be mass assignable
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

}

