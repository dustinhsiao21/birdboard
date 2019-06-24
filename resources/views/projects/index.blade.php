@extends('layouts.app')

@section('content')
    <div class="pb-4">
        <a href="{{ route('project.create')}}" class="btn btn-primary">create</a>
    </div>
    <div>
        <ul>
        @foreach ($projects as $project)
            <a href="{{ route('project.show', ['id' => $project->id])}}"><li>{{ $project->title }}</li>
        @endforeach
        </ul>
    </div>
@endsection
