@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Chart</h3> -->
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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Organization Chart</span>
        </li>
    </ul>
</div> 
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add Organization Structure</h4>
                </div>
                <form action="{{ route('organisation_chart.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <!-- Page Language -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"> English
                                    <input type="radio" name="language" value="2"> Hindi
                                </div>
                                @error('language')
                                    <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                @enderror
                            </div>
                        </div> 

                        <!-- Select Parent Employee -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Select Parent Employee :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="parentcategory" id="parentcategory"
                                        class="form-select form-control  h-58">
                                        <option value="">Select Employee</option>
                                        @foreach ($records as $record)
                                        <option value={{ $record->id }} {{ $record->id == $organisation_chart->employee_name ? 'selected' : '' }}>{{ $record->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parentcategory')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Select Employee with Autocomplete -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Select Category :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" id="employee_name" name="employee_name" autocomplete="" class="form-control text-dark  h-58"> -->
                                    <select name="employee_name" id="employee_name"
                                        class="form-select form-control  h-58">
                                        <option value="" class="text-dark">Select </option>
                                        @foreach ($records as $record)
                                        <option value={{ $record->id }}>{{ $record->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_name')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Page Status -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Page Status:</label>
                                <span class="star">*</span>
                                <select name="status" class="form-select form-control  h-58">
                                    <option value="" class="text-dark" selected>Select</option>
                                    <option value="1" class="text-dark">Active</option>
                                    <option value="0" class="text-dark">Inactive</option>
                                </select>
                                @error('status')
                                    <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex ms-sm-3 ms-md-0">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>&nbsp;
                        
                        <a href="{{ route('organisation-chart.sub-org', ['parent_id' => $parent_id]) }}" class="btn btn-secondary text-white">Back</a>


                    </div>              
            </div>

            </form>
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