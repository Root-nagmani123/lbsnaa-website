@extends('admin.layouts.master')
@section('title', 'Add Video Gallery')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold fs-18 mb-sm-0">Add Video Gallery</h4>
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
                <form action="{{ route('micro-video-gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="category_name">Category Name :</label>
                                <select name="category_name" id="category_name" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Video">Video</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="video_title_en">Video Title (English) :</label>
                                <input type="text" name="video_title_en" id="video_title_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="video_title_hi">Video Title (Hindi) :</label>
                                <input type="text" name="video_title_hi" id="video_title_hi" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="video_upload">Video Upload (.mp4 only) :</label>
                                <input type="file" name="video_upload" id="video_upload" class="form-control" accept=".mp4" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="page_status">Page Status :</label>
                                <select name="page_status" id="page_status" class="form-control" required>
                                    <option value="1">Draft</option>
                                    <option value="2">Approval</option>
                                    <option value="3">Publish</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <a href="{{ route('micro-video-gallery.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
