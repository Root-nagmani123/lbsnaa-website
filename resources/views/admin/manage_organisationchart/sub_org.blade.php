@extends('admin.layouts.master')

@section('title', 'Sub Organisation Chart')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Chart</h3> -->
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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Organization Chart</span>
        </li>
    </ul>
</div>
@if(Cache::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Cache::get('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(Cache::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Cache::get('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(Cache::has('validation_errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach (Cache::get('validation_errors') as $field => $errors)
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Sub Organization Chart</h4>    

            <a href="{{ route('organisation_chart.create') }}?parent_id={{ $parent_id }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Employee</span>
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
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="sortableTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Employee Name</th>
                            <th class="col">Employee Name Hindi</th>
                            <th class="col">Sub org.</th>
                            <th class="col">Parent</th>
                            
                            <th class="col">Status</th>
                            <th class="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-org_chart">
                        @if ($records->isEmpty())
                        <div class="alert alert-warning text-center" role="alert" colspan="6" class="text-center">
                            No records found
                        </div>
                        @else
                        @foreach($records as $record)
                        <tr data-id="{{ $record->id }}" class="sortable-row">
                        <td class="handle" style="cursor: move;">☰</td> <!-- Drag handle -->
                            <td>{{ $record->employeeNames }}</td>
                            <td>{{ $record->employeename_in_hindi }}</td>
                            <td><a href="{{ route('organisation-chart.sub-org', ['parent_id' => $record->id]) }}"
                                    class="btn btn-secondary btn-sm text-white">click here</a></td>
                            <td>{{ $record->faculty_id_faculty}}</td>
                            <td>{{ $record->description }}</td>
                            <td>
                                <a href="{{ route('organisation_chart.edit', $record->id) }}"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <!-- <form action="{{ route('organisation-chart.destroy', $record->id) }}" method="POST"
                                    style="display:inline;"> -->
                                    <form action="{{ route('organisation-chart.destroy', $record->id) }}" method="POST"
                                    style="display:inline;">
                                     
                                    @csrf
                                    <button type="submit" class="btn btn-primary text-white btn-sm"
                                            onclick="return confirm('Are you sure you want to delete?')">
                                            Delete
                                        </button>
                                    <!-- <button type="submit" class="btn btn-sm btn-primary text-white">Delete</button> -->
                                </form>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="organisation_chart" data-column="status" data-id="{{$record->id}}"
                                        {{$record->status ? 'checked' : ''}}>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 