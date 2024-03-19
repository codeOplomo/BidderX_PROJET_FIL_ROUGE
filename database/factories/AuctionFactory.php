<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Auction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class AuctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Auction::class;

    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        return [
            'starting_bid_price' => $this->faker->randomFloat(2, 10, 1000),
            'current_bid_price' => $this->faker->randomFloat(2, 10, 1000),
            'user_id' => $this->faker->randomElement($users),
            'product_id' => $this->faker->randomElement($products),
        ];
    }
}
