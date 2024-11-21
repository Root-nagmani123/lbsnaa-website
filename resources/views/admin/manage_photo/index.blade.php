@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Center</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Photo Gallery</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Photo Gallery</h4>
            <a href="{{ route('photo-gallery.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Photo Gallery</span>
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
                            <th class="col">#</th>
                            <th class="col">Category Name</th>
                            <th class="col">Media Category</th>
                            <th class="col">Image Title (English)</th>
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleries as $index => $gallery) <!-- Use $index to track the row number -->
                        <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                            <td>{{ $gallery->name ?? 'N/A' }}</td>
                            <td>{{ $gallery->media_cat_name ?? 'N/A' }}</td>
                            <td>{{ $gallery->image_title_english }}</td>
                            <td>
                                <a href="{{ route('photo-gallery.edit', $gallery->id) }}" class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('photo-gallery.destroy', $gallery->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                            <td><div class="form-check form-switch">
            <input class="form-check-input status-toggle" type="checkbox" role="switch"  data-table="manage_photo_galleries" 
            data-column="status" data-id="{{$gallery->id}}" {{$gallery->status ? 'checked' : ''}}>
          </div></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection