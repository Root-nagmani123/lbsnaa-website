@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Coordinators</h4>
            
            <a href="{{ route('coordinators.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Coordinator</span>
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
                    <th class="col">ID</th> <!-- Add this column for indexing -->
                    <th class="col">Page Language</th>
                    <th class="col">Coordinator Name</th>
                    <th class="col">Status</th>
                    <th class="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coordinators as $coordinator)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                            <td>{{ $coordinator->language == 1 ? 'English' : 'Hindi' }}</td>
                            <td>{{ $coordinator->coordinator_name }}</td>
                            <td>
                                @if ($coordinator->status == 1)
                                    Active
                                @elseif ($coordinator->status == 2)
                                    Inactive
                                @else
                                    Unknown
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('coordinators.edit', $coordinator->id) }}" class="btn bg-success text-white btn-sm"><i class="ri-pencil-fill"></i> Edit</a>
                                <form action="{{ route('coordinators.destroy', $coordinator->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white">Delete</button>
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
