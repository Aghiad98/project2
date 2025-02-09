@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Post</h3>
                </div>
                <div class="card-body">
                    <!-- عرض الأخطاء -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- نموذج التعديل -->
                    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- حقل العنوان -->
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
                        </div>

                        <!-- حقل المحتوى -->
                        <div class="form-group mb-3">
                            <label for="content" class="form-label">Content:</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control" required>{{ $post->content }}</textarea>
                        </div>

                        <!-- حقل الصورة -->
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Current Image:</label>
                            <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" class="img-fluid rounded mb-2" style="width: 200px; height: 200px;">
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <!-- حقل الفئة -->
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Category:</label>
                            <select id="category_id" name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- حقل الوسوم -->
                        <div class="form-group mb-3">
                            <label for="tags" class="form-label">Tags:</label>
                            <div>
                                @foreach ($tags as $tag)
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            name="tags[]"
                                            id="tag_{{ $tag->id }}"
                                            value="{{ $tag->id }}"
                                            class="form-check-input"
                                            {{ $post->tags->contains($tag->id) ? 'checked' : '' }}
                                        >
                                        <label for="tag_{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- زر التحديث -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
