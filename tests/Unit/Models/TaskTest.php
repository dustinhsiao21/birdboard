<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
