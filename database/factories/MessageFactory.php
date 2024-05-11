<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ChatRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'chat_room_id' => ChatRoom::factory()->getId(),
            // 'user_id' => User::factory()->getId(),
            // 'content' => fake()->text(100)
        ];
    }
}
