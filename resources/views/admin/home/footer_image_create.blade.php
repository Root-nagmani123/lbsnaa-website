@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Footer Image</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Footer</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">Add Footer Image</h4>
            </div>
            <form action="{{ route('admin.footer_images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="language" class="label">Page Language :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="radio" name="language" value="1"> English
                                <input type="radio" name="language" value="2"> Hindi

                                @error('language')
                                <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="title">Title :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" class="form-control text-dark ps-5 h-58" id="title" name="title">

                                @error('title')
                                <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="link">URL :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" class="form-control text-dark ps-5 h-58" id="link" name="link">

                                @error('link')
                                <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="image">Image :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="file" class="form-control text-dark ps-5 h-58" id="image" name="image">

                                @error('image')
                                <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label" for="description">Description :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <textarea name="description" id="description" class="form-control ps-5 text-dark"
                                    rows="5"></textarea>

                                @error('description')
                                <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="status">Status :</label>
                            <span class="star">*</span>
                            <select name="status" id="status" class="form-control text-dark ps-5 h-58">
                                <option value="" selected>Select</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>

                            @error('status')
                            <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex ms-sm-3 ms-md-0">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                        &nbsp;
                        <a href="{{ route('admin.footer_images.index') }}" class="btn btn-secondary text-white">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- here this code use for the editer js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$('#description').summernote({
    tabsize: 2,
    height: 300
});
</script>  
<!-- here this code end of the editer js -->
@endsection