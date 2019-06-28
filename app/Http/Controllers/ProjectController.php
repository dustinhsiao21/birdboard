<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Requests\Project\ShowRequest;

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

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function show(Project $project, ShowRequest $request)
    {
        return view('projects.show', compact('project'));
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
}
