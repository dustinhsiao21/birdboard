@extends('layouts.app')

@section('content')
    <div class="pb-4 d-flex justify-content-between">
        <p class="text-secondary">My Projects</p>
        <a href="#" @click.prevent="$modal.show('project-create-modal')" class="btn btn-primary">Add Project</a>
    </div>
    <div class="row">
        @foreach ($projects as $project)
        <div class="col-md-4 col-xs-12 mb-5">
            @include('projects.card', ['isSameRow' => true])
        </div>
        @endforeach
    </div>
    <project-create-modal></project-create-modal>
@endsection
