<?php // app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'phone', // Include the 'phone' attribute
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Define the relationship with the Address model
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function ratedProducts()
    {
        return $this->hasManyThrough(Product::class, ProductRating::class, 'user_id', 'id', 'id', 'product_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentedProducts()
    {
        return $this->hasManyThrough(Product::class, Comment::class, 'user_id', 'id', 'id', 'product_id');
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class, 'user_id');
    }

    public function auctionedProducts()
    {
        return $this->hasManyThrough(Product::class, Auction::class, 'user_id', 'id', 'id', 'product_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
