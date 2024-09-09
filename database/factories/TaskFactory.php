<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            //
            'task_name' => $this->faker->word(),
            'task_description' => $this->faker->sentence(),
            'is_done' => $this->faker->boolean(),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
