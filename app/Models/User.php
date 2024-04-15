<?php // app/Models/User.php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use HPWebdeveloper\LaravelPayPocket\Interfaces\WalletOperations;
use HPWebdeveloper\LaravelPayPocket\Traits\ManagesWallet;


class User extends Authenticatable implements HasMedia, WalletOperations
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, ManagesWallet;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'phone',
        'is_active',
        'google_id',
        'google_token',
        'avatar',
        'is_banned',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'google_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_banned' => 'boolean',
    ];



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


    public function owner()
    {
        return $this->roles()->where('name', 'owner');
    }


    public function scopeTopSellers($query, $timeframe = 1)
    {
        return $query->select('users.*', \DB::raw('COALESCE(SUM(auctions.current_bid_price), 0) AS total_revenue'))
            ->join('auctions', 'users.id', '=', 'auctions.user_id')
            ->whereNotNull('auctions.winner_id')
            ->where('auctions.start_time', '<=', now())
            ->where('auctions.start_time', '>=', now()->subDays($timeframe))
            ->groupBy('users.id')
            ->orderByDesc('total_revenue');
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
