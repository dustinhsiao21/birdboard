@extends('layouts.app')

@section('content')
    <form action="{{ route('project.store') }}" method="POST" class="container">
        @csrf
        <h1 class="heading is-l">create a project</h1>
        
        <div class="field">
            <label class="label" for="title">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title">
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>

            <div class="control">
                <textarea name="description" class="textarea"></textarea>
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>

            <div class="control">
                <button type="submit" class="btn btn-primary">Create a Project</button>
                <a href="{{ route('project.index')}}"class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </form>
@endsection