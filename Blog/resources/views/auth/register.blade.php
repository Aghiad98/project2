@extends('layouts.app')

@section('title','Register')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card_register">
                <div class="card-body">
     <form method="POST" action="{{route('register')}}" enctype="multipart/form-data">
        @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                </div>
                <div class="card-body">
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                </div>

                <div class="card-body">
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        <span id="passwordHelpInline" class="form-text">
                            Must be 8-20 characters long.
                          </span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                </div>
                <div class="card-body">
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Password confirmation') }}</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                     <span id="passwordHelpInline" class="form-text">
                            should be the same password.
                          </span>
                </div>
                </div>
                <div class="card-body">
    <div class="form-group row">

            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('profile_picture ') }}</label>

            <div class="col-md-6">
                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>

                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        </div>
        <div class="card-body">
        <div class="form-group row mb-0">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
            </div>
            <p>you already have an account ?</p>
                <a class="btn btn-primary" href="{{route('login')}}" role="button">Login</a>
        </div>
        </div>
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>

        @endsection



