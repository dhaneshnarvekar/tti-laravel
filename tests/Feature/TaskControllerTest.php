<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Task;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_load_all_tasks()
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_load_one_tasks()
    {
        $task = Task::factory()->create();

        $response = $this->getJson("/api/tasks/$task->id");

        $response->assertStatus(200)->assertJsonFragment([
            'id' => $task->id,
            'title' => $task->title,
        ]);;
    }

    public function test_create_task()
    {
        $project = Project::factory()->create();

        $data = [
            'project_id' => $project->id,
            'title' => 'Task name',
            'status' => 'to_do',
            'description' => 'Tast description',
            'assigned_to' => 'dhanesh',
            'due_date' => '2025-02-01'
        ];

        $response = $this->postJson("/api/projects/$project->id/tasks",$data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/$task->id");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_update_task()
    {
        $task = Task::factory()->create();

        $data = [
            "title" => "New updated title", 
            "status" => "done",
            "project_id" => $task->project_id
        ];

        $response = $this->putJson("/api/tasks/$task->id",$data);

        $response->assertStatus(200)->assertJsonFragment($data);

        $this->assertDatabaseHas("tasks",$data);
    }

}