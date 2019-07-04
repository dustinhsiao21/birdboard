<?php

namespace App\Observers;

use App\Models\Project;
use App\Repositories\ActivityRepository;

class ProjectObserver
{
    protected $activities;

    public function __construct(ActivityRepository $activities)
    {
        $this->activities = $activities;
    }

    /**
     * Handle the project "created" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $this->recordActivity($project, 'created');
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        $this->recordActivity($project, 'updated');
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the project "restored" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }

    protected function recordActivity(Project $project, $type)
    {
        $this->activities->create([
            'project_id' => $project->id,
            'user_id' => auth()->id() ?? $project->user->id,
            'description' => $type,
        ]);
    }
}
