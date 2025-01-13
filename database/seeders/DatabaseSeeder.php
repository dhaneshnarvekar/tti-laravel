<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $project = Project::factory()
            ->count(3)
            ->has(Task::factory()->count(3))
            ->create();
    }
}
