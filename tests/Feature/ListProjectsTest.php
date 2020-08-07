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
        $project = Project::create([
           'title' => 'test projects',
           'url' => 'test-project',
           'description' => 'description for test project'
        ]);
        $project2 = Project::create([
           'title' => 'test projects2',
           'url' => 'test-project2',
           'description' => 'description for test project2'
        ]);

        $response = $this->get(route('projects.index'));
        $response->assertStatus(200);
        $response->assertViewHas('projects');
        $response->assertSee($project->title);
        $response->assertSee($project2->title);
    }

    public function test_can_see_individual_projects()
    {
        $project = $project = Project::create([
            'title' => 'test projects',
            'url' => 'test-project',
            'description' => 'description for test project'
        ]);

        $response = $this->get(route('projects.show', $project));
        $response->assertStatus(200);
        $response->assertViewIs('projects.show');
        $response->assertViewHas('project');
        $response->assertSee($project->title);
    }
}
