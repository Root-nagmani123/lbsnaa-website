@extends('layouts.admin')

@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1>Edit Section</h1>
    <form action="{{ route('sections.update', $section->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Section Title:</label>
            <input type="text" name="title" class="form-control" value="{{ $section->title }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $section->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$section->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Section</button>
        <a href="{{ route('sections.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
