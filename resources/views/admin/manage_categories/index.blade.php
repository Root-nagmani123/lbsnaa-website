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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Category</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-sm-0">Manage Media Categories</h4>
                </div>
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form
                    action="{{ isset($category) ? route('media-categories.update', $category->id) : route('media-categories.store') }}"
                    method="POST" enctype="multipart/form-data">
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
                                    <select class="form-select form-control ps-5 h-58" name="media_gallery"
                                        id="media_gallery">
                                        <option value="" class="text-dark">Select</option>
                                        <option value="Photo Gallery" class="text-dark"
                                            {{  old('media_gallery'), isset($category) && $category->media_gallery == 'Photo Gallery' ? 'selected' : '' }}>
                                            Photo Gallery</option>
                                        <option value="Video Gallery" class="text-dark"
                                            {{  old('media_gallery'), isset($category) && $category->media_gallery == 'Video Gallery' ? 'selected' : '' }}>
                                            Video Gallery</option>
                                    </select>
                                    @error('media_gallery')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="name">Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="name" id="name"
                                        value="{{ old('name', $category->name ?? '') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('hindi_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="category_image">Category Image:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark ps-5 h-58" name="category_image"
                                        id="category_image" accept="image/*">
                                    @error('category_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status">
                                        <option value="" class="text-dark">Select</option>
                                        <option value="1" class="text-dark"
                                            {{ isset($category) && $category->status == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" class="text-dark"
                                            {{ isset($category) && $category->status == '0' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold"
                                type="submit">{{ isset($category) ? 'Update' : 'Submit' }}</button> &nbsp;
                            <a href="{{ route('media-categories.index') }}"
                                class="btn btn-secondary text-white">Back</a>
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
            <h4 class="fw-semibold fs-18 mb-sm-0">Media List</h4>
        </div>
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Media Gallery</th>
                            <th class="col">Name</th>
                            <th class="col">Hindi Name</th>
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->media_gallery }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->hindi_name }}</td>
                            <td>
                                <a href="{{ route('media-categories.edit', $item->id) }}"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('media-categories.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white"
                                        onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="manage_media_categories" data-column="status"
                                        data-id="{{$item->id}}" {{$item->status ? 'checked' : ''}}>
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