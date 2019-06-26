<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function testPath()
    {
        $project = factory(Project::class)->create();

        $expect = route('project.show', ['id' => $project->id]);

        $this->assertEquals($expect, $project->path());
    }
}
