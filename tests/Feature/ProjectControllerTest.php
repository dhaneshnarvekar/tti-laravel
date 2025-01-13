<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_load_all_projects()
    {
        Project::factory()->count(3)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_load_one_project()
    {
        $data = [
            'title' => 'Test Project',
            'description' => 'Test Description',
            'status' => 'in_progress'
        ];

        $response = $this->postJson('/api/projects', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('projects', $data);
    }

    public function test_404_project_not_found()
    {
        $response = $this->getJson('/api/projects/99999');

        $response->assertStatus(404);
    }

    public function test_update_one_project()
    {
        $project = Project::factory()->create();

        $data = [
            'title' => "New Updated Title",
            'status' => "open"
        ];

        $response = $this->putJson("/api/projects/{$project->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('projects', $data);

    }

    public function test_delete_project()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

}