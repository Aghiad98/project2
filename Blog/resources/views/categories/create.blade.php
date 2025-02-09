@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Create Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('Categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- حقل اسم الفئة -->
                        <div class="form-group">
                            <label for="category" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category" name="category" placeholder="Enter category name" required>
                        </div>

                        <!-- حقل صورة الفئة -->
                        <div class="form-group">
                            <label for="image" class="form-label">Category Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>

                        <!-- زر الإرسال -->
                        <button type="submit" class="btn btn-primary ">Create Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


