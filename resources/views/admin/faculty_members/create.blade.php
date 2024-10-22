@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Add Faculty Member</h2>
    
    <form action="{{ route('admin.faculty.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="category">Category *</label>
                <select name="category" class="form-control" required>
                        <option value=" ">Select Category</option>
                    <option value="1">Inhouse</option>
                    <option value="2">Visiting</option>
 
</select>
            </div>

            <div class="col-md-6">
                <label for="name">Name *</label>
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name_in_hindi">Name in Hindi</label>
                <input type="text" name="name_in_hindi" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="email">Email *</label>
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="image">Upload Image *</label>
                <input type="file" name="image" class="form-control" >
            </div>

            <div class="col-md-6">
                <label for="description">Description *</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="description_in_hindi">Description in Hindi</label>
                <textarea name="description_in_hindi" class="form-control"></textarea>
            </div>

            <div class="col-md-6">
                <label for="designation">Designation *</label>
                <input type="text" name="designation" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="designation_in_hindi">Designation in Hindi</label>
                <input type="text" name="designation_in_hindi" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="cadre">Cadre</label>
                <select name="cadre" class="form-control">
                    <option value="">Select Cadre</option>
                    <option value="1">AM</option>
                    <option value="2">AP</option>
                    <!-- Add your options here -->
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="batch">Batch</label>
                <select name="batch" class="form-control">
                    <option value="">Select Batch</option>
                    <option value="1950">1950</option>
                    <option value="1951">1951</option>
                    <!-- Add your options here -->
                </select>
            </div>

            <div class="col-md-6">
                <label for="service">Service</label>
                <input type="text" name="service" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="country_code">Country Code</label>
                <input type="text" name="country_code" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="std_code">STD Code</label>
                <input type="text" name="std_code" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="phone_internal_office">Phone Internal Office</label>
                <input type="text" name="phone_internal_office" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="phone_internal_residence">Phone Internal Residence</label>
                <input type="text" name="phone_internal_residence" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="phone_pt_office">Phone P&T Office</label>
                <input type="text" name="phone_pt_office" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="phone_pt_residence">Phone P&T Residence</label>
                <input type="text" name="phone_pt_residence" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="abbreviation">Abbreviation</label>
                <input type="text" name="abbreviation" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="rank">Rank</label>
                <select name="rank" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="present_at_station">Present at Station</label>
                <select name="present_at_station" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="acm_member">ACM Member</label>
                <select name="acm_member" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="acm_status_in_committee">ACM Status in Committee</label>
                <input type="text" name="acm_status_in_committee" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="co_opted_member">Co-Opted Member</label>
                <select name="co_opted_member" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="page_status">Page Status *</label>
                <select name="page_status" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Add Faculty Member</button>
    </form>
</div>
@endsection
