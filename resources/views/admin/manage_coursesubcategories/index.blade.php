@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Course Category/Sub Category</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
                <i class="ri-arrow-right-double-line"></i>
                <span>Manage Course Module</span>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Course Category/Sub Category</span>
        </li> 
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Course Category/Sub Category</h4>
            <span>These Corses/subcourses are listed in Trainig Menu</span>

            <a href="{{ route('subcategory.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Sub Category</span>
                    </span>
                </button>
            </a>
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
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Category Name</th>
                            <th class="col">Parent</th>
                            <th class="col">Language</th>
                            <th class="col">Action</th>
                            <th class="col">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategories as $cat)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                            <td>{{ $cat->category_name }}</td>
                            <td>{{ $cat->parent_category_name ?? 'Root Category' }}</td>
                            <!-- Display parent category name or "Root Category" if none -->
                            <td>{{ $cat->language == 1 ? 'English': 'Hindi'}}</td>
                            <td>
                                <div class="d-flex justify-content-start align-items-start gap-2">
                                    <a href="{{ route('subcategory.edit', $cat->id) }}"
                                        class="btn btn-success text-white btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('subcategory.delete', $cat->id) }}" method="POST"
                                        class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary text-white btn-sm"
                                        onclick="return confirmDelete('{{ $cat->status }}')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="courses_sub_categories" data-column="status" data-id="{{$cat->id}}"
                                        {{$cat->status ? 'checked' : ''}}>
                                </div>
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
<script>
        function confirmDelete(pageStatus) {
        if (pageStatus == 1) {
            alert('Active course cannot be deleted.');
            return false; // Prevent form submission
        } else {
            return confirm('Are you sure you want to delete?'); // Show confirmation if page_status is not 1
        }
    }
    </script>