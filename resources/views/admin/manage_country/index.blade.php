@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')
@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Country</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Country</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Country</h4>
            
            <a href="{{ route('country.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Country</span>
                    </span>
                </button>
            </a>
        </div>
        <div class="default-table-area members-list">
    <div class="table-responsive">
        <table class="table align-middle" id="myTable">
            <thead>
                <tr class="text-center">
                    <th class="col">ID</th>
            <th class="col">Country Name</th>
            <th class="col">Action</th>
            <th class="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($country as $cat)
                <tr>
                <td>{{ $loop->iteration }}</td>
                    <td>{{ $cat->country_name }}</td>
                    <!-- <td>{{ $cat->status ? 'Active' : 'Inactive' }}</td> -->
                    <td>
                                @if ($cat->status == 1)
                                <span
                                    class="badge bg-success bg-opacity-10 text-success py-2 fw-semibold text-center">Active</span>
                                @elseif ($cat->status == 0)
                                <span
                                    class="badge bg-primary bg-opacity-10 text-primary py-2 fw-semibold text-center">Inactive</span>
                                @endif
                            </td>
                    <td>
                        <a href="{{ route('country.edit', $cat->id) }}" class="btn btn-success text-white btn-sm">Edit</a>
                        <form action="{{ route('country.destroy', $cat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary text-white btn-sm">Delete</button>
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
