<?php

// app/Models/Bid.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $fillable = [
        'auction_id',
        'user_id',
        'amount',
        // Add any other attributes you want to be mass assignable
    ];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function scopeHighest($query)
    {
        return $query->orderByDesc('amount');
    }

}

