<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;

class ProjectController extends Controller
{
    private $projects;

    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function show(Project $project)
    {
        if (auth()->user()->isNot($project->user)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function store(StoreRequest $request)
    {
        $this->projects->create($request->onlyRules() + ['user_id' => auth()->user()->id]);

        return redirect(route('project.index'));
    }

    public function update(Project $project, UpdateRequest $request)
    {
        $project->update($request->onlyRules());

        return redirect($project->path());
    }
}
