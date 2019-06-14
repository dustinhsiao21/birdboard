<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\ShowRequest;
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
        $projects = $this->projects->all();

        return view('projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = $this->projects->find($id);

        return view('projects.show', compact('project'));
    }

    public function store(StoreRequest $request)
    {
        $this->projects->store($request->onlyRules());

        return redirect(route('project.index'));
    }
}
