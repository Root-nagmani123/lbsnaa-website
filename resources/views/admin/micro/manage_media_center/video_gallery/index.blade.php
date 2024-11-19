@extends('admin.layouts.master')
@section('title', 'Manage Video Gallery')

@section('content')

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Center</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Video Gallery</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Manage Video Gallery</h4>
            <a href="{{ route('micro-video-gallery.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New Video</span>
                    </span>
                </button>
            </a>
        </div>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
              <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>  <!-- Index Column -->
                            <th class="col">Category</th>
                            <th class="col">Video Title (English)</th>
                            <th class="col">Video Title (Hindi)</th>
                            <th class="col">Page Status</th>
                            <th class="col">Video</th>  <!-- Video Display Column -->
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($videos as $video)
                <tr>
                    <td>{{ $loop->iteration }}</td>  <!-- Display Index -->
                    <td>{{ $video->category_name }}</td>
                    <td>{{ $video->video_title_en }}</td>
                    <td>{{ $video->video_title_hi }}</td>
                <td>
                    @if ($video->page_status == 1)
                    <span
                        class="badge bg-warning bg-opacity-10 text-warning py-2 fw-semibold text-center">Draft</span>
                    @elseif ($video->page_status == 2)
                    <span
                        class="badge bg-primary bg-opacity-10 text-primary py-2 fw-semibold text-center">Approval</span>
                    @elseif ($video->page_status == 3)
                    <span
                        class="badge bg-danger bg-opacity-10 text-danger py-2 fw-semibold text-center">Publish</span>
                    @endif
                </td>
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
                                <a href="{{ route('micro-video-gallery.edit', $video->id) }}"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('micro-video-gallery.destroy', $video->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
