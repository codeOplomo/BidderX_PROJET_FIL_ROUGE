<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Notification::class;

    public function definition()
    {
        $users = User::pluck('id')->toArray();

        return [
            'content' => $this->faker->sentence,
            'is_read' => $this->faker->boolean,
            'user_id' => $this->faker->randomElement($users),
        ];
    }
}
