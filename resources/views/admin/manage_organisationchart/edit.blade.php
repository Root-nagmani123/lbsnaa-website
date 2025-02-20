@extends('admin.layouts.master')
@section('title', 'Edit Organisation Chart')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Organisation Chart</h3> -->
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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Organisation Chart</span>
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
                    <h4 class="fw-semibold fs-18 mb-0">Edit Organisation Chart</h4>
                </div>
                

                <form action="{{ route('organisation_chart.update', $record->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="parent_id" value="{{ $record->parent_id }}">
                        <!-- Page Language -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        {{ $record->language == '1' ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2"
                                        {{ $record->language == '2' ? 'checked' : '' }}> Hindi
                                </div>
                            </div>
                        </div>


                        <!-- Select Parent Employee -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Select Parent Employee :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="parentcategory" id="parentcategory"
                                        class="form-select form-control  h-58">
                                        <option value="" class="text-dark">Select Employee</option>
                                        @foreach ($faculty as $parent)
                                        <option class="text-dark" value="{{ $parent->id }}"
                                            {{ $record->faculty_id == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <!-- Select Employee with Autocomplete -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Select Category :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" id="employee_name" name="employee_name" value="{{ $record->employee_name }}" class="form-control text-dark  h-58"> -->
                                    <select name="employee_name" id="employee_name"
                                        class="form-select form-control  h-58">
                                        <option value="" class="text-dark">Select </option>
                                        @foreach ($faculty as $parent)
                                        <option class="text-dark" value="{{ $parent->id }}"
                                            {{ $record->employee_name == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <!-- Page Status -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Page Status:</label>
                                <select name="status" class="form-select form-control  h-58">
                                    <option value="1" {{ $record->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $record->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex ms-sm-3 ms-md-0">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Update</button>&nbsp;
                        <a href="{{ route('organisation-chart.sub-org', ['parent_id' => $parent_id ?? 0]) }}"
                            class="btn btn-secondary text-white">Back</a>



                        <!-- <a href="{{ route('organisation_chart.index') }}" class="btn btn-secondary text-white">Back</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and jQuery UI for Autocomplete -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- Autocomplete Script -->
<script>
$(function() {
    $("#employee_name").autocomplete({
        source: "{{ route('employee.autocomplete') }}",
        minLength: 2
    });
});
</script>
@endsection