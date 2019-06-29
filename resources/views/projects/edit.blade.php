@extends('layouts.app')

@section('content')
    <form action="{{ route('project.update', ['project' => $project->id]) }}" method="POST" class="container">
    @include('projects.form', [
        'header' => 'Edit Your Project',
        'buttonText' => 'Update Project',
        'cancelPath' => ''
    ])
    </form>
@endsection