<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Message::class;

    public function definition()
    {
        $users = User::pluck('id')->toArray();

        return [
            'content' => $this->faker->sentence,
            'is_read' => $this->faker->boolean,
            'sender_name' => $this->faker->name,
            'user_id' => $this->faker->randomElement($users),
        ];
    }
}
