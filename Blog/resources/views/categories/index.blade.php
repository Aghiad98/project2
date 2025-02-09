@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="categories-container">
    <!-- العنوان ورابط الإنشاء -->
    <div class="categories-header">
        <h1>Categories</h1>
        <a href="{{ route('Categories.create') }}" class="create-category-btn">Create Category</a>
    </div>

    <!-- قائمة الفئات -->
    <div class="categories-list">
        @foreach ($categories as $category)
        <div class="category-card">
            <!-- صورة الفئة -->
            <img src="/Categories_images/{{ $category->image }}" alt="Category Image" class="category-image">

            <!-- اسم الفئة -->
            <p class="category-name">{{ $category->category }}</p>

            <!-- زر الحذف -->
            <form action="{{ route('Categories.destroy', $category->id) }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Delete</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection
