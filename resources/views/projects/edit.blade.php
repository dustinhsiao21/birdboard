@extends('layouts.app')

@section('content')
    @include('projects.form', [
        'header' => 'Edit Your Project',
        'buttonText' => 'Update Project',
    ])
@endsection