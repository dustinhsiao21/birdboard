<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\Project;
use App\Repositories\ActivityRepository;

class TaskObserver
{
    protected $activities;

    public function __construct(ActivityRepository $activities)
    {
        $this->activities = $activities;
    }

    /**
     * Handle the task "created" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        $this->recordActivity($task->project, 'created_task');
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        $type = $task->completed ? 'completed_task' : 'incompleted_task';
        $this->recordActivity($task->project, $type);
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        $this->recordActivity($task->project, 'deleted_task');
    }

    /**
     * Handle the task "restored" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the task "force deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }

    protected function recordActivity(Project $project, $type)
    {
        $this->activities->create([
            'project_id' => $project->id,
            'description' => $type,
        ]);
    }
}
