@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Audit Logs</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Audit Logs</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-0">Audit Logs</h4>
        </div>
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">ID</th>
                            <th class="col">Module Name / Page Name</th>
                            <th class="col">Time Stamp</th>
                            <th class="col">Created By</th>
                            <th class="col">Updated By</th>
                            <th class="col">Login/Logout/Login Failed</th>
                            <th class="col">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($audits as $index => $audit)
                        <!-- Use $index for the incrementing index -->
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                            <td>{{ $audit->Module_Name }}</td>
                            <td>{{ date('Y-m-d', $audit["Time_Stamp"]) }}</td>
                            <td>{{ $audit->Created_By }}</td>
                            <td>{{ $audit->Updated_By }}</td>
                            <td>{{ $audit->Action_Type }}</td>
                            <td>{{ $audit->IP_Address }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection