@extends('admin.layouts.master')

@section('title', 'Feedback List')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Feedback List</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Feedback List</span>
        </li>
    </ul>
</div>

<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Feedback List</h4>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Category</th>
                            <th>Comments</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($feedbacks as $feedback)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $feedback->name }}</td>
                                <td>{{ $feedback->mobile }}</td>
                                <td>{{ $feedback->email }}</td>
                                <td>{{ $categories[$feedback->category] ?? 'Unknown' }}</td>
                                <td>{{ $feedback->comments }}</td>
                                <td>{{ \Carbon\Carbon::parse($feedback->created_at)->format('d-m-Y H:i') }}</td>
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
