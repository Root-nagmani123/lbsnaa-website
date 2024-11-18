@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold fs-18 mb-sm-0">Edit Media Category</h4>

    <!-- <a href="{{ route('media-center.create') }}">
        <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
            <span class="py-sm-1 d-block">
                <i class="ri-add-line text-white"></i>
                <span>Add New Audio</span>
            </span>
        </button>
    </a> -->
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
                <form action="{{ route('photovideogallery.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="media_gallery">Media Gallery :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="media_gallery" id="media_gallery" required>
                                        <option value="" class="text-dark">Select</option>
                                        <option value="1" class="text-dark" {{ $category->media_gallery == '1' ? 'selected' : '' }}>Photo Gallery</option>
                                        <option value="2" class="text-dark" {{ $category->media_gallery == '2' ? 'selected' : '' }}>Video Gallery</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="name">Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="name"
                                        id="name" value="{{ old('name', $category->name) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="hindi_name">Hindi Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="hindi_name"
                                        id="hindi_name" value="{{ old('hindi_name', $category->hindi_name) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status" required>
                                        <option value="0" class="text-dark">Select</option>
                                        <option value="1" class="text-dark" {{ $category->status == '1' ? 'selected' : '' }}>Draft</option>
                                        <option value="2" class="text-dark" {{ $category->status == '2' ? 'selected' : '' }}>Approval</option>
                                        <option value="3" class="text-dark" {{ $category->status == '3' ? 'selected' : '' }}>Publish</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="{{ route('photovideogallery.index') }}" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
