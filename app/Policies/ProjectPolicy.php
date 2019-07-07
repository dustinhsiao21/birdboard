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
        return $this->basic($user, $project);
    }

    public function update(User $user, Project $project)
    {
        return $this->basic($user, $project);
    }

    public function invite(User $user, Project $project)
    {
        return $this->isOwner($user, $project);
    }

    public function delete(User $user, Project $project)
    {
        return $this->isOwner($user, $project);
    }

    public function createTask(User $user, Project $project)
    {
        return $this->basic($user, $project);
    }

    public function updateTask(User $user, Project $project)
    {
        return $this->basic($user, $project);
    }

    protected function basic(User $user, Project $project)
    {
        return $this->isOwner($user, $project) || $project->members->contains($user);
    }

    protected function isOwner(User $user, Project $project)
    {
        return $user->is($project->user);
    }
}
