@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage User Management</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fs-14 heading-font text-dark ms-2">> User Management</span>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Module</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Manage Module</h4>
            <button type="button" class="btn btn btn-success py-2 px-4 fw-semibold rounded-3 text-white"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Module
            </button>
        </div>
        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Parent</th>
                            <th class="col">Child</th>
                            <th class="col">Status</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Display Index -->
                            <td>{{ $permission->parent }}</td>
                            <td>{{ $permission->child }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="modules" data-column="status" data-id="{{$permission->id}}"
                                        {{$permission->status ? 'checked' : ''}}>
                                </div>
                            </td>
                            <td>
                                <!-- Delete Form -->
                                <form action="{{ route('module.destroy', $permission->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-primary btn-sm text-white"
                                        onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Permission</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add Permission Form -->
                <form action="{{ route('module.store') }}" method="POST" class="mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="parent" class="label">Module</label>
                                <span class="star">*</span>
                                <div class="fomr-group position-relative">
                                    <select name="parent" id="parent" class="form-control text-dark ps-5 h-58">
                                        <option value="" selected>Select Module</option>
                                        <option value="User Management">User Management</option>
                                        <option value="Manage CMS">Manage CMS</option>
                                        <option value="Manage Organization Module">Manage Organization Module</option>
                                        <option value="Training Master Management">Training Master Management</option>
                                        <option value="Manage Course Module">Manage Course Module</option>
                                        <option value="Quick Link">Quick Link</option>
                                        <option value="Manage News">Manage News</option>
                                        <option value="Manage Training Programs">Manage Training Programs</option>
                                        <option value="Manage Media Center">Manage Media Center</option>
                                        <option value="Research Center">Research Center</option>
                                        <option value="Mirco Manage Media Center">Mirco Manage Media Center</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="child" class="label">Sub-module</label>
                                <span class="star">*</span>
                                <div class="fomr-group position-relative">
                                    <select name="child" id="child" class="form-control text-dark ps-5 h-58">
                                        <option value="" selected>Select Sub-Module</option>
                                        <option value="Manage User">Manage User</option>
                                        <option value="Manage Module">Manage Module</option>
                                        <option value="Manage Menu">Manage Menu</option>
                                        <option value="Manage Organization Chart">Manage Organization Chart</option>
                                        <option value="Manage Faculty">Manage Faculty</option>
                                        <option value="Manage Staff">Manage Staff</option>
                                        <option value="Manage Sections">Manage Sections</option>
                                        <option value="Manage Organiser">Manage Organiser</option>
                                        <option value="Manage Coordinator">Manage Coordinator</option>
                                        <option value="Manage Venue">Manage Venue</option>
                                        <option value="Manage Founder">Manage Founder</option>
                                        <option value="Manage Cadre">Manage Cadre</option>
                                        <option value="Manage Category">Manage Category</option>
                                        <option value="Manage Country">Manage Country</option>
                                        <option value="Manage State">Manage State</option>
                                        <option value="Manage Districts">Manage Districts</option>
                                        <option value="Manage Exam">Manage Exam</option>
                                        <option value="Manage News">Manage News</option>
                                        <option value="Quick Links">Quick Links</option>
                                        <option value="Manage Tender">Manage Tender</option>
                                        <option value="Manage Master Categories">Manage Master Categories</option>
                                        <option value="Manage Academy Souvenir">Manage Academy Souvenir</option>
                                        <option value="Manage Course Category/Subcategory">Manage Course Category/Subcategory</option>
                                        <option value="Manage Course">Manage Course</option>
                                        <option value="Manage Survey List">Manage Survey List</option>
                                        <option value="Manage Vacancy">Manage Vacancy</option>
                                        <option value="Manage Social Media">Manage Social Media</option>
                                        <option value="Manage Logo">Manage Logo</option>
                                        <option value="Feedback List">Feedback List</option>
                                        <option value="Home Banner">Home Banner</option>
                                        <option value="Audio Gallery">Audio Gallery</option>
                                        <option value="Photo Gallery">Photo Gallery</option>
                                        <option value="Video Gallery">Video Gallery</option>
                                        <option value="Add Category">Add Category</option>
                                        <option value="Manage Audit">Manage Audit</option>
                                        <option value="Research Center">Research Center</option>
                                        <option value="Mirco Manage Menu">Mirco Manage Menu</option>
                                        <option value="Micro Quick Links">Micro Quick Links</option>
                                        <option value="Mirco Manage News">Mirco Manage News</option>
                                        <option value="Manage Training Programs">Manage Training Programs</option>
                                        <option value="Manage Organization Setup">Manage Organization Setup</option>
                                        <option value="Mirco Manage Vacancy">Mirco Manage Vacancy</option>
                                        <option value="Mirco Home Banner">Mirco Home Banner</option>
                                        <option value="Mirco Photo Gallery">Mirco Photo Gallery</option>
                                        <option value="Mirco Video Gallery">Mirco Video Gallery</option>
                                        <option value="Mirco Add Category">Mirco Add Category</option>
                                        <option value="Micro Manage Audit">Micro Manage Audit</option>
                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="status" class="label">Status</label>
                                <span class="star">*</span>
                                <div class="fomr-group position-relative">
                                    <select name="status" id="status" class="form-control text-dark ps-5 h-58">
                                        <option value="" selected>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success text-white">Submit</button>
                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection