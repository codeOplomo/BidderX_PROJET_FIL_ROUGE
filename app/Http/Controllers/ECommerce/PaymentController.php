<?php

namespace App\Http\Controllers\ECommerce;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments);
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bid_id' => 'required|exists:bids,id',
            'amount' => 'required|numeric',
            'status' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
        ]);

        $payment = Payment::create($request->all());

        return response()->json([
            'message' => 'Payment created successfully!',
            'payment' => $payment
        ], 201);
    }

    /**
     * Display the specified payment.
     */
    public function show($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json($payment);
    }

    /**
     * Update the specified payment in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'bid_id' => 'sometimes|exists:bids,id',
            'amount' => 'sometimes|numeric',
            'status' => 'sometimes|string|max:255',
            'payment_method' => 'sometimes|string|max:255',
        ]);

        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->update($request->all());

        return response()->json([
            'message' => 'Payment updated successfully!',
            'payment' => $payment
        ]);
    }

    /**
     * Remove the specified payment from storage.
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
