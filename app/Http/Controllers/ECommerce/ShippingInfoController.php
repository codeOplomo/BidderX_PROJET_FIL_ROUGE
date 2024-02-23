<?php

namespace App\Http\Controllers\ECommerce;

use App\Http\Controllers\Controller;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;

class ShippingInfoController extends Controller
{
     /**
     * Display a listing of the shipping information.
     */
    public function index()
    {
        $shippingInfos = ShippingInfo::all();
        return response()->json($shippingInfos);
    }

    /**
     * Store a newly created shipping information in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'shipping_address' => 'required|string|max:255',
            'tracking_number' => 'required|string|max:255',
            'shipping_date' => 'required|date',
        ]);

        $shippingInfo = ShippingInfo::create($request->all());

        return response()->json([
            'message' => 'Shipping information created successfully!',
            'shippingInfo' => $shippingInfo
        ], 201);
    }

    /**
     * Display the specified shipping information.
     */
    public function show($id)
    {
        $shippingInfo = ShippingInfo::find($id);

        if (!$shippingInfo) {
            return response()->json(['message' => 'Shipping information not found'], 404);
        }

        return response()->json($shippingInfo);
    }

    /**
     * Update the specified shipping information in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'shipping_address' => 'required|string|max:255',
            'tracking_number' => 'required|string|max:255',
            'shipping_date' => 'required|date',
        ]);

        $shippingInfo = ShippingInfo::find($id);

        if (!$shippingInfo) {
            return response()->json(['message' => 'Shipping information not found'], 404);
        }

        $shippingInfo->update($request->all());

        return response()->json([
            'message' => 'Shipping information updated successfully!',
            'shippingInfo' => $shippingInfo
        ]);
    }

    /**
     * Remove the specified shipping information from storage.
     */
    public function destroy($id)
    {
        $shippingInfo = ShippingInfo::find($id);

        if (!$shippingInfo) {
            return response()->json(['message' => 'Shipping information not found'], 404);
        }

        $shippingInfo->delete();

        return response()->json(['message' => 'Shipping information deleted successfully']);
    }
}
