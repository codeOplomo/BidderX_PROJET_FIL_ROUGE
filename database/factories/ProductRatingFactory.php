<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\ProductRating;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class ProductRatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductRating::class;

    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        return [
            'rating' => $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->randomElement($users),
            'product_id' => $this->faker->randomElement($products),
        ];
    }
}
