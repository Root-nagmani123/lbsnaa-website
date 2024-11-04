@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h2>Edit Audio Gallery</h2>
<form action="{{ route('media-center.update', $audio->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>Category Name</label>
        <select name="category_name" required class="form-control">
            <option value="">Select</option>
            <option value="Audio" {{ $audio->category_name == 'Audio' ? 'selected' : '' }}>Audio</option>
            <!-- <option value="Dropdown" {{ $audio->category_name == 'Dropdown' ? 'selected' : '' }}>Dropdown</option> -->
        </select>
    </div>

    <div>
        <label>Audio Title (English)</label>
        <input type="text" name="audio_title_en" value="{{ $audio->audio_title_en }}" required class="form-control">
    </div>

    <div>
        <label>Audio Title (Hindi)</label>
        <input type="text" name="audio_title_hi" value="{{ $audio->audio_title_hi }}" class="form-control">
    </div>

    <div>
        <label>Audio Upload (.mp4 only)</label>
        <input type="file" name="audio_upload" accept=".mp4,.mp3" class="form-control">
    </div>

    <div>
        <label>Page Status</label>
        <select name="page_status" required class="form-control">
            <option value="1" {{ $audio->page_status == '1' ? 'selected' : '' }}>Draft</option>
            <option value="2" {{ $audio->page_status == '2' ? 'selected' : '' }}>Approval</option>
            <option value="3" {{ $audio->page_status == '3' ? 'selected' : '' }}>Publish</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('media-center.index') }}" class="btn btn-danger">Cancel</a>
</form>
@endsection
