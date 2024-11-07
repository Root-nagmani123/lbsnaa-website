@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold fs-18 mb-sm-0">Manage Media Categories</h4>

    <!-- <a href="{{ route('media-center.create') }}">
        <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
            <span class="py-sm-1 d-block">
                <i class="ri-add-line text-white"></i>
                <span>Add New Audio</span>
            </span>
        </button>
    </a> -->
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
                <form action="{{ isset($category) ? route('media-categories.update', $category->id) : route('media-categories.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <option value="Photo Gallery" class="text-dark" {{ isset($category) && $category->media_gallery == 'Photo Gallery' ? 'selected' : '' }}>Photo Gallery</option>
                                        <option value="Video Gallery" class="text-dark" {{ isset($category) && $category->media_gallery == 'Video Gallery' ? 'selected' : '' }}>Video Gallery</option>
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
                            <button class="btn btn-warning text-white fw-semibold" type="reset">Reset</button> &nbsp;
                            <a href="{{ route('media-categories.index') }}" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
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
                        <td>{{ $item->media_gallery }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->hindi_name }}</td>
                        <td>
                            @if ($item->status == 1)
                                Draft
                            @elseif ($item->status == 2)
                                Approval
                            @elseif ($item->status == 3)
                                Publish
                            @endif
                        </td>
                            <td>
                                <a href="{{ route('media-categories.edit', $item->id) }}"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('media-categories.destroy', $item->id) }}" method="POST"
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
