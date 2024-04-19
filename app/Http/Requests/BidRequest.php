<?php

namespace App\Http\Requests;

use App\Models\Auction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BidRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return Auth::user()->can('bid');
        return true;
        //$user = Auth::user();
        //return $user ? (new \App\Policies\UserPolicy())->bid($user) : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:1',
            'auction_id' => 'required|exists:auctions,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $auction = Auction::find($this->auction_id);
            $highestBid = $auction->current_bid_price ?? 0;
            $user = Auth::user();
            $totalBid = $this->amount + 10;

            if ($this->amount <= $highestBid) {
                $validator->errors()->add('amount', 'Your bid must be higher than the current highest bid.');
            }

            if ($user->walletBalance < $totalBid) {
                $validator->errors()->add('walletBalance', 'Insufficient wallet balance to cover the bid and service fee.');
            }
        });
    }
}
