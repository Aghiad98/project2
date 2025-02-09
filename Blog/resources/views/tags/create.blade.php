@extends('layouts.app')

@section('title', 'Create Tag')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Create Tag</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('tags.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="tag">Tag Name:</label>
                            <input type="text" id="tag" name="tag" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
