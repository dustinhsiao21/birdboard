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
        $this->recordActivity($task, 'created_task');
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        if ($task->getOriginal('body') != $task->body) {
            $this->recordActivity($task, 'updated_task');
        }
        if ($task->getOriginal('completed') != $task->completed) {
            $type = $task->completed ? 'completed_task' : 'incompleted_task';
            $this->recordActivity($task, $type);
        }
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        $this->recordActivity($task, 'deleted_task');
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

    protected function recordActivity(Task $task, $type)
    {
        $this->activities->create([
            'project_id' => $task->project->id,
            'user_id' => auth()->id() ?? $task->project->user->id,
            'task_type' => Task::class,
            'task_id' => $task->id,
            'description' => $type,
        ]);
    }
}
