@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Manage Social Media Links</h2>

    <form action="{{ route('socialmedia.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="txtename">Title *</label>
            <input type="text" name="txtename" class="form-control" value="{{ $socialMedia->title ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="facebook">Facebook URL *</label>
            <input type="text" name="facebook" class="form-control"  value="{{ $socialMedia->facebook_url ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="twitter">Twitter URL *</label>
            <input type="text" name="twitter" class="form-control" value="{{ $socialMedia->twitter_url ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="googleplus">Youtube URL *</label>
            <input type="text" name="googleplus" class="form-control" value="{{ $socialMedia->youtube_url ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="linkedin">LinkedIn URL *</label>
            <input type="text" name="linkedin" class="form-control" value="{{ $socialMedia->linkedin_url ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="txtstatus">Page Status *</label>
            <select name="txtstatus" class="form-control" requireds>
                <option value="1" {{ isset($socialMedia) && $socialMedia->status == 1 ? 'selected' : '' }}>Draft</option>
                <option value="2" {{ isset($socialMedia) && $socialMedia->status == 2 ? 'selected' : '' }}>Approval</option>
                <option value="3" {{ isset($socialMedia) && $socialMedia->status == 3 ? 'selected' : '' }}>Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection
