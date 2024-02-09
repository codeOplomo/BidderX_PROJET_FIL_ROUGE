<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'shipping_address',
        'tracking_number',
        'shipping_date',
        // Add any other attributes you want to be mass assignable
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
