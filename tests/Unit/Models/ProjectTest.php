<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Project;
use App\Models\Task;

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
