@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Media Gallery</h2>
    <a href="{{ route('video_gallery.create') }}" class="btn btn-primary">Add New Video</a>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th> <!-- Index column header -->
                <th>Category Name</th>
                <th>Audio Title (English)</th>
                <th>Audio Title (Hindi)</th>
                <th>Audio File</th>
                <th>Page Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($media as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Display row number here -->
                    <td>{{ $item->category_name }}</td>
                    <td>{{ $item->audio_title_en }}</td>
                    <td>{{ $item->audio_title_hi }}</td>
                    <td><a href="{{ $item->video_upload }}" target="_blank">View Video</a></td>
                    <td>
                        @if ($item->page_status == 1)
                            Draft
                        @elseif ($item->page_status == 2)
                            Approval
                        @elseif ($item->page_status == 3)
                            Publish
                        @else
                            Unknown
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('video_gallery.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('video_gallery.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
