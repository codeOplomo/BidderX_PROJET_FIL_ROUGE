<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
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
