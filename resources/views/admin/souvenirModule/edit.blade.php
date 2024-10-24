@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1>Edit Category</h1>

    <form action="{{ route('souvenir.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ $category->type }}" required>
        </div>
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}" required>
        </div>
        <div class="mb-3">
            <label for="category_name_hindi" class="form-label">Category Name in Hindi</label>
            <input type="text" class="form-control" id="category_name_hindi" name="category_name_hindi" value="{{ $category->category_name_hindi }}">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
