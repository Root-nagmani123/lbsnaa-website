@extends('admin.layouts.master')
@section('title', 'Manage Video Gallery')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold fs-18 mb-sm-0">Manage Video Gallery</h4>
    <a href="{{ route('micro-video-gallery.create') }}">
        <button class="btn btn-success">Add New Video</button>
    </a>
</div>

<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>  <!-- Index Column -->
                    <th>Category</th>
                    <th>Video Title (English)</th>
                    <th>Video Title (Hindi)</th>
                    <th>Page Status</th>
                    <th>Video</th>  <!-- Video Display Column -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                <tr>
                    <td>{{ $loop->iteration }}</td>  <!-- Display Index -->
                    <td>{{ $video->category_name }}</td>
                    <td>{{ $video->video_title_en }}</td>
                    <td>{{ $video->video_title_hi }}</td>
                    <td>{{ $video->page_status == 1 ? 'Draft' : ($video->page_status == 2 ? 'Approval' : 'Publish') }}</td>

                    <!-- Display the uploaded video -->
                    <td>
                        @if($video->video_upload)
                            <!-- Assuming video_upload is the file path in your database -->
                            <video width="150" height="100" controls>
                                <source src="{{ asset('storage/' . $video->video_upload) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            No Video Uploaded
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('micro-video-gallery.edit', $video->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('micro-video-gallery.destroy', $video->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
