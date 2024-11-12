@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Cadres List</h4>
            
            <a href="{{ route('cadres.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Cadre</span>
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
                    <th class="col">ID</th>
                    <th class="col">Code</th>
                    <th class="col">Description</th>
                    <th class="col">Language</th>
                    <th class="col">Status</th>
                    <th class="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cadres as $cadre) <!-- Use $index for the incrementing index -->
                        <tr>
                            <td>{{ $cadre->id }}</td>
                            <td>{{ $cadre->code }}</td>
                            <td>{{ $cadre->description }}</td>
                            <td>{{ $cadre->language == 1 ? 'English' : 'Hindi' }}</td>
                            <td>
                                @if ($cadre->status == 1)
                                    Active
                                @elseif ($cadre->status == 0)
                                    Inactive
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('cadres.edit', $cadre->id) }}" class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('cadres.destroy', $cadre->id) }}" method="POST" style="display:inline;">
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
