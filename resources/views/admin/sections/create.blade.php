@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Module</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
                <i class="ri-arrow-right-double-line"></i>
                <span>Manage Organization Module</span>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Sections</span>
        </li>
    </ul>
</div>
@if(Cache::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Cache::get('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(Cache::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Cache::get('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(Cache::has('validation_errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach (Cache::get('validation_errors') as $field => $errors)
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Add Section</h4>
            </div>

                <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1" {{ old('language') == '1' ? 'checked' : '' }}>English
                                    <input type="radio" name="language" value="2" {{ old('language') == '2' ? 'checked' : '' }}>Hindi
                                   
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label class="label" for="title">Section Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="title" id="title" value="{{ old('title') }}">
                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="status" id="status">
                                    <option value="" class="text-dark" selected>Select</option>
                                        <option value="1" class="text-dark">Active</option>
                                        <option value="0" class="text-dark">Inactive</option>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>&nbsp;
                            <a href="{{ route('sections.index') }}" class="btn btn-secondary text-white fw-semibold">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection
