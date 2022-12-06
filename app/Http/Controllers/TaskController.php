<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Project;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    private $tasks;

    /**
     * construct.
     *
     * @param  TaskRepository  $tasks
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * create new task.
     *
     * @param  Project  $project
     * @param  CreateRequest  $request
     * @return void
     */
    public function create(Project $project, CreateRequest $request): RedirectResponse
    {
        $this->tasks->create(['project_id' => $project->id] + $request->onlyRules());

        return redirect($project->path());
    }

    /**
     * update Task.
     *
     * @param  Project  $project
     * @param  Task  $task
     * @param  UpdateRequest  $request
     * @return RedirectResponse To project path
     */
    public function update(Project $project, Task $task, UpdateRequest $request): RedirectResponse
    {
        $inputs = $request->onlyRules();
        $inputs['completed'] = array_has($inputs, 'completed') ? true : false;
        $inputs['project_id'] = $project->id;

        $this->tasks->update($task->id, $inputs);

        return redirect($project->path());
    }
}
