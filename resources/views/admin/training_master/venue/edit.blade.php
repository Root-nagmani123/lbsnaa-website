@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Edit Venue</h2>

    <form action="{{ route('venues.update', $venue->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="page_language">Page Language:</label>
            <input type="radio" name="page_language" value="English" {{ $venue->page_language == 'English' ? 'checked' : '' }}> English
            <input type="radio" name="page_language"  value="Hindi" {{ $venue->page_language == 'Hindi' ? 'checked' : '' }}> Hindi
        </div>
        <div class="mb-3">
            <label for="venue_title">Venue Title:</label>
            <input type="text" name="venue_title" class="form-control" value="{{ $venue->venue_title }}" required>
        </div>
        <div class="mb-3">
            <label for="venue_detail">Venue Detail:</label>
            <textarea name="venue_detail" class="form-control" required>{{ $venue->venue_detail }}</textarea>
        </div>
        <div class="mb-3">
            <label for="status">Status:</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $venue->status == '1' ? 'selected' : '' }}>Active</option>
                <option value="2" {{ $venue->status == '2' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('venues.index') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
    </form>
</div>
@endsection
