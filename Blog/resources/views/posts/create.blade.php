@extends('layouts.app')

@section('title','create')

@section('content')

@if ($errors->any())
<ul>
  @foreach ( $errors->all() as $error )
    <li>{{$error}}</li>
  @endforeach
</ul>

  @endif

  <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-3">
        <label for="title" class="form-label">title:</label>
    <input type="text" name="title" id="title"  class="form-control" required >
</div>
<div class="col-md-3">
    <label for="content" class="form-label">content:</label>
    <textarea name="content" id="content" cols="30" rows="10"  class="form-control" required></textarea>
</div>
<div class="col-md-3">
    <label for="image" class="form-label">image </label>
    <input class="form-control" type="file" name="image"  id="image">
  </div>
  
  <div class="col-md-1">
    <label for="category_id" class="form-label">category:</label>
        <select id="category_id" name="category_id" class="form-select">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category }}</option>
            @endforeach
        </select>

    </div>


        @foreach($tags as $tag)
        <div class="form-check">
        <input class="form-check-input" name="tags[]" value="{{ $tag->id }}" type="checkbox" value="" id="tag-{{ $tag->id }}">
        <label class="form-check-label"  for="tag-{{ $tag->id }}">
            {{ $tag->name }}
        </label>
      </div>
      @endforeach
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
  </form>

  @endsection



