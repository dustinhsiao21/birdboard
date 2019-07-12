@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-item-center">
        <div class="rounded shadow p-3" style="min-width:350px">
            <div class="my-3">
                <h3 class="text-center">User Setting</h3>
            </div>
            <div class="m-3">
                <form action="{{ route('user.setting.update')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-6 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name" placeholder="name" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-6 col-form-label text-md-right">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-6 col-form-label text-md-right">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>
                    <footer class="d-flex justify-content-end my-3">
                        <button type="button" class="btn btn-outline-danger mr-3">Cancel</button>
                        <button type="submit" class="btn btn-success">save</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
@endsection