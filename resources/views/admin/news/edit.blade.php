@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <h2>Edit News</h2>
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">News Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $news->title) }}" required>
            </div>

            <div class="form-group">
                <label for="short_description">News Short Description *</label>
                <textarea name="short_description" class="form-control" required>{{ old('short_description', $news->short_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="meta_title">Meta Title *</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $news->meta_title) }}" required>
            </div>

            <div class="form-group">
                <label for="meta_keywords">Meta Keyword</label>
                <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $news->meta_keywords) }}">
            </div>

            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea name="meta_description" class="form-control">{{ old('meta_description', $news->meta_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea name="description" class="form-control" required>{{ old('description', $news->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="main_image">Upload Main Image *</label>
                <input type="file" name="main_image" class="form-control" accept="image/*">
                <small>Current: <img src="{{ asset( $news->main_image) }}" alt="Current Image" style="max-width: 150px;"></small>
            </div>

            <div class="form-group">
                <label for="multiple_images">Upload Multiple Images</label>
                <input type="file" name="multiple_images[]" class="form-control" accept="image/*" multiple>
                <small>Current Images: 
                    @foreach (json_decode($news->multiple_images) as $image)
                        <img src="{{ asset($image) }}" alt="Current Image" style="max-width: 150px; margin: 5px;">
                    @endforeach
                </small>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date *</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $news->start_date) }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $news->end_date) }}">
            </div>

            <div class="form-group">
                <label for="status">News Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $news->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $news->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update News</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
