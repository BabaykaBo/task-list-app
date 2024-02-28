<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement(User::pluck('id')),
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'completed' =>fake()->boolean,
        ];
    }

    public function forUser($user_id): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user_id,
        ]);
    }
}
