<?php

namespace Tests\Setup;

use App\Models\Project;
use App\Models\Task;
use App\User;

class ProjectFactory
{
    /**
     * number of the task.
     *
     * @var int
     */
    protected $taskCounts = 0;

    /**
     * user of the project.
     *
     * @var User
     */
    protected $user;

    /**
     * set Count.
     *
     * @param int $count
     * @return $this
     */
    public function withTask(int $count)
    {
        $this->taskCounts = $count;

        return $this;
    }

    /**
     * set user.
     *
     * @param User $user
     * @return $this
     */
    public function userBy(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Arrange the Project.
     *
     * @return Project
     */
    public function create()
    {
        $project = factory(Project::class)->create([
            'user_id' => $this->user ?? factory(User::class),
        ]);

        factory(Task::class, $this->taskCounts)->create([
            'project_id' => $project,
        ]);

        return $project;
    }
}
