<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateAProject()
    {
        $project = ProjectFactory::create();
        
        $this->assertCount(1, $project->activities);
        $this->assertEquals('created', $project->activities->last()->description);
    }

    public function testUpdateAProject()
    {
        $project = ProjectFactory::create();

        $project->description = 'changed';
        $project->save();

        $this->assertCount(2, $project->activities);
        $this->assertEquals('updated', $project->activities->last()->description);
    }

    public function testCreateATask()
    {
        $project = ProjectFactory::withTask(1)->create();
        
        $this->assertCount(2, $project->activities);
        $this->assertEquals('created_task', $project->activities->last()->description);
    }

    public function testCompletedATask()
    {
        $project = ProjectFactory::withTask(1)->create();
        
        $task = $project->tasks->first();
        
        // completed
        $task->completed = true;
        $task->save();

        $this->assertCount(3, $project->activities);
        $this->assertEquals('completed_task', $project->activities->last()->description);

        // incompleted
        $task->completed = false;
        $task->save();
        $project->refresh();

        $this->assertCount(4, $project->activities);
        $this->assertEquals('incompleted_task', $project->activities->last()->description);
    }

    public function testDeleteATask()
    {
        $project = ProjectFactory::withTask(1)->create();

        $task = $project->tasks->first();

        $this->assertCount(2, $project->activities);

        $task->delete();

        $project->refresh();
        
        $this->assertCount(3, $project->activities);
        $this->assertEquals('deleted_task', $project->activities->last()->description);
    }
}
