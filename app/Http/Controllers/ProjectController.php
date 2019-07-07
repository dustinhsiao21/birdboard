<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\UserRepository;
use App\Repositories\ProjectRepository;
use App\Http\Requests\Project\ShowRequest;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\InviteRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Requests\Project\DeleteRequest;

class ProjectController extends Controller
{
    private $projects;

    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    public function index()
    {
        $user = auth()->user();
        $projects = $user->projects->merge($user->relatedProjects)->sortBy('updated_at');

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function show(Project $project, ShowRequest $request, UserRepository $users)
    {
        $except = array_merge($project->members->pluck('id')->toArray(), [$project->user_id]);
        $users = $users->findAllExcept($except);

        return view('projects.show', compact('project', 'users'));
    }

    public function store(StoreRequest $request)
    {
        $project = $this->projects->create($request->onlyRules() + ['user_id' => auth()->user()->id]);

        return redirect($project->path());
    }

    public function update(Project $project, UpdateRequest $request)
    {
        $project->update($request->onlyRules());

        return redirect($project->path());
    }

    public function invite(Project $project, InviteRequest $request, UserRepository $users)
    {
        $user = $users->findOrFail($request->id);

        $project->invite($user);

        return redirect($project->path());
    }

    public function delete(Project $project, DeleteRequest $request)
    {
        $project->delete();

        return redirect(route('project.index'));
    }
}
