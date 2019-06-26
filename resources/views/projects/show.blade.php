@extends('layouts.app')

@section('content')
    <div class="d-flex justify-item-between">
        <p class="text-secondary">
            <a href="{{route('project.index')}}" class="text-decoration-none text-secondary">MyProjects </a>/ {{ $project->title}}
        </p>
    </div>
    <div class="row">
        <div class="col-8">
            <p class="text-secondary">Tasks</p>
                @foreach($project->tasks as $task)
                <div class="card mb-3 p-3">
                    <form action="{{route('project.task.update', ['project' => $project->id, 'task' => $task->id])}}" method="post">
                        @csrf        
                        <div class="form-inline justify-content-between">
                            <div class="form-group col-11">
                                <input type="text" name="body" class="form-control-plaintext w-100" value="{{ $task->body }}">
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
                    <input type="text" name="body" placeholder="Add a new Task" class="form-control-plaintext w-100">
                </form>
            </div>
            <p class="text-secondary">General Notes</p>
            <form method="POST" action="{{ route('project.update', ['project' => $project->id])}}">
                @csrf
                <div class="card mb-3 p-3">
                    <textarea name="notes">{{ $project->notes }}</textarea>
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="col-4">
            @include('projects.card')
        </div>
    </div>
@endsection