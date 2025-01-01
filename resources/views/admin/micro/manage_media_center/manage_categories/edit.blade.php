@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Media Categories</span>
        </li>
    </ul>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Edit Media Categories</h4>
                </div>
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('photovideogallery.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">

                    <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label for="research_centre_id" class="label">Select Research Center</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="research_centre" id="research_centre_id" class="form-control text-dark ps-5 h-58">
                                        <option value="">Select Research Centre</option>
                                        @foreach ($researchCentres as $id => $name)
                                            <option value="{{ $id }}" {{ old('research_centre', $category->research_centre) == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('research_centre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="media_gallery">Media Gallery :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="media_gallery"
                                        id="media_gallery" required>
                                        <option value="" class="text-dark">Select</option>
                                        <option value="1" class="text-dark"
                                            {{ $category->media_gallery == '1' ? 'selected' : '' }}>Photo Gallery
                                        </option>
                                        <option value="2" class="text-dark"
                                            {{ $category->media_gallery == '2' ? 'selected' : '' }}>Video Gallery
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="name">Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="name" id="name"
                                        value="{{ old('name', $category->name) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="hindi_name">Hindi Name :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="hindi_name"
                                        id="hindi_name" value="{{ old('hindi_name', $category->hindi_name) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="category_image">Category Image:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <!-- File input for image -->
                                    <input type="file" class="form-control text-dark ps-5 h-58" name="category_image"
                                        id="category_image" accept="image/*">
                                    
                                    <!-- If there is an existing image, show it -->
                                    @if($category->category_image)
                                        <img src="{{ asset('storage/uploads/category_images/' . $category->category_image) }}"
                                            alt="Category Image" class="img-thumbnail mt-2" style="width: 150px; height: auto;">
                                    @endif
                                    @error('category_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status"
                                        required>
                                        <option value="1" class="text-dark"
                                            {{ $category->status == 1? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark"
                                            {{ $category->status == 0? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="{{ route('photovideogallery.index') }}"
                                class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection