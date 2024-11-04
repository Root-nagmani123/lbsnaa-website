@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Add New Media</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('video_gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Category Name</label>
            <select name="category_name" class="form-control" required>
                <option value="">Select</option>
                <option value="Publish">Publish</option>
            </select>
        </div>

        <div class="form-group">
            <label>Video Title (English)</label>
            <input type="text" name="audio_title_en" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Video Title (Hindi) (optional)</label>
            <input type="text" name="audio_title_hi" class="form-control">
        </div>

		<div class="form-group">
		    <label>YouTube Video Link</label>
		    <input type="url" name="video_upload" class="form-control" placeholder="https://www.youtube.com/watch?v=example">
		    <!-- <small class="text-muted">Provide a YouTube link if not uploading an audio file.</small> -->
		</div>

        <div class="form-group">
            <label>Page Status</label>
            <select name="page_status" class="form-control" required>
                <option value="1">Draft</option>
                <option value="2">Approval</option>
                <option value="3">Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="{{ route('video_gallery.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
