<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\Product;
use App\Models\User;
use App\Models\Comment;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Comment::class;

    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $commentIds = Comment::pluck('id')->toArray();
        $blogPostIds = BlogPost::pluck('id')->toArray();

        return [
            'comment' => $this->faker->paragraph,
            'user_id' => $this->faker->randomElement($users),
            'blog_post_id' => $this->faker->randomElement($blogPostIds),
            'parent_id' => $this->faker->boolean(50) ? $this->faker->randomElement($commentIds) : null, // 50% chance to assign a parent comment
        ];
    }
}
