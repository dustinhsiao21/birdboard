<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\DeleteRequest;
use App\Http\Requests\Project\InviteRequest;
use App\Http\Requests\Project\ShowRequest;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    private $projects;

    /**
     * construct.
     *
     * @param  ProjectRepository  $projects
     */
    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    /**
     * get all projects.
     *
     * @return void
     */
    public function index(): View
    {
        $user = auth()->user();
        $projects = $user->projects->merge($user->relatedProjects)->sortBy('updated_at');

        return view('projects.index', compact('projects'));
    }

    /**
     * edit project.
     *
     * @param  Project  $project
     * @return view
     */
    public function edit(Project $project): View
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * show the selected project.
     *
     * @param  Project  $project
     * @param  ShowRequest  $request
     * @param  UserRepository  $users
     * @return view
     */
    public function show(Project $project, ShowRequest $request, UserRepository $users): View
    {
        $except = array_merge($project->members->pluck('id')->toArray(), [$project->user_id]);
        $users = $users->findAllExcept($except);

        return view('projects.show', compact('project', 'users'));
    }

    /**
     * store new project.
     *
     * @param  StoreRequest  $request
     * @return string return project path
     */
    public function store(StoreRequest $request): string
    {
        $inputs = $request->onlyRules();
        $tasks = array_pull($inputs, 'tasks');
        $tasks = array_filter($tasks, function ($task) {
            return ! is_null($task['body']);
        });

        $project = $this->projects->create($inputs + ['user_id' => auth()->user()->id]);

        //create tasks if the value is not empty
        if ($tasks) {
            $project->tasks()->createMany($tasks);
        }

        return $project->path();
    }

    /**
     * update the project informations.
     *
     * @param  Project  $project
     * @param  UpdateRequest  $request
     * @return view redirect to the project view
     */
    public function update(Project $project, UpdateRequest $request): RedirectResponse
    {
        $project->update($request->onlyRules());

        return redirect($project->path());
    }

    /**
     * Invite user to the project.
     *
     * @param  Project  $project
     * @param  InviteRequest  $request
     * @param  UserRepository  $users
     * @return view redirect to the project view
     */
    public function invite(Project $project, InviteRequest $request, UserRepository $users): RedirectResponse
    {
        $user = $users->findOrFail($request->id);

        $project->invite($user);

        return redirect($project->path());
    }

    /**
     * delete the project.
     *
     * @param  Project  $project
     * @param  DeleteRequest  $request
     * @return string return the projects page
     */
    public function delete(Project $project, DeleteRequest $request): string
    {
        $project->delete();

        return route('project.index');
    }
}
