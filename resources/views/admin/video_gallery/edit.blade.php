@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Edit Media</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('video_gallery.update', $media->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="category_name" class="form-control" value="{{ $media->category_name }}" required>
        </div>

        <div class="form-group">
            <label>Audio Title (English)</label>
            <input type="text" name="audio_title_en" class="form-control" value="{{ $media->audio_title_en }}" required>
        </div>

        <div class="form-group">
            <label>Audio Title (Hindi) (optional)</label>
            <input type="text" name="audio_title_hi" class="form-control" value="{{ $media->audio_title_hi }}">
        </div>

		<div class="form-group">
		    <label>YouTube Video Link</label>
		    <input type="url" name="video_upload" class="form-control" 
		           placeholder="https://www.youtube.com/watch?v=example" 
		           value="{{ old('video_upload', $media->video_upload ?? '') }}">
		</div>

        <div class="form-group">
            <label>Page Status</label>
            <select name="page_status" class="form-control" required>
                <option value="1" {{ $media->page_status == '1' ? 'selected' : '' }}>Draft</option>
                <option value="2" {{ $media->page_status == '2' ? 'selected' : '' }}>Approval</option>
                <option value="3" {{ $media->page_status == '3' ? 'selected' : '' }}>Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('video_gallery.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
