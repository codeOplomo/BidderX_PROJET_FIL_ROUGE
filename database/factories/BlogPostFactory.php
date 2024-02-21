<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = BlogPost::class;

    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $categories = Category::pluck('id')->toArray(); // Get category IDs

        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => $this->faker->randomElement($users),
            'category_id' => $this->faker->randomElement($categories), // Assign a category
        ];
    }
}
