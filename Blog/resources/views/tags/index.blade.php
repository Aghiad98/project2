@extends('layouts.app')

@section('title', 'Tags')

@section('content')
<div class="container mt-5">
    <div class="row-tag">
        <div class="col-md-8">
            <h1 class="mb-4">Tags</h1>
            <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Create Tag</a>

            <ul class="list-group">
                @foreach ($tags as $tag)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $tag->name }}</span>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
