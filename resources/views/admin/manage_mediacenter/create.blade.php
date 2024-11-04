@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h2>Add Audio Gallery</h2>
	@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form action="{{ route('media-center.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Category Name</label>
        <select name="category_name" required  class="form-control">
            <option value="">Select</option>
            <option value="Audio">Audio</option>
        </select>
    </div>

    <div class="form-group">
        <label>Audio Title (English)</label>
        <input type="text" name="audio_title_en" required  class="form-control">
    </div>

    <div class="form-group">
        <label>Audio Title (Hindi)</label>
        <input type="text" name="audio_title_hi"  class="form-control">
    </div>


    <div class="form-group">
        <label>Audio Upload (.mp4 only)</label>
        <input type="file" name="audio_upload" accept=".mp4,.mp3" required>
    </div>

    <div class="form-group">
        <label>Page Status</label>
        <select name="page_status" required  class="form-control">
        	<option value="">Select</option>
            <option value="1">Draft</option>
            <option value="2">Approval</option>
            <option value="3">Publish</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
    <a href="{{ route('media-center.index') }}"  class="btn btn-danger">Cancel</a>
</form>
@endsection
