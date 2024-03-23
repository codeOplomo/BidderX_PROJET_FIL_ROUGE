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
        'email',
        'password',
        'phone',
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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class, 'owner_id');
    }
    public function auctionedProducts()
    {
        return $this->auctions()->with('product');
    }

    public function auctionedProduct()
    {
        return $this->hasManyThrough(Product::class, Auction::class, 'user_id', 'id', 'id', 'product_id');
    }

    public function wonProducts()
    {
        return $this->hasMany(Auction::class, 'winner_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function auctionReactions()
    {
        return $this->hasMany(AuctionReaction::class);
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    // Define a method to retrieve owner data
    public function owner()
    {
        return $this->roles()->where('name', 'owner');
    }


    public function scopeTopSellers($query, $timeframe = 7)
    {
        return $query->leftJoin('auctions', 'users.id', '=', 'auctions.user_id')
            ->select('users.*', \DB::raw('COALESCE(SUM(auctions.current_bid_price), 0) AS total_bid_price'))
            ->whereHas('roles', function ($query) {
                $query->where('name', 'owner');
            })
            ->where('auctions.end_time', '<=', now())
            ->where('auctions.end_time', '>=', now()->subDays($timeframe))
            ->whereNotNull('auctions.current_bid_price')
            ->where(function ($query) {
                $query->where('auctions.is_instant', false)
                    ->orWhere('auctions.is_instant', true);
            })
            ->groupBy('users.id')
            ->orderByDesc('total_bid_price');
    }




    public function scopeWithRole($query, $roleName)
    {
        return $query->whereHas('roles', function ($q) use ($roleName) {
            $q->where('name', $roleName);
        });
    }

    public function scopeActiveAuctioneers($query)
    {
        return $query->has('auctions');
    }

    // Scope for users with a specific email domain
    public function scopeWithEmailDomain($query, $domain)
    {
        return $query->where('email', 'like', '%' . $domain);
    }

    // Scope for active users (you can define "active" based on your application logic, e.g., users who have logged in recently)
    public function scopeActive($query, $days = 30)
    {
        return $query->where('last_login_at', '>=', now()->subDays($days));
    }


}
