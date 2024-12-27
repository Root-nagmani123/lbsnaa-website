@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Chart</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Organization Chart</span>
        </li>
    </ul>
</div>
@if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Organization</h4>
        </div>
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Category Name</th>
                            <th class="col">Sub org.</th>
                            <th class="col">Description</th>
                            <th class="col">Action</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($records->isEmpty())
                        <div class="alert alert-warning text-center" role="alert" colspan="6" class="text-center">
                            No records found
                        </div>
                        @else
                        @foreach ($records as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->employee_name }}</td>
                            <td><a href="{{ route('organisation-chart.sub-org', ['parent_id' => $record->id]) }}"
                                    class="btn btn-secondary btn-sm text-white">click here</a></td>
                            <td>{{ $record->description }}</td>
                            <td>
                                <a href="{{ route('organisation_chart.edit', $record->id) }}" class="btn bg-success text-white btn-sm">Edit</a>
                                @if ($record->id != 1)
                                <form action="{{ route('organisation_chart.destroy',['parent_id' => $record->id], $record->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary text-white">Delete</button>
                                </form>
                                @endif
                            </td> 
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="organisation_chart" data-column="status" data-id="{{ $record->id }}"
                                        {{ $record->status ? 'checked' : '' }}>
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