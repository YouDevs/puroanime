@extends('layouts.admin')

@section('content')
    <h1>Editar Anime</h1>
    <form action="{{ route('admin.anime.update', ['id' => $anime->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group mt-2">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $anime->title) }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $anime->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="cover_image">Cover Image</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control">
            @error('cover_image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="thumbnail_image">Thumbnail Image</label>
            <input type="file" name="thumbnail_image" id="thumbnail_image" class="form-control">
            @error('thumbnail_image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update Anime</button>
    </form>
@endsection
