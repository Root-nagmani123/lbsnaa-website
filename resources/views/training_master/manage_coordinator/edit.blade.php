@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Edit Coordinator</h2>
    <form action="{{ route('coordinators.update', $coordinator->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="page_language">Page Language:</label>
            <div>
                <label><input type="radio" name="page_language" value="English" {{ $coordinator->page_language === 'English' ? 'checked' : '' }}> English</label>
                <label><input type="radio" name="page_language" value="Hindi" {{ $coordinator->page_language === 'Hindi' ? 'checked' : '' }}> Hindi</label>
                <!-- Add more languages as needed -->
            </div>
        </div>
        <div class="mb-3">
            <label for="coordinator_name">Coordinator Name:</label>
            <input type="text" name="coordinator_name" class="form-control" value="{{ $coordinator->coordinator_name }}" required>
        </div>
        <div class="mb-3">
            <label for="status">Status:</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $coordinator->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $coordinator->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('coordinators.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
