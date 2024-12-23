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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">User Management</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">User Management</h4>
            <button type="button" class="btn btn btn-outline-primary py-2 px-4 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add Module
</button>
        </div>
        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Parent</th>
                            <th class="col">Child</th>
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
                               <!-- Delete Form -->
                                <form action="{{ route('module.destroy', $permission->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
    <div class="modal-dialog">
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
                <div class="col-lg-6">
                    <select name="parent" id="parent" class="form-control text-dark ps-5 h-58">
                        <option value="" selected>Select Module</option>
                        <option value="1">Manage CMS</option>
                        <option value="2">Manage Organization Module</option>
                        <option value="3">Training Master Management</option>
                        <option value="4">Manage News</option>
                        <option value="5">Quick Link</option>
                    </select>
                </div>
                <div class="col-lg-6">
                <select name="child" id="child" class="form-control text-dark ps-5 h-58">
                        <option value="" selected>Select Module</option>
                        <option value="1">Manage CMS</option>
                        <option value="2">Manage Organization Module</option>
                        <option value="3">Training Master Management</option>
                        <option value="4">Manage News</option>
                        <option value="5">Quick Link</option>
                    </select>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary text-white">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection