@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Module</h3> -->
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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Staff</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Staff Members</h4>

            <a href="{{ route('admin.staff.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New Staff</span>
                    </span>
                </button>
            </a>
        </div>
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
        <div class="default-table-area members-list recent-orders">
            <div class="table-responsive">
            <table class="table align-middle" id="sortableTable">
    <thead>
        <tr class="text-center">
            <th class="col">#</th>
            <th class="col">Name</th>
            <th class="col">Email</th>
            <th class="col">Designation</th>
            <th class="col">Actions</th>
            <th class="col">Status</th>
        </tr>
    </thead>
    <tbody id="sortable-staff">
        @foreach($staffMembers as $staff)
        <tr data-id="{{ $staff->id }}" class="sortable-row">
            <td class="handle" style="cursor: move;">☰</td> <!-- Drag handle -->
            <td>{{ $staff->name }}</td>
            <td>{{ $staff->email }}</td>
            <td>{{ $staff->designation }}</td>
            <td class="text-center">
                <div class="d-flex justify-content-center align-items-center gap-2">
                    <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-success text-white btn-sm">
                        Edit
                    </a>
                    <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary text-white btn-sm"
                            onclick="return confirm('Are you sure you want to delete?')">
                            Delete
                        </button>
                    </form>
                </div>
            </td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input status-toggle" type="checkbox" role="switch" data-table="staff_members"
                        data-column="page_status" data-id="{{$staff->id}}" {{$staff->page_status ? 'checked' : ''}}>
                </div>
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