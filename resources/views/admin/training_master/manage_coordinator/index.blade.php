@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Co-ordinators</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Co-ordinator</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Co-ordinators</h4>
            
            <a href="{{ route('coordinators.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Co-ordinator</span>
                    </span>
                </button>
            </a>
        </div>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="default-table-area members-list">
    <div class="table-responsive">
        <table class="table align-middle" id="myTable">
            <thead>
                <tr class="text-center">
                    <th class="col">#</th> <!-- Add this column for indexing -->
                    <th class="col">Page Language</th>
                    <th class="col">Coordinator Name</th>
                    <th class="col">Actions</th>
                    <th class="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coordinators as $coordinator)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                            <td>{{ $coordinator->page_language == 1 ? 'English' : 'Hindi' }}</td>
                            <td>{{ $coordinator->coordinator_name }}</td>
                            <td>
                                <a href="{{ route('coordinators.edit', $coordinator->id) }}" class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('coordinators.destroy', $coordinator->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            </td>
                            <td><div class="form-check form-switch">
            <input class="form-check-input status-toggle" type="checkbox" role="switch"  data-table="manage_coordinators" 
            data-column="status" data-id="{{$coordinator->id}}" {{$coordinator->status ? 'checked' : ''}}>
          </div></td>
                        </tr>
                        @endforeach
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
@endsection
