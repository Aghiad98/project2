@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="posts-container">
    @forelse ($posts as $post)
    <div class="post-card">

        <div class="post-header">
            <img src="{{ asset('images/' . $post->user->image) }}" alt="User Image" class="user-image">

                <span class="user-name">{{ $post->user->name }}</span>
        </div>


        <div class="post-content">
            <h2 class="post-title">{{ $post->title }}</h2>
            <p class="post-description">{{ Str::limit($post->content, 100) }}</p>
            <span class="post-category">Category: {{ $post->category->category }}</span>
        </div>


        <div class="post-actions">
            @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('user')))
                <a href="{{ route('posts.show', $post->id) }}" class="show-btn">Show</a>
            @endif

            @if(Auth::id() === $post->user_id)
                <a href="{{ route('posts.edit', $post->id) }}" class="edit-btn">Edit</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            @endif
        </div>
    </div>
    @empty
    <p class="no-posts">There are no posts.</p>
    @endforelse
</div>
@endsection
