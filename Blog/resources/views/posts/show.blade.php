@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-7 offset-md-3">
            <!-- عرض تفاصيل المنشور -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/' . $post->user->image) }}" alt="User Image" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                        <p class="mb-0">{{ $post->user->name }}</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <img src="/Categories_images/{{ $post->category->image }}" alt="Category Image" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                        <p class="mb-0">{{ $post->category->category }}</p>
                    </div>
                    <div class="mb-3">
                        @foreach ($post->tags as $tag)
                            <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <p class="card-text">{{ $post->content }}</p>
                    @if ($post->image)
                        <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" class="img-fluid rounded">
                    @endif
                </div>
            </div>

            <!-- عرض التعليقات -->
            <h4 class="mb-3">Comments</h4>
            @foreach ($post->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('images/' . $comment->user->image) }}" alt="User Image" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                            <small>{{ $comment->user->name }}</small>
                        </div>
                        <p class="card-text">{{ $comment->content }}</p>

                        <!-- زر التعديل والحذف (فقط لصاحب التعليق) -->
                        @if (auth()->id() === $comment->user_id)
                            <div class="mt-3">
                                <form action="{{ route('posts.comments.update', [$post->id, $comment->id]) }}" method="POST" class="mb-2">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="content" class="form-control mb-2" rows="2" required>{{ $comment->content }}</textarea>
                                    <button type="submit" class="btn btn-sm btn-warning">Edit</button>
                                </form>
                                <form action="{{ route('posts.comments.destroy', [$post->id, $comment->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <!-- نموذج إضافة تعليق جديد -->
            <h4 class="mb-3">Add New Comment</h4>
            <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <textarea name="content" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Comment</button>
            </form>
        </div>
    </div>
</div>
@endsection
