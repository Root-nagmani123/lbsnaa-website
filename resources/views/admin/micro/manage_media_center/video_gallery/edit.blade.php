@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold fs-18 mb-sm-0">Edit Video Gallery</h4>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form action="{{ route('micro-video-gallery.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- This will force the form to send a PUT request -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="category_name">Category Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="category_name" id="category_name" required>
                                        <option value="" class="text-dark">Select</option>
                                        <option value="Audio" class="text-dark" {{ $video->category_name == 'Audio' ? 'selected' : '' }}>Audio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="video_title_en">Video Title (English) :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="video_title_en"
                                        id="video_title_en" value="{{ $video->video_title_en }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="video_title_hi">Audio Title (Hindi) :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="video_title_hi"
                                        id="video_title_hi" value="{{ $video->video_title_hi }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="audio_upload">Audio Upload (.mp4 only) :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark ps-5 h-58" name="video_upload"
                                        id="audio_upload" accept=".mp4,.mp3">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="page_status">Page Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="page_status" id="page_status" required>
                                        <option value="0" class="text-dark">Select</option>
                                        <option value="1" class="text-dark" {{ $video->page_status == '1' ? 'selected' : '' }}>Draft</option>
                                        <option value="2" class="text-dark" {{ $video->page_status == '2' ? 'selected' : '' }}>Approval</option>
                                        <option value="3" class="text-dark" {{ $video->page_status == '3' ? 'selected' : '' }}>Publish</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="{{ route('micro-video-gallery.index') }}" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>

                <!-- Display the current video if exists -->
                @if($video->video_upload)
                <div class="mt-4">
                    <h5>Current Video:</h5>
                    <video width="300" height="200" controls>
                        <source src="{{ asset('storage/' . $video->video_upload) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                @else
                    <p>No video uploaded</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection