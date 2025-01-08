@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Activity</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
<div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Activity</h4>
            </div>
        <div class="default-table-area members-list">
    <div class="table-responsive">
        <table class="table align-middle" id="myTable">
            <thead>
                <tr class="text-center">
                    <th class="col">#</th>
                    <th class="col">Name</th>
                    <th class="col">Login ID</th>
                    <th class="col">Date</th>
                    <th class="col">Action</th>
                    <th class="col">IP Address</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1;@endphp
        @foreach($recentLogins as $login)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $login->user_name }}</td>
                <td>{{ $login->login_id }}</td>
                <td>{{ \Carbon\Carbon::parse($login->login_time)->format('d-m-Y H:i:s') }}</td>
                <td>{{ $login->action }}</td>
                <td>{{ $login->ip_address }}</td>
            </tr>
            @php $i++;@endphp
        @endforeach
    </tbody>
        </table>
    </div>
</div>
    </div>
</div>
@endsection