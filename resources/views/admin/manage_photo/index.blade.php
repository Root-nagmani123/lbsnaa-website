@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h1>Manage Photo Gallery</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('photo-gallery.create') }}" class="btn btn-primary">Add Photo Gallery</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Image Title (English)</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($galleries as $gallery)
        <tr>
            <td>{{ $gallery->id }}</td>
            <td>{{ $gallery->category_name }}</td>
            <td>{{ $gallery->image_title_english }}</td>
            <td>
                @if ($gallery->status == 1)
                    Draft
                @elseif ($gallery->status == 2)
                    Approval
                @elseif ($gallery->status == 3)
                    Publish
                @else
                    Unknown
                @endif
            </td>
            <td>
                <a href="{{ route('photo-gallery.edit', $gallery->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('photo-gallery.destroy', $gallery->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
