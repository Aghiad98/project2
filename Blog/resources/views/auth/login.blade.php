@extends('layouts.app')

@section('title','Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card_login">
<form action="{{route('login')}}"method="POST">
    @csrf

    <div class="card-body">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"name="email" value="{{old ('email')}}">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="card-body">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" aria-describedby="passwordHelpInline" name="password" value="{{old ('password')}}" >
      <div class="col-auto">
        <span id="passwordHelpInline" class="form-text">
          Must be 8-20 characters long.
        </span>
    </div>
    <div class="d-grid gap-2">
    <button type="submit" class="btn btn-primary" >Login</button>
    </div>
    <p>you don't have an account ?</p>
    <a class="btn btn-primary" href="{{route('register')}}" role="button">Register</a>
  </form>
</div>
</div>
</div>
  @endsection
