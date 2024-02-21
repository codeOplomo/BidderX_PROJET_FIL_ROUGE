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
        $senderId = $this->faker->randomElement($users);
        // Ensure the receiver is not the same as the sender
        $receiverId = $this->faker->randomElement(array_diff($users, [$senderId]));

        return [
            'content' => $this->faker->sentence,
            'is_read' => $this->faker->boolean,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
        ];
    }
}
