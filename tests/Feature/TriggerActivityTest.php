<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateAProject()
    {
        $user = $this->signIn();
        $project = ProjectFactory::userBy($user)->create();

        $this->assertCount(1, $project->activities);
        $this->assertEquals('created', $project->activities->last()->description);
    }

    public function testUpdateAProject()
    {
        $user = $this->signIn();
        $project = ProjectFactory::userBy($user)->create();

        $project->description = 'changed';
        $project->save();

        $this->assertCount(2, $project->activities);
        $this->assertEquals('updated', $project->activities->last()->description);
    }

    public function testCreateATask()
    {
        $user = $this->signIn();
        $project = ProjectFactory::userBy($user)->withTask(1)->create();

        $this->assertCount(2, $project->activities);
        $this->assertEquals('created_task', $project->activities->last()->description);
        $this->assertEquals($project->tasks->first()->id, $project->activities->last()->task->id);
    }

    public function testCompletedATask()
    {
        $user = $this->signIn();
        $project = ProjectFactory::userBy($user)->withTask(1)->create();

        $task = $project->tasks->first();

        // completed
        $task->completed = true;
        $task->save();

        $this->assertCount(3, $project->activities);
        $this->assertEquals('completed_task', $project->activities->last()->description);
        $this->assertEquals($task->id, $project->activities->last()->task->id);

        // incompleted
        $task->completed = false;
        $task->save();
        $project->refresh();

        $this->assertCount(4, $project->activities);
        $this->assertEquals('incompleted_task', $project->activities->last()->description);
        $this->assertEquals($task->id, $project->activities->last()->task->id);
    }

    public function testDeleteATask()
    {
        $user = $this->signIn();
        $project = ProjectFactory::userBy($user)->withTask(1)->create();

        $task = $project->tasks->first();

        $this->assertCount(2, $project->activities);

        $task->delete();

        $project->refresh();

        $this->assertCount(3, $project->activities);
        $this->assertEquals('deleted_task', $project->activities->last()->description);
    }

    public function testUpdatedATask()
    {
        $user = $this->signIn();
        $project = ProjectFactory::userBy($user)->withTask(1)->create();

        $task = $project->tasks->first();

        $task->body = 'changed';
        $task->save();

        $this->assertCount(3, $project->activities);
        $this->assertEquals('updated_task', $project->activities->last()->description);
    }
}
