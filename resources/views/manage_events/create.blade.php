@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>Add Event</h2>

    <form action="{{ route('manage_events.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Page Language:</label><br>
            <label><input type="radio" name="language" value="English" {{ old('language') == 'English' ? 'checked' : '' }}> English</label>
            <label><input type="radio" name="language" value="Hindi" {{ old('language') == 'Hindi' ? 'checked' : '' }}> Hindi</label>
            @error('language')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Event Title:</label>
            <input type="text" name="event_title" class="form-control" value="{{ old('event_title') }}">
            @error('event_title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control ckeditor">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Course:</label>
            <select name="course_id" class="form-control">
                <option value="">Select Course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                @endforeach
            </select>
            @error('course_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
            @error('start_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
            @error('end_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>





        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control">
            	<option value="">Select</option>
                <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                <option value="Approval" {{ old('status') == 'Approval' ? 'selected' : '' }}>Approval</option>
                <option value="Publish" {{ old('status') == 'Publish' ? 'selected' : '' }}>Publish</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="{{ route('manage_events.index') }}" class="btn btn-danger">Cancel</a>
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


