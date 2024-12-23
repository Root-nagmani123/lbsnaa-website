@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Exam</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Exam</span>
        </li>
    </ul>
</div> 
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add Exam</h4>
                </div>

                <form action="{{ route('exam.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="txtlanguage" value="1"  {{ old('txtlanguage') == '1' ? 'checked' : '' }}>English
                                    <input type="radio" name="txtlanguage" value="2"  {{ old('txtlanguage') == '2' ? 'checked' : '' }}>Hindi
                                    @error('txtlanguage')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="exm_code">Exam Code :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="exm_code"
                                        id="exm_code"  value="{{ old('exm_code') }}">
                                    @error('exm_code')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="exm_desc">Exam Description :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="exm_desc"
                                        id="exm_desc"  value="{{ old('exm_desc') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="exm_user_id">User ID :</label>
                                <label class="label" for="exm_user_id">Accept numeric input only</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="number" class="form-control text-dark ps-5 h-58" name="exm_user_id"
                                        id="exm_user_id"  value="{{ old('name') }}">
                                        @error('exm_user_id')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="exm_date">Transaction Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark ps-5 h-58" name="exm_date"
                                        id="exm_date">
                                        @error('exm_date')
                                        <div style="color: red;">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="exm_date">Transaction Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="exm_date" id="exm_date"
                                     placeholder="DD-MM-YYYY"  value="{{ old('exm_date') }}">
                                    @error('exm_date')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="preliminary_flag" class="label">Preliminary Flag</label>
                                <div class="form-group position-relative">
                                    <input class="form-check-input" type="radio" name="preliminary_flag"
                                        id="preliminary_flag" value="1"  {{ old('preliminary_flag') == '1' ? 'checked' : '' }}> Yes
                                    <input class="form-check-input" type="radio" name="preliminary_flag"
                                        id="preliminary_flag" value="0" {{ old('preliminary_flag') == '0' ? 'checked' : '' }}> No
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="main_flag" class="label">Main Flag</label>
                                <div class="form-group position-relative">
                                    <input class="form-check-input" type="radio" name="main_flag" id="main_flag"
                                        value="1" {{ old('main_flag') == '1' ? 'checked' : '' }}> Yes
                                    <input class="form-check-input" type="radio" name="main_flag" id="main_flag"
                                        value="0" {{ old('main_flag') == '0' ? 'checked' : '' }}> No
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status">
                                        <option value="" class="text-dark" selected>Select</option>
                                        <option value="1" class="text-dark" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button> &nbsp;
                            <a href="{{ route('exam.index') }}" class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection

<!-- Include Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Include Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Initialize Flatpickr -->
<script>
    flatpickr("#exm_date", {
        dateFormat: "d-m-Y",  // Specify the "DD-MM-YYYY" format
        allowInput: true,     // Allows the user to type in the date
        maxDate: "today"      // Optional: Restrict to today's date or any other constraints
    });
</script>