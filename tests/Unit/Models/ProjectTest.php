<?php

namespace Tests\Unit;

use App\User;
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

    public function testCanInviteUser()
    {
        $project = factory(Project::class)->create();

        $project->invite($john = factory(User::class)->create());

        $this->assertTrue($project->members->contains($john));
    }
}
