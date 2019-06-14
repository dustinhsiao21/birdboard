<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Project;

class ProjectControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testUserCanCreateAProject()
    {
        $this->withoutExceptionHandling();
        $inputs = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];
        
        $this->post(route('project.store', $inputs))->assertRedirect(route('project.index'));
        
        $this->assertDatabaseHas('projects', $inputs);

        $this->get(route('project.index'))->assertSee($inputs['title']);
    }

    public function testAProjectRequiredTitleDescription()
    {
        $inputs = [
            'title' =>  factory(Project::class)->raw(['title' => '']),
            'description' => factory(Project::class)->raw(['description' => '']),
        ];

        foreach ($inputs as $key => $input) {
            $this->post(route('project.store', $input))->assertSessionHasErrors($key);
        }
    }

    public function testCanViewProject()
    {
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create();
        $this->get(route('project.show', ['id' => $project->id]))
            ->assertSee($project->description)
            ->assertSee($project->title);
    }
}
