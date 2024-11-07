@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Manage organistion chart</h4>
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
                                        <input type="radio" name="txtlanguage" value="1">English
                                        <input type="radio" name="txtlanguage" value="2">Hindi
                                    </div>
                                </div>
                            </div>

                            <!-- Select Parent Employee -->
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="menutitle">Select Parent Employee :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <select name="parentcategory" id="parentcategory">
                                            <option value="">Select Employee</option>
                                            @foreach ($records as $record)
                                                <option value={{ $record->id }}>{{ $record->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Select Employee with Autocomplete -->
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="menutitle">Select Employee :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="text" id="employee_name" name="employee_name" autocomplete="">
                                    </div>
                                </div>
                            </div>

                            <!-- CKEditor for Description -->

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="Description">Description :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <textarea name="description" id="description"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Page Status -->
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label>Page Status:</label>
                                    <select name="status">
                                        <option value="">Select</option>
                                        <option value="1">Draft</option>
                                        <option value="2">Approval</option>
                                        <option value="3">Publish</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit">Submit</button>
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
