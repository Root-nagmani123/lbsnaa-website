@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Add Faculty Memeber</h3>
    <!-- <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font dot ms-2">Manage Organization Module</span>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Faculty</span>
        </li>
    </ul> -->
    <a href="{{ route('admin.faculty.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Faculty Member</span>
                    </span>
                </button>
            </a>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <!-- <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Faculty Members</h4>

            <a href="{{ route('admin.faculty.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Faculty Member</span>
                    </span>
                </button>
            </a>
        </div> -->
        @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        <div class="default-table-area members-list recent-orders">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                       
                            <th class="col">Name</th>
                            <th class="col">Email</th>
                            <th class="col">Designation</th>
                            <th class="col">Mobile</th>
                            <th class="col">Category</th>
                            <th class="col">Image</th>
                            <th class="col">Status</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($facultyMembers as $faculty)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                           
                            <td>{{ $faculty->name }}</td>
                            <td>{{ $faculty->email }}</td>
                            <td>{{ $faculty->designation }}</td>
                            <td>{{ $faculty->mobile }}</td>
                            <td>{{ $faculty->category }}</td>
                            <td>
                                @if($faculty->image)
                                    <img src="{{ asset($faculty->image) }}" alt="Faculty Image" width="50" height="50">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                @if($faculty->page_status == 1)
                                    <span class="badge bg-success bg-opacity-10 text-success py-2 px-3 fw-semibold d-block text-center">Active</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger py-2 px-3 fw-semibold d-block text-center">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.faculty.edit', $faculty->id) }}"
                                    class="btn btn-success text-white">Edit</a>
                                <form action="{{ route('admin.faculty.destroy', $faculty->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-primary text-white" onclick="return confirm('Are you sure you want to delete this faculty member?')">Delete</button>
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
@endsection
