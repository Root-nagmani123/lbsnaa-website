@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Create Staff Member</h2>
        <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name *</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="name_in_hindi" class="col-sm-2 col-form-label">Name in Hindi</label>
                <div class="col-sm-10">
                    <input type="text" name="name_in_hindi" class="form-control" id="name_in_hindi">
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email *</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image Upload</label>
                <div class="col-sm-10">
                    <input type="file" name="image" class="form-control" id="image">
                </div>
            </div>

            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" id="description"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="description_in_hindi" class="col-sm-2 col-form-label">Description in Hindi</label>
                <div class="col-sm-10">
                    <textarea name="description_in_hindi" class="form-control" id="description_in_hindi"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="designation" class="col-sm-2 col-form-label">Designation *</label>
                <div class="col-sm-10">
                    <input type="text" name="designation" class="form-control" id="designation" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="designation_in_hindi" class="col-sm-2 col-form-label">Designation in Hindi</label>
                <div class="col-sm-10">
                    <input type="text" name="designation_in_hindi" class="form-control" id="designation_in_hindi">
                </div>
            </div>

            <div class="row mb-3">
                <label for="section" class="col-sm-2 col-form-label">Section</label>
                <div class="col-sm-10">
                    <select name="section" class="form-control" id="section">
                        <option value="">Select Section</option>
                      
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="country_code" class="col-sm-2 col-form-label">Country Code</label>
                <div class="col-sm-10">
                    <input type="text" name="country_code" class="form-control" id="country_code">
                </div>
            </div>

            <div class="row mb-3">
                <label for="std_code" class="col-sm-2 col-form-label">Std Code</label>
                <div class="col-sm-10">
                    <input type="text" name="std_code" class="form-control" id="std_code">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone_internal_office" class="col-sm-2 col-form-label">Phone Internal Office</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_internal_office" class="form-control" id="phone_internal_office">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone_internal_residence" class="col-sm-2 col-form-label">Phone Internal Residence</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_internal_residence" class="form-control" id="phone_internal_residence">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone_pt_office" class="col-sm-2 col-form-label">Phone P&T Office</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_pt_office" class="form-control" id="phone_pt_office">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone_pt_residence" class="col-sm-2 col-form-label">Phone P&T Residence</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_pt_residence" class="form-control" id="phone_pt_residence">
                </div>
            </div>

            <div class="row mb-3">
                <label for="mobile" class="col-sm-2 col-form-label">Mobile *</label>
                <div class="col-sm-10">
                    <input type="text" name="mobile" class="form-control" id="mobile" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="abbreviation" class="col-sm-2 col-form-label">Abbreviation</label>
                <div class="col-sm-10">
                    <input type="text" name="abbreviation" class="form-control" id="abbreviation">
                </div>
            </div>

            <div class="row mb-3">
                <label for="rank" class="col-sm-2 col-form-label">Rank</label>
                <div class="col-sm-10">
                    <input type="text" name="rank" class="form-control" id="rank">
                </div>
            </div>

            <div class="row mb-3">
                <label for="present_at_station" class="col-sm-2 col-form-label">Present at Station</label>
                <div class="col-sm-10">
                    <select name="present_at_station" class="form-control" id="present_at_station">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="acm_member" class="col-sm-2 col-form-label">ACM Member</label>
                <div class="col-sm-10">
                    <select name="acm_member" class="form-control" id="acm_member">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="acm_status_in_committee" class="col-sm-2 col-form-label">ACM Status in Committee</label>
                <div class="col-sm-10">
                    <input type="text" name="acm_status_in_committee" class="form-control" id="acm_status_in_committee">
                </div>
            </div>

            <div class="row mb-3">
                <label for="co_opted_member" class="col-sm-2 col-form-label">Co. Opted Member</label>
                <div class="col-sm-10">
                    <select name="co_opted_member" class="form-control" id="co_opted_member">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="page_status" class="col-sm-2 col-form-label">Page Status *</label>
                <div class="col-sm-10">
                    <select name="page_status" class="form-control" id="page_status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Staff Member</button>
        </form>
    </div>
@endsection
