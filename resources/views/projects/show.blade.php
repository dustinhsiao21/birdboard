@extends('layouts.app')

@section('content')
    <h1>{{ $project->title }}</h1>
    <p>{{ $project->description }}</p>
    <a href="{{ route('project.index')}}"class="btn btn-success">back</a>
@endsection