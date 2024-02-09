<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\User;
use App\Models\Bid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class BidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Bid::class;

    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $auctions = Auction::pluck('id')->toArray();

        return [
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'user_id' => $this->faker->randomElement($users),
            'auction_id' => $this->faker->randomElement($auctions),
        ];
    }
}
