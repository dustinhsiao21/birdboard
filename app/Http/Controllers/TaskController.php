<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Repositories\TaskRepository;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\UpdateRequest;

class TaskController extends Controller
{
    private $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    public function create(Project $project, CreateRequest $request)
    {
        if (auth()->user()->isNot($project->user)) {
            abort(403);
        }

        $this->tasks->create(['project_id' => $project->id] + $request->onlyRules());

        return redirect($project->path());
    }

    public function update(Project $project, Task $task, UpdateRequest $request)
    {
        if (auth()->user()->isNot($project->user)) {
            abort(403);
        }

        $inputs = $request->onlyRules();
        $inputs['completed'] = array_has($inputs, 'completed') ? true : false;
        $inputs['project_id'] = $project->id;

        $this->tasks->update($task->id, $inputs);

        return redirect($project->path());
    }
}
