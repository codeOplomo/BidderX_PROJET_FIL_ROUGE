<?php

// app/Models/Address.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'street',
        'postal_code',
        'city',
        'country',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Example of a scope to retrieve addresses with a specific postal code
    public function scopePostalCode($query, $postalCode)
    {
        return $query->where('postal_code', $postalCode);
    }

    // Scope for filtering addresses by country
    public function scopeInCountry($query, $country)
    {
        return $query->where('country', $country);
    }

    // Scope for searching addresses within a city
    public function scopeInCity($query, $city)
    {
        return $query->where('city', $city);
    }

}

