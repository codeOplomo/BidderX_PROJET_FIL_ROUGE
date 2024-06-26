<?php

namespace App\Http\Controllers;

use App\Enums\WalletEnums;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Stripe\Stripe;
use Stripe\Charge;

class WalletController extends Controller
{
    public function connectWallet()
    {
        $this->authorize('useWallet', User::class);
        return view('wallet.connect-wallet');
    }

    public function paymentPage()
    {
        $this->authorize('useWallet', User::class);
        return view('wallet.payment-page');
    }

    public function depositPayment(Request $request)
    {
        $this->authorize('useWallet', User::class);
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Deposit to Wallet',
            ]);

            $amountFromCharge = $charge->amount / 100;

            $user = Auth::user();
            $user->deposit(WalletEnums::DEPOSIT->value, $amountFromCharge);


            return Redirect::back()->with('success', 'Payment successful. Thank you for your deposit.');
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
