<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testNeedToLogin()
    {
        $project = factory(Project::class)->create();
        $project2 = factory(Project::class)->make();

        $this->get(route('project.index'))->assertRedirect(route('login'));
        $this->get(route('project.create'))->assertRedirect(route('login'));
        $this->get(route('project.edit', ['project' => $project->id]))->assertRedirect(route('login'));
        $this->get(route('project.show', ['project' => $project->id]))->assertRedirect(route('login'));
        $this->get(route('project.store', $project2->toArray()))->assertRedirect(route('login'));
    }

    public function testUserCanCreateAProject()
    {
        $this->signIn();

        $this->get(route('project.create'))->assertStatus(200);

        $inputs = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post(route('project.store', $inputs))->assertRedirect(route('project.show', ['project' => 1]));

        $this->assertDatabaseHas('projects', $inputs);

        $this->get(route('project.index'))->assertSee($inputs['title']);
    }

    public function testUserCanSeeTheirProjects()
    {
        $john = $this->signIn();

        $project = factory(Project::class)->create();

        $project->invite($john);

        $this->get(route('project.index'))->assertSee($project->title);
    }

    public function testUserCannotSeeOthersProjects()
    {
        $john = $this->signIn();

        $project = factory(Project::class)->create();
        $peter = factory(User::class)->create();

        $project->invite($peter);

        $this->get(route('project.index'))->assertDontSee($project->title);
    }

    public function testAProjectRequiredTitleDescription()
    {
        $this->signIn();

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
        $this->signIn();

        $project = factory(Project::class)->create(['user_id' => auth()->id()]);
        $this->get(route('project.show', ['project' => $project->id]))
            ->assertSee($project->description)
            ->assertSee($project->title);
    }

    public function testCanViewProjectAsAMember()
    {
        $user = $this->signIn();
        $project = factory(Project::class)->create();

        $project->invite($user);

        $this->get($project->path())
            ->assertSee($project->description)
            ->assertSee($project->title);
    }

    public function testCannotViewProjectOfOthers()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function testCanOnlyViewUserProject()
    {
        $this->signIn();

        $userProject = factory(Project::class)->create(['user_id' => auth()->id()]);
        $othersProject = factory(Project::class)->create();

        $this->get(route('project.index'))
            ->assertSee($userProject->title)
            ->assertDontSee($othersProject->title);
    }

    public function testCanUpdateProject()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['user_id' => auth()->id()]);

        $note = 'This is a note';
        $description = 'This is a description';
        $title = 'This is a title';

        $inputs = [
            'project' => $project->id,
            'title' => $title,
            'description' => $description,
            'notes' => $note,
        ];

        $this->post(route('project.update', $inputs))
            ->assertRedirect($project->path());

        $this->get($project->path())
            ->assertSee($note)
            ->assertSee($description)
            ->assertSee($title);
    }

    public function testCanUpdateProjectAsAMember()
    {
        $user = $this->signIn();
        $project = factory(Project::class)->create();

        $project->invite($user);

        $note = 'This is a note';
        $description = 'This is a description';
        $title = 'This is a title';

        $inputs = [
            'project' => $project->id,
            'title' => $title,
            'description' => $description,
            'notes' => $note,
        ];

        $this->post(route('project.update', $inputs))
            ->assertRedirect($project->path());

        $this->get($project->path())
            ->assertSee($note)
            ->assertSee($description)
            ->assertSee($title);
    }

    public function testCannotUpdateOthersProject()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $note = 'This is a note';
        $description = 'This is a description';
        $title = 'This is a title';

        $inputs = [
            'project' => $project->id,
            'title' => $title,
            'description' => $description,
            'notes' => $note,
        ];

        $this->post(route('project.update', $inputs))
            ->assertStatus(403);
    }
}
