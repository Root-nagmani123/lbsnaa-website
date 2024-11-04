@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h1>Manage Media Categories</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ isset($category) ? route('media-categories.update', $category->id) : route('media-categories.store') }}" method="POST">
    @csrf
    @if(isset($category))
        @method('PUT')
    @endif

    <div>
        <label>Media Gallery</label>
        <select name="media_gallery" required class="form-control">
            <option value="Photo Gallery" {{ isset($category) && $category->media_gallery == 'Photo Gallery' ? 'selected' : '' }}>Photo Gallery</option>
            <option value="Video Gallery" {{ isset($category) && $category->media_gallery == 'Video Gallery' ? 'selected' : '' }}>Video Gallery</option>
        </select>
    </div>

    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required class="form-control">
    </div>

    <div>
        <label>Hindi Name</label>
        <input type="text" name="hindi_name" value="{{ old('hindi_name', $category->hindi_name ?? '') }}" class="form-control">
    </div>

    <div>
        <label>Status</label>
        <select name="status" required class="form-control">
            <option value="1" {{ isset($category) && $category->status == '1' ? 'selected' : '' }}>Draft</option>
            <option value="2" {{ isset($category) && $category->status == '2' ? 'selected' : '' }}>Approval</option>
            <option value="3" {{ isset($category) && $category->status == '3' ? 'selected' : '' }}>Publish</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Submit' }}</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
    <a href="{{ route('media-categories.index') }}" class="btn btn-danger">Cancel</a>
</form>

<h2>Categories List</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Media Gallery</th>
            <th>Name</th>
            <th>Hindi Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->media_gallery }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->hindi_name }}</td>
            <td>
                @if ($item->status == 1)
                    Draft
                @elseif ($item->status == 2)
                    Approval
                @elseif ($item->status == 3)
                    Publish
                @else
                    Unknown
                @endif
            </td>
            <td>
                <a href="{{ route('media-categories.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('media-categories.destroy', $item->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
