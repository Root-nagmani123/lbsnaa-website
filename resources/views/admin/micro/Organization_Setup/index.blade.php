@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th> <!-- Index Column -->
                <th>Research Centre</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Email</th>
                <th>Picture</th>
                <th>Language</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($organizations as $loopIndex => $org)
                <tr>
                    <td>{{ $loopIndex + 1 }}</td> <!-- Displaying the Index -->
                    <td>{{ $org->research_centre_name }}</td>
                    <td>{{ $org->employee_name }}</td>
                    <td>{{ $org->designation }}</td>
                    <td>{{ $org->email }}</td>
                    <th>
                        <img src="{{ asset('images/' . basename($org->main_image)) }}" alt="Image" style="width: 100px; height: auto;">
                    </th>

                    <td>
                        @if ($org->language == 1)
                            English
                        @else ($org->language == 2)
                            Hindi
                        @endif
                    </td>
                    <td>
                        @if ($org->page_status == 1)
                            Draft
                        @elseif ($org->page_status == 2)
                            Approval
                        @elseif ($org->page_status == 3)
                            Publish
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('organization_setups.edit', $org->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('organization_setups.destroy', $org->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Organization Structure Management</h4>
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
                            <td>{{ $org->research_centre }}</td>
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
                                @if ($org->page_status == 1)
                                <span
                                    class="badge bg-warning bg-opacity-10 text-warning py-2 fw-semibold text-center">Draft</span>
                                @elseif ($org->page_status == 2)
                                <span
                                    class="badge bg-primary bg-opacity-10 text-primary py-2 fw-semibold text-center">Approval</span>
                                @elseif ($org->page_status == 3)
                                <span
                                    class="badge bg-danger bg-opacity-10 text-danger py-2 fw-semibold text-center">Publish</span>
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
                                        onclick="return confirm('Are you sure?')">Delete</button>
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