@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h1>Edit Media Category</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('media-categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Media Gallery</label>
        <select name="media_gallery" required class="form-control">
            <option value="Photo Gallery" {{ $category->media_gallery == 'Photo Gallery' ? 'selected' : '' }}>Photo Gallery</option>
            <option value="Video Gallery" {{ $category->media_gallery == 'Video Gallery' ? 'selected' : '' }}>Video Gallery</option>
        </select>
    </div>

    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="form-control">
    </div>

    <div>
        <label>Hindi Name</label>
        <input type="text" name="hindi_name" value="{{ old('hindi_name', $category->hindi_name) }}" class="form-control">
    </div>

    <div>
        <label>Status</label>
        <select name="status" required class="form-control">
            <option value="1" {{ $category->status == '1' ? 'selected' : '' }}>Draft</option>
            <option value="2" {{ $category->status == '2' ? 'selected' : '' }}>Approval</option>
            <option value="3" {{ $category->status == '3' ? 'selected' : '' }}>Publish</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('media-categories.index') }}" class="btn btn-danger">Cancel</a>
</form>
@endsection
