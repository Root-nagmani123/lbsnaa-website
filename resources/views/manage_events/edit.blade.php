@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>Edit Event</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('manage_events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Page Language:</label>
            <div>
                <label><input type="radio" name="language" value="English" {{ old('language', $event->language) == 'English' ? 'checked' : '' }}> English</label>
                <label><input type="radio" name="language" value="Hindi" {{ old('language', $event->language) == 'Hindi' ? 'checked' : '' }}> Hindi</label>
            </div>
        </div>

        <div class="form-group">
            <label>Event Title:</label>
            <input type="text" name="event_title" class="form-control" value="{{ old('event_title', $event->event_title) }}">
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control ckeditor">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Course:</label>
            <select name="course_id" class="form-control">
                <option value="">Select Course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $event->course_id) == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $event->start_date) }}">
        </div>

        <div class="form-group">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $event->end_date) }}">
        </div>

        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="Draft" {{ old('status', $event->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                <option value="Approval" {{ old('status', $event->status) == 'Approval' ? 'selected' : '' }}>Approval</option>
                <option value="Publish" {{ old('status', $event->status) == 'Publish' ? 'selected' : '' }}>Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('manage_events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="start_date"]').setAttribute('min', today);
        document.querySelector('input[name="end_date"]').setAttribute('min', today);
    });
</script>
