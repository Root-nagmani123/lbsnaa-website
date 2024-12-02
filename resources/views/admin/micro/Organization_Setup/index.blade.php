@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Structure</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Organization Structure</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Organization Structure</h4>
            <a href="{{ route('organization_setups.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New Setup</span>
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
                            <th class="col">ID</th> <!-- Index Column -->
                            <th class="col">Research Centre</th>
                            <th class="col">Employee Name</th>
                            <th class="col">Designation</th>
                            <th class="col">Email</th>
                            <th class="col">Picture</th>
                            <th class="col">Language</th>
                            <th class="col">Status</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($organizations as $loopIndex => $org)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $org->research_centre_name }}</td>
                            <td>{{ $org->employee_name }}</td> 
                            <td>{{ $org->designation }}</td>
                            <td>{{ $org->email }}</td>
                            <td>
                                <img src="{{ asset('images/' . basename($org->main_image)) }}" alt="Image"
                                    style="width: 100px; height: auto;">
                            </td>

                            <td>
                                @if ($org->language == 1)
                                English
                                @else ($org->language == 2)
                                Hindi
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('organization_setups.edit', $org->id) }}"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('organization_setups.destroy', $org->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white"
                                    onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            </td>
                            <td><div class="form-check form-switch">
            <input class="form-check-input status-toggle" type="checkbox" role="switch"  data-table="mirco_organization_setups" 
            data-column="page_status" data-id="{{$org->id}}" {{$org->page_status ? 'checked' : ''}}>
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