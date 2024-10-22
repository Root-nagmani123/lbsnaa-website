@extends('layouts.admin')

@section('content')
<h1>Add News</h1>
<form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">News Title *</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="short_description">Short Description *</label>
        <textarea name="short_description" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="meta_title">Meta Title *</label>
        <input type="text" name="meta_title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="meta_keywords">Meta Keywords</label>
        <input type="text" name="meta_keywords" class="form-control">
    </div>

    <div class="form-group">
        <label for="meta_description">Meta Description</label>
        <textarea name="meta_description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="description">Description *</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="main_image">Main Image *</label>
        <input type="file" name="main_image" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="multiple_images">Upload Multiple Images</label>
        <input type="file" name="multiple_images[]" class="form-control" multiple>
    </div>

    <div class="form-group">
        <label for="start_date">Start Date *</label>
        <input type="date" name="start_date" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="end_date">End Date</label>
        <input type="date" name="end_date" class="form-control">
    </div>

    <div class="form-group">
        <label for="status">News Status</label>
        <select name="status" class="form-control">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Add News</button>
</form>
@endsection
