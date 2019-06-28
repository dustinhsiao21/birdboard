<?php

namespace App\Policies;

use App\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Project $project)
    {
        return $user->is($project->user);
    }

    public function update(User $user, Project $project)
    {
        return $user->is($project->user);
    }

    public function createTask(User $user, Project $project)
    {
        return $user->is($project->user);
    }

    public function updateTask(User $user, Project $project)
    {
        return $user->is($project->user);
    }
}
