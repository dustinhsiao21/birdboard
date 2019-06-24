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
            <div class="bg-white p-3 mb-3 rounded shadow-sm">
                123
            </div>
            <p class="text-secondary">General Notes</p>
            <div class="bg-white p-3 mb-3 rounded shadow-sm">
                <p>{{ $project->description }}</p>
            </div>
        </div>
        <div class="col-4">
            @include('projects.card')
        </div>
    </div>
@endsection