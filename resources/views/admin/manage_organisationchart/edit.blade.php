@extends('admin.layouts.master')
@section('title', 'Edit Organisation Chart')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Organisation Chart</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Organisation Chart</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Edit Organisation Chart</h4>
                </div>
                <form action="{{ route('organisation_chart.update', $record->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <!-- Page Language -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="txtlanguage" value="1" {{ $record->language == '1' ? 'checked' : '' }}> English
                                    <input type="radio" name="txtlanguage" value="2" {{ $record->language == '2' ? 'checked' : '' }}> Hindi
                                </div>
                            </div>
                        </div>

                        <!-- Select Parent Employee -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Select Parent Employee :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="parentcategory" id="parentcategory" class="form-select form-control ps-5 h-58">
                                        <option value="" class="text-dark">Select Employee</option>
                                        @foreach ($faculty as $parent)
                                            <option class="text-dark" value={{ $parent->id }} {{ $record->faculty_id == $parent->id ? 'selected' : '' }}>
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
                                <label class="label">Select Employee :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" id="employee_name" name="employee_name" value="{{ $record->employee_name }}" class="form-control text-dark ps-5 h-58">
                                </div>
                            </div>
                        </div>

                        <!-- CKEditor for Description -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Description :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="description" id="description" class="form-control ps-5 text-dark">{{ $record->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Page Status -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Page Status:</label>
                                <select name="status" class="form-select form-control ps-5 h-58">
                                    <option value="">Select</option>
                                    <option value="1" {{ $record->status == '1' ? 'selected' : '' }}>Draft</option>
                                    <option value="2" {{ $record->status == '2' ? 'selected' : '' }}>Approval</option>
                                    <option value="3" {{ $record->status == '3' ? 'selected' : '' }}>Publish</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button>
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
