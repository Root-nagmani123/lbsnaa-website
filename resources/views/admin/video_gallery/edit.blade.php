@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Media Gallery</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Gallery</span>
        </li>
    </ul>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">Edit Video Gallery</h4>
            </div>

            <form action="{{ route('video_gallery.update', $media->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Category -->
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="category_name">Category Name :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="category_name" id="category_name" class="form-control">
                                @foreach ($mediaCategories as $id => $name)

                                        <option value="{{ $id }}" {{ old('media_categories', $gallery->media_gallery ?? '') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                            
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Video Title -->
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="audio_title_en">Video Title (English) :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" class="form-control text-dark ps-5 h-58" id="audio_title_en"
                                    name="audio_title_en" value="{{ $media->audio_title_en }}">
                                @error('audio_title_en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="audio_title_hi">Video Title (Hindi) :</label>
                            <div class="form-group position-relative">
                                <input type="text" class="form-control text-dark ps-5 h-58" id="audio_title_hi"
                                    name="audio_title_hi" value="{{ $media->audio_title_hi }}">
                            </div>
                        </div>
                    </div>

                    <!-- YouTube Video Link -->
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="video_upload">YouTube Video Link:</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="url" class="form-control text-dark ps-5 h-58" id="video_upload"
                                    name="video_upload" placeholder="https://www.youtube.com/watch?v=example"
                                    value="{{ old('video_upload', $media->video_upload ?? '') }}">
                                @error('video_upload')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Embed Video (YouTube) -->
                    @if (!empty($media->video_upload))
                        @php
                            // Regular expression to extract video ID from various YouTube URL formats
                            $url = $media->video_upload;
                            preg_match('/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:.*(?:v|e(?:mbed)?)\/|\S+?v=)([A-Za-z0-9_-]{11}))/i', $url, $matches);
                            $videoId = $matches[1] ?? null;
                        @endphp

                        @if ($videoId)
                            <!-- Embed YouTube video using iframe -->
                            <div class="col-lg-12">
                                <div class="video-embed">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen style="width:300px; height:300px;"></iframe>
                                </div>
                            </div>
                        @else
                            <!-- Error message for invalid YouTube URL -->
                            <div class="col-lg-12">
                                <p class="text-danger">Invalid YouTube URL. Please provide a valid link in the format: https://www.youtube.com/watch?v=VIDEO_ID</p>
                            </div>
                        @endif
                    @endif

                    <!-- Status -->
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="page_status">Status :</label>
                            <span class="star">*</span>
                            <select name="page_status" id="page_status" class="form-control" required>
                                <option value="1" {{ $media->page_status == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $media->page_status == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex ms-sm-3 ms-md-0">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Update</button>
                        &nbsp;
                        <a href="{{ route('video_gallery.index') }}" class="btn btn-secondary text-white">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
