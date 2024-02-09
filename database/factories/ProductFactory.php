<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $categories = Category::pluck('id')->toArray();

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'condition' => $this->faker->word,
            'manufacturer' => $this->faker->word,
            'production_year' => $this->faker->year,
            'user_id' => $this->faker->randomElement($users),
            'category_id' => $this->faker->randomElement($categories),
        ];
    }
}
