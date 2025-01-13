<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;

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
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'assigned_to' => fake()->name(),
            'due_date' => fake()->date(),
            'status' => fake()->randomElement(['to_do', 'in_progress','done']),
            'project_id' => Project::factory(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
