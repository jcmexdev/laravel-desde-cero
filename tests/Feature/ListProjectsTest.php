<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Project;
use Tests\TestCase;

class ListProjectsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_see_all_projects()
    {

        $this->withoutExceptionHandling();
        $project = factory(Project::class)->create();
        $project2 = factory(Project::class)->create();

        $response = $this->get(route('projects.index'));
        $response->assertStatus(200);
        $response->assertViewHas('projects');
        $response->assertSee($project->title);
        $response->assertSee($project2->title);
    }

    public function test_can_see_individual_projects()
    {
        $project = factory(Project::class)->create();

        $response = $this->get(route('projects.show', $project));
        $response->assertStatus(200);
        $response->assertViewIs('projects.show');
        $response->assertViewHas('project');
        $response->assertSee($project->title);
    }
}
