@extends('layouts.app')

@section('content')
    <div class="pb-4 d-flex justify-content-between">
        <p class="text-secondary">My Projects</p>
        <a href="#" @click.prevent="$modal.show('project-create-modal')" class="btn btn-primary">Add Project</a>
    </div>
    <div class="row">
        @foreach ($projects as $project)
        <div class="col-md-4 col-xs-12 pb-5">
            <div class="bg-white shadow-sm rounded px-3 py-3 h-100">
                @include('projects.card')
            </div>
        </div>
        @endforeach
    </div>
    <project-create-modal></project-create-modal>
@endsection
