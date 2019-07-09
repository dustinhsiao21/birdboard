@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center" style="height:80vh">
    <h1 class="text-primary" style="font-size:84px;">BirdBoard</h1>
    <a href="https://github.com/dustinhsiao21/birdboard" class="text-uppercase">Watch Source Code Here</a>
    @auth
        <a href="{{ route('project.index') }}" class="btn btn-secondary mt-4">Go to My Projects</a>
    @endAuth
</div>
@endsection
