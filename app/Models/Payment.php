<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'bid_id',
        'amount',
        'status',
        'payment_method',
        // Add any other attributes you want to be mass assignable
    ];

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }

    public function shippingInfo()
    {
        return $this->hasOne(ShippingInfo::class);
    }
}

