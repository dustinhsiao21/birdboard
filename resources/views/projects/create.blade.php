@extends('layouts.app')

@section('content')
    <form action="{{ route('project.store') }}" method="POST" class="container">
    @include('projects.form', [
        "header" => "Let's start something new",
        "project" => new App\Models\Project,
        'buttonText' => 'Create a Project',
        'cancelPath' => "/projects"
    ])
    </form>
@endsection