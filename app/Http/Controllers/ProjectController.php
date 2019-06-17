<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Repositories\ProjectRepository;

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

    public function show($id)
    {
        $project = $this->projects->find($id);

        if (auth()->user()->isNot($project->user)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function store(StoreRequest $request)
    {
        $this->projects->store($request->onlyRules() + ['user_id' => auth()->user()->id]);

        return redirect(route('project.index'));
    }
}
