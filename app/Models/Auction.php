<?php

// app/Models/Auction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'winner_id',
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

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }


    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function reactions()
    {
        return $this->hasMany(AuctionReaction::class);
    }

    public function getUniqueBidderCountAttribute()
    {
        return $this->bids()->with('user')->get()->unique('user_id')->count();
    }
    public function getTotalReactionsAttribute() {
        return $this->reactions()->count();
    }

    public function scopeLikedByUser($query, $userId)
    {
        return $query->whereHas('reactions', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('liked', true);
        });
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

    public function scopeInstant($query)
    {
        return $query->where('is_instant', true)->whereNull('current_bid_price')->whereNull('winner_id');
    }

    public function scopeNormal($query)
    {
        return $query->where('is_instant', false)->whereNull('end_time')->whereNull('winner_id');
    }

    public function scopeEnded($query)
    {
        return $query->where('end_time', '<', now());
    }

    public function scopeUnclosed($query)
    {
        return $query->where(function (Builder $query) {
            $query->whereNull('end_time')
                ->whereNull('winner_id')
                ->orWhere(function (Builder $query) {
                    $query->where('end_time', '>', now())
                        ->whereNull('winner_id');
                });
        });
    }


}

