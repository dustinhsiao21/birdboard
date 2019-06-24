@extends('layouts.app')

@section('content')
    <div class="pb-4 d-flex justify-content-between">
        <p class="text-secondary">My Projects</p>
        <a href="{{ route('project.create')}}" class="btn btn-primary">Add Project</a>
    </div>
    <div class="row">
        @foreach ($projects as $project)
        <div class="col-md-4 col-xs-12 pb-5">
            @include('projects.card')
        </div>
        @endforeach
    </div>
@endsection
