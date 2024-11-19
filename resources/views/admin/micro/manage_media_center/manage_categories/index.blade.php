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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Media Categories</span>
        </li>
    </ul>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Manage Media Categories</h4>
            </div>
                @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
                <form action="{{ isset($category) ? route('photovideogallery.update', $category->id) : route('photovideogallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($category))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="media_gallery">Media Gallery :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="media_gallery" id="media_gallery" required>
                                        <option value="" class="text-dark">Select</option>
                                        <option value="1" class="text-dark" {{ isset($category) && $category->media_gallery == '1' ? 'selected' : '' }}>Photo Gallery</option>
                                        <option value="2" class="text-dark" {{ isset($category) && $category->media_gallery == '2' ? 'selected' : '' }}>Video Gallery</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="name">Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="name"
                                        id="name" value="{{ old('name', $category->name ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="hindi_name">Hindi Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="hindi_name"
                                        id="hindi_name" value="{{ old('hindi_name', $category->hindi_name ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status" required>
                                        <option value="0" class="text-dark">Select</option>
                                        <option value="1" class="text-dark" {{ isset($category) && $category->status == '1' ? 'selected' : '' }}>Draft</option>
                                        <option value="2" class="text-dark" {{ isset($category) && $category->status == '2' ? 'selected' : '' }}>Approval</option>
                                        <option value="3" class="text-dark" {{ isset($category) && $category->status == '3' ? 'selected' : '' }}>Publish</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">{{ isset($category) ? 'Update' : 'Submit' }}</button> &nbsp;
                            <a href="{{ route('photovideogallery.index') }}" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Media List</h4>
            </div>
              <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">ID</th>
                            <th class="col">Media Gallery</th>
                            <th class="col">Name</th>
                            <th class="col">Hindi Name</th>
                            <th class="col">Status</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $item)
                        <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            @if ($item->media_gallery == 1)
                                Photo Gallery
                            @elseif ($item->media_gallery == 2)
                                Video Gallery
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->hindi_name }}</td>
                        <td>
                    @if ($item->status == 1)
                    <span
                        class="badge bg-warning bg-opacity-10 text-warning py-2 fw-semibold text-center">Draft</span>
                    @elseif ($item->status == 2)
                    <span
                        class="badge bg-primary bg-opacity-10 text-primary py-2 fw-semibold text-center">Approval</span>
                    @elseif ($item->status == 3)
                    <span
                        class="badge bg-danger bg-opacity-10 text-danger py-2 fw-semibold text-center">Publish</span>
                    @endif
                </td>
                            <td>
                                <a href="{{ route('photovideogallery.edit', $item->id) }}"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('photovideogallery.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white" onclick="return confirm('Are you sure?')">Delete</button>
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
