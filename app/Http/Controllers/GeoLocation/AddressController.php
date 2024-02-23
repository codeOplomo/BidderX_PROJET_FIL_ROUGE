<?php

namespace App\Http\Controllers\GeoLocation;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{

    /**
     * Fetch and return cities for a given country from an external API.
     * 
     * @param  string  $countryCode The country code or name to fetch cities for.
     * @return \Illuminate\Http\Response
     */
    public function getCities($countryCode)
    {
        // Replace the URL with the actual endpoint of the external API you're using
        $response = Http::get("http://example.com/api/cities/{$countryCode}");

        if ($response->successful()) {
            $cities = $response->json();

            // Optional: Transform the response here if needed to match your frontend requirements
            // For example, if you just need names of the cities, you might do:
            // $cities = collect($response->json())->pluck('name')->all();

            return response()->json($cities);
        } else {
            // Handle errors, perhaps log them and return a user-friendly message
            return response()->json(['error' => 'Failed to fetch cities for the selected country'], 500);
        }
    }
    public function getCountries()
    {
        $response = Http::get('https://countriesnow.space/api/v0.1/countries/');

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Unable to fetch countries'], 500);
        }
    }
    /**
     * Display a listing of addresses.
     */
    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses);
    }

    /**
     * Store a newly created address in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'street' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $address = new Address($request->all());
        $address->save();

        return response()->json([
            'message' => 'Address created successfully!',
            'address' => $address
        ]);
    }

    /**
     * Display the specified address.
     */
    public function show($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        return response()->json($address);
    }

    /**
     * Update the specified address in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'street' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        $address->update($request->all());

        return response()->json([
            'message' => 'Address updated successfully!',
            'address' => $address
        ]);
    }

    /**
     * Remove the specified address from storage.
     */
    public function destroy($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        $address->delete();

        return response()->json(['message' => 'Address deleted successfully!']);
    }
}
