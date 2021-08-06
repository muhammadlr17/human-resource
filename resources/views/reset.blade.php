@extends('layouts.main')

@section('title', '| Reset Password')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i> {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('failed'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <i class="fa fa-times-circle"></i> {{ Session::get('failed') }}
        </div>
    @endif
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Reset Password :
                <b>{{ $user->first_name . ' ' . $user->last_name }}</b>
            </h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{ route('profile.resetpassword', $user) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="old_password" class="control-label sr-only">Old Password</label>
                    <input id="old_password" type="password"
                        class="form-control input-sm @error('old_password') is-invalid @enderror" name="old_password"
                        required autocomplete="old_password" placeholder="Old Password">
                    @error('old_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="control-label sr-only">New Password</label>
                    <input id="password" type="password"
                        class="form-control input-sm @error('password') is-invalid @enderror" name="password" required
                        autocomplete="password" placeholder="New Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="control-label sr-only">Password</label>
                    <input id="password-confirm" type="password" class="form-control input-sm" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirm New Password">
                </div>
                <a href="{{ route('profile') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    @endsection
