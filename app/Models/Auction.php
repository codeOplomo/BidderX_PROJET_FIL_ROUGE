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
        'start_time',
        'end_time',
        'duration',
        'starting_bid_price',
        'current_bid_price',
        'is_instant',
        'motif',
        'user_id',
    ];

    protected $casts = [
        'end_time' => 'datetime',
        'start_time' => 'datetime',
    ];
    

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function scopePending($query)
    {
        return $query->whereNull('start_time')->whereNull('end_time')->whereNull('motif');
    }

    public function scopeApproved($query)
    {
        return $query->whereNotNull('start_time');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>', now());
    }

    public function scopeOngoing($query)
    {
        return $query->where('start_time', '<=', now())->where('end_time', '>=', now());
    }

    public function scopeEnded($query)
    {
        return $query->where('end_time', '<', now());
    }


}

