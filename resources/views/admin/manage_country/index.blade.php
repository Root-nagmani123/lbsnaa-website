@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')
@section('content')
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Manage Country</h4>
            
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
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->country_name }}</td>
                    <td>{{ $cat->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('country.edit', $cat->id) }}" class="btn btn-success text-white">Edit</a>
                        <form action="{{ route('country.destroy', $cat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary text-white">Delete</button>
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
