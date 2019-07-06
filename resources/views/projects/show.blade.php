@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <p class="text-secondary">
            <a href="{{route('project.index')}}" class="text-decoration-none text-secondary">MyProjects </a>/ {{ $project->title}}
        </p>
        <a href="{{ route('project.edit', ['project' => $project->id])}}" class="btn btn-primary">Update Project</a>
    </div>
    <div class="row mt-4">
        <div class="col-lg-8 col-sm-12">
            <p class="text-secondary">Tasks</p>
                @foreach($project->tasks as $task)
                <div class="card mb-3 p-3">
                    <form action="{{route('project.task.update', ['project' => $project->id, 'task' => $task->id])}}" method="post">
                        @csrf        
                        <div class="form-inline justify-content-between">
                            <div class="form-group col-11">
                                <input type="text" name="body" class="form-control-plaintext w-100 {{ $task->completed ? 'text-secondary' : 'text-dark' }} " value="{{ $task->body }}">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="completed" class="form-check-input" {{ $task->completed ? 'checked' : ''}} onChange="this.form.submit()">
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
                <div class="card p-3 mb-3">
                    <form action="{{route('project.task.create', ['project' => $project->id])}}" method="post">
                        @csrf
                        <div class="form-inline justify-content-between">
                            <div class="form-group col-11">
                                <input type="text" name="body" placeholder="Add a new Task" class="form-control-plaintext w-100">
                            </div>
                        </div>
                    </form>
                </div>
            <p class="text-secondary">General Notes</p>
            <div class="mb-3">
                <form method="POST" action="{{ route('project.update', ['project' => $project->id])}}">
                    @csrf
                    <div class="card mb-3 p-3">
                        <div class="form-group col-12">
                            <textarea name="notes" class="w-100 form-control">{{ $project->notes }}</textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
            @if($errors->any())
            <div class="mt-3">
                @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach
            </div>
            @endif
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="bg-white shadow-sm rounded px-3 py-3">
                @include('projects.card')
            </div>
            @include('projects.activity.card')
            @include('projects.detail')
        </div>
    </div>
@endsection