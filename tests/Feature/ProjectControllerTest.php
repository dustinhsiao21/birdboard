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
        $this->signIn();

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

    public function testProjectCanInvitedUser()
    {
        $this->signIn();
        $project = factory(Project::class)->create(['user_id' => auth()->id()]);
        $user = factory(User::class)->create();

        $this->post(route('project.invite', ['project' => $project->id, 'id' => $user->id]))
            ->assertStatus(302);

        $this->assertTrue($project->fresh()->members->contains($user));

        //user not exist
        $this->post(route('project.invite', ['project' => $project->id, 'id' => 9999]))
            ->assertStatus(404);
    }

    public function testProjectMemberCannotInvitedUser()
    {
        $this->signIn();
        $project = factory(Project::class)->create();
        $user = factory(User::class)->create();

        $this->post(route('project.invite', ['project' => $project->id, 'id' => $user->id]))
            ->assertStatus(403);
    }

    public function testProjectMemberCannotSeeTheInvitation()
    {
        // Bob is a member, so he could not see the others name for invitation
        $Bob = $this->signIn();
        $John = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $project->invite($Bob);

        $this->get($project->path())->assertDontSee($John->name);

        // The Project owner could see the others name for invitation
        $this->actingAs($project->user)->get($project->path())->assertSee($John->name);
    }

    public function testOnlyTheOwnerCouldDeleteTheProject()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['user_id' => auth()->id()]);

        // if the auth user is the project owner
        $this->post(route('project.delete', ['project' => $project->id]))
            ->assertRedirect(route('project.index'));

        // if the auth user is not the project owner
        $project = factory(Project::class)->create();

        $this->post(route('project.delete', ['project' => $project->id]))
            ->assertStatus(403);

    }
}
