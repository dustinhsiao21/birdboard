<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testPath()
    {
        $task = factory(Task::class)->create();

        $expect = route('project.task.update', ['project' => $task->project_id, 'task' => $task->id]);
        
        $this->assertEquals($expect, $task->path());
    }
}
