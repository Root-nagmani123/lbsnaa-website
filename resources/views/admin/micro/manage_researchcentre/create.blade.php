@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Research Centers</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Research</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">Add Research Center</h4>
            </div>
            <form action="{{ route('researchcentres.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="language" class="label">Page Language</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="radio" name="language" id="language" value="1"
                                    {{ old('language') == 1 ? 'checked' : '' }}> English
                                <input type="radio" name="language" id="language" value="2"
                                    {{ old('language') == 2 ? 'checked' : '' }}> Hindi
                            </div>
                            @error('language')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="research_centre_name" class="label">Research center name</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="research_centre_name" id="research_centre_name"
                                    class="form-control text-dark  h-58" value="{{ old('research_centre_name') }}">
                            </div>
                            @error('research_centre_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="sub_heading" class="label">Sub Heading</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="sub_heading" id="sub_heading"
                                    class="form-control text-dark  h-58" value="{{ old('sub_heading') }}">
                            </div>
                            @error('sub_heading')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="home_title" class="label">Home title</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="home_title" id="home_title"
                                    class="form-control text-dark  h-58" value="{{ old('home_title') }}">
                            </div>
                            @error('home_title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label" for="description">Description :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <textarea class="form-control" id="description" placeholder="Enter the Description"
                                    name="description" rows="5">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="status">Status :</label>
                            <span class="star">*</span>
                            <select name="status" id="status" class="form-control">
                                <option value="" selected>Select</option>
                                <option value="1" >Active</option>
                                <option value="0" >Inactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex ms-sm-3 ms-md-0">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                        &nbsp;
                        <a href="{{ route('researchcentres.index') }}" class="btn btn-secondary text-white">Back</a>
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