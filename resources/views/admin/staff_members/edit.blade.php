@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">
        <h2>Edit Staff Member</h2>
        <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name *</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" value="{{ $staff->name }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="name_in_hindi" class="col-sm-2 col-form-label">Name in Hindi</label>
                <div class="col-sm-10">
                    <input type="text" name="name_in_hindi" class="form-control" id="name_in_hindi" value="{{ $staff->name_in_hindi }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email *</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="email" value="{{ $staff->email }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image Upload</label>
                <div class="col-sm-10">
                    <input type="file" name="image" class="form-control" id="image">
                    @if($staff->image)
                        <img src="{{ asset($staff->image) }}" alt="Staff Image" width="100">
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" id="description">{{ $staff->description }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="description_hindi" class="col-sm-2 col-form-label">Description in Hindi</label>
                <div class="col-sm-10">
                    <textarea name="description_in_hindi" class="form-control" id="description_in_hindi">{{ $staff->description_in_hindi }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="designation" class="col-sm-2 col-form-label">Designation *</label>
                <div class="col-sm-10">
                    <input type="text" name="designation" class="form-control" id="designation" value="{{ $staff->designation }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="designation_hindi" class="col-sm-2 col-form-label">Designation in Hindi</label>
                <div class="col-sm-10">
                    <input type="text" name="designation_in_hindi" class="form-control" id="designation_in_hindi" value="{{ $staff->designation_in_hindi }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="section" class="col-sm-2 col-form-label">Section</label>
                <div class="col-sm-10">
                    <select name="section" class="form-control" id="section">
                        <option value="Section 1" {{ $staff->section == 'Section 1' ? 'selected' : '' }}>Section 1</option>
                        <option value="Section 2" {{ $staff->section == 'Section 2' ? 'selected' : '' }}>Section 2</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="country_code" class="col-sm-2 col-form-label">Country Code</label>
                <div class="col-sm-10">
                    <input type="text" name="country_code" class="form-control" id="country_code" value="{{ $staff->country_code }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="std_code" class="col-sm-2 col-form-label">Std Code</label>
                <div class="col-sm-10">
                    <input type="text" name="std_code" class="form-control" id="std_code" value="{{ $staff->std_code }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone_office" class="col-sm-2 col-form-label">Phone Internal Office</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_internal_office" class="form-control" id="phone_internal_office" value="{{ $staff->phone_internal_office }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone_residence" class="col-sm-2 col-form-label">Phone Internal Residence</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_internal_residence" class="form-control" id="phone_internal_residence" value="{{ $staff->phone_internal_residence }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone_pt_office" class="col-sm-2 col-form-label">Phone P&T Office</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_pt_office" class="form-control" id="phone_pt_office" value="{{ $staff->phone_pt_office }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone_pt_residence" class="col-sm-2 col-form-label">Phone P&T Residence</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_pt_residence" class="form-control" id="phone_pt_residence" value="{{ $staff->phone_pt_residence }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="mobile" class="col-sm-2 col-form-label">Mobile *</label>
                <div class="col-sm-10">
                    <input type="text" name="mobile" class="form-control" id="mobile" value="{{ $staff->mobile }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="abbreviation" class="col-sm-2 col-form-label">Abbreviation</label>
                <div class="col-sm-10">
                    <input type="text" name="abbreviation" class="form-control" id="abbreviation" value="{{ $staff->abbreviation }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="rank" class="col-sm-2 col-form-label">Rank</label>
                <div class="col-sm-10">
                    <input type="text" name="rank" class="form-control" id="rank" value="{{ $staff->rank }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="present_station" class="col-sm-2 col-form-label">Present at Station</label>
                <div class="col-sm-10">
                    <select name="present_station" class="form-control" id="present_station">
                        <option value="1" {{ $staff->present_station == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $staff->present_station == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="acm_member" class="col-sm-2 col-form-label">ACM Member</label>
                <div class="col-sm-10">
                    <select name="acm_member" class="form-control" id="acm_member">
                        <option value="1" {{ $staff->acm_member == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $staff->acm_member == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="acm_status" class="col-sm-2 col-form-label">ACM Status in Committee</label>
                <div class="col-sm-10">
                    <input type="text" name="acm_status_in_committee" class="form-control" id="acm_status_in_committee" value="{{ $staff->acm_status_in_committee }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="co_opted_member" class="col-sm-2 col-form-label">Co. Opted Member</label>
                <div class="col-sm-10">
                    <select name="co_opted_member" class="form-control" id="co_opted_member">
                        <option value="1" {{ $staff->co_opted_member == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $staff->co_opted_member == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="page_status" class="col-sm-2 col-form-label">Page Status</label>
                <div class="col-sm-10">
                    <select name="page_status" class="form-control" id="page_status">
                        <option value="1" {{ $staff->page_status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $staff->page_status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Staff</button>
        </form>
    </div>
@endsection
