@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Course Sub Category</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Course Sub Category</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Sub Category List</h4>
            
            <a href="{{ route('subcategory.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Sub Category</span>
                    </span>
                </button>
            </a>
        </div>
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">SNO</th>
                            <th class="col">Category Name</th>
                            <th class="col">Parent</th>
                            <th class="col">Language</th>
                            <th class="col">Status</th>
                            <th class="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->category_name }}</td>
                            <td>{{ $cat->parent_category_name ?? 'Root Category' }}</td> <!-- Display parent category name or "Root Category" if none -->
                            <td>{{ $cat->language == 1 ? 'English': 'Hindi'}}</td>
                            <!-- <td>{{ $cat->status == 1 ? 'Draft' : ($cat->status == 2 ? 'Approval' : 'Publish') }}</td> -->
                            <td>
                                @if ($cat->status == 1)
                                    <span class="badge bg-warning bg-opacity-10 text-warning py-2 fw-semibold text-center">Draft</span>
                                @elseif ($cat->status == 2)
                                    <span class="badge bg-primary bg-opacity-10 text-primary py-2 fw-semibold text-center">Approved</span>
                                @elseif ($cat->status == 3)
                                    <span class="badge bg-success bg-opacity-10 text-success py-2 fw-semibold text-center">Publish</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('subcategory.edit', $cat->id) }}" class="btn btn-success text-white btn-sm ">Edit</a>
                                <form action="{{ route('subcategory.delete', $cat->id) }}" method="get" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary text-white btn-sm">Delete</button>
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
