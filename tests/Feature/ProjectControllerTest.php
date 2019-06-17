<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Project;
use App\User;

class ProjectControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testNeedToLogin()
    {
        $project = factory(Project::class)->create();
        $project2 = factory(Project::class)->make();

        $this->get(route('project.index'))->assertRedirect(route('login'));
        $this->get(route('project.show', ['id' => $project->id]))->assertRedirect(route('login'));
        $this->get(route('project.store', $project2->toArray()))->assertRedirect(route('login'));
    }

    public function testUserCanCreateAProject()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $this->get(route('project.create'))->assertStatus(200);

        $inputs = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post(route('project.store', $inputs))->assertRedirect(route('project.index'));
        
        $this->assertDatabaseHas('projects', $inputs);

        $this->get(route('project.index'))->assertSee($inputs['title']);
    }

    public function testAProjectRequiredTitleDescription()
    {
        $this->actingAs(factory(User::class)->create());

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

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $project = factory(Project::class)->create(['user_id' => $user->id]);
        $this->get(route('project.show', ['id' => $project->id]))
            ->assertSee($project->description)
            ->assertSee($project->title);
    }

    public function testCannotViewProjectOfOthers()
    {
        $this->actingAs(factory(User::class)->create());

        $project = factory(Project::class)->create();
        
        $this->get($project->path())->assertStatus(403);
    }

    public function testCanOnlyViewUserProject()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $userProject = factory(Project::class)->create(['user_id' => $user->id]);
        $othersProject = factory(Project::class)->create();
        
        $this->get(route('project.index'))
            ->assertSee($userProject->title)
            ->assertDontSee($othersProject->title);
    }
}
