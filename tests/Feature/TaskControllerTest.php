<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testUserCanCreateTask()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->signIn($user);

        $body = 'changed';

        $project = factory(Project::class)->create(['user_id' => $user->id]);

        $this->post(route('project.task.create', ['project_id' => $project->id, 'body' => $body]))
            ->assertRedirect(route('project.show', ['project_id' => $project->id]));

        $this->assertDatabaseHas('tasks', ['body' => $body]);
    }

    public function testCannotAddTaskOfOthers()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $body = 'changed';

        $this->post(route('project.task.create', ['project_id' => $project->id, 'body' => $body]))
            ->assertStatus(403);
    }

    public function testATaskShouldBeupdate()
    {
        $task = factory(Task::class)->create();
        $user = $task->project->user;

        $this->signIn($user);

        $body = 'changed';

        $inputs = [
            'project_id' => $task->id,
            'task' => $task->id,
            'body' => $body,
            'completed' => true,
        ];

        $this->post(route('project.task.update', $inputs))
            ->assertRedirect(route('project.show', ['project_id' => $task->project_id]));

        $this->assertDatabaseHas('tasks', [
            'body' => $body,
            'completed' => 1,
        ]);
    }

    public function testCannotUpdateTaskOfOthers()
    {
        $task = factory(Task::class)->create();

        $this->signIn();

        $body = 'changed';

        $this->post(route('project.task.update', ['project' => $task->project->id, 'task' => $task->id, 'body' => $body]))
            ->assertStatus(403);
    }
}
