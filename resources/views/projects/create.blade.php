@extends('layouts.app')

@section('content')
    @include('projects.form', [
        "header" => "Let's start something new",
        "project" => new App\Models\Project,
        'buttonText' => 'Create a Project',
        'cancelPath' => "/projects"
    ])
@endsection