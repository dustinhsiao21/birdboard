<?php

namespace App\Policies;

use App\Models\Project;
use App\User;
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

    /**
     * could show.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function show(User $user, Project $project)
    {
        return $this->basic($user, $project);
    }

    /**
     * could update.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function update(User $user, Project $project)
    {
        return $this->basic($user, $project);
    }

    /**
     * could invite.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function invite(User $user, Project $project)
    {
        return $this->isOwner($user, $project);
    }

    /**
     * could delete.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function delete(User $user, Project $project)
    {
        return $this->isOwner($user, $project);
    }

    /**
     * could create task.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function createTask(User $user, Project $project)
    {
        return $this->basic($user, $project);
    }

    /**
     * could update Task.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function updateTask(User $user, Project $project)
    {
        return $this->basic($user, $project);
    }

    /**
     * basic policy.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    protected function basic(User $user, Project $project)
    {
        return $this->isOwner($user, $project) || $project->members->contains($user);
    }

    /**
     * if the login user is the project's owner.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    protected function isOwner(User $user, Project $project)
    {
        return $user->is($project->user);
    }
}
