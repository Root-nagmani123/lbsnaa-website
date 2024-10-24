@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1>Create New Category</h1>

    <form action="{{ route('souvenir.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
       
                        <select class="form-control" id="type" name="type">
                <option value="">Select</option>
                <option value="academy_souvenir"> Academy Souvenir </option>
            </select>
        </div>
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" required>
        </div>
        <div class="mb-3">
            <label for="category_name_hindi" class="form-label">Category Name in Hindi</label>
            <input type="text" class="form-control" id="category_name_hindi" name="category_name_hindi">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
