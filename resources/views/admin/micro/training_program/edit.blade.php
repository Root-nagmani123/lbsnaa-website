@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Edit Program</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('training-programs.update', $trainingProgram->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Research Centre *</label>
            <input type="text" name="research_centre" class="form-control" value="{{ $trainingProgram->research_centre }}" required>
        </div>

        <div class="form-group">
            <label>Page Language *</label><br>
            <input type="radio" name="language" value="english" {{ $trainingProgram->language == 'english' ? 'checked' : '' }} required> English
            <input type="radio" name="language" value="hindi" {{ $trainingProgram->language == 'hindi' ? 'checked' : '' }}> Hindi
        </div>

        <div class="form-group">
            <label>Program Name *</label>
            <input type="text" name="program_name" class="form-control" value="{{ $trainingProgram->program_name }}" required>
        </div>

        <div class="form-group">
            <label>Venue *</label>
            <input type="text" name="venue" class="form-control" value="{{ $trainingProgram->venue }}" required>
        </div>

        <div class="form-group">
            <label>Program Co-ordinator</label>
            <input type="text" name="program_coordinator" class="form-control" value="{{ $trainingProgram->program_coordinator }}">
        </div>

        <div class="form-group">
            <label>Program Description *</label>
            <textarea name="program_description" class="form-control" required>{{ $trainingProgram->program_description }}</textarea>
        </div>

        <div class="form-group">
            <label>Start Date *</label>
            <input type="date" name="start_date" class="form-control" value="{{ $trainingProgram->start_date }}" required>
        </div>

        <div class="form-group">
            <label>End Date *</label>
            <input type="date" name="end_date" class="form-control" value="{{ $trainingProgram->end_date }}" required>
        </div>

        <div class="form-group">
            <label>Important Links</label>
            <textarea name="important_links" class="form-control">{{ $trainingProgram->important_links }}</textarea>
        </div>

        <div class="form-group">
            <label>Registration Status *</label><br>
            <input type="radio" name="registration_status" value="on" {{ $trainingProgram->registration_status == 'on' ? 'checked' : '' }} required> ON
            <input type="radio" name="registration_status" value="off" {{ $trainingProgram->registration_status == 'off' ? 'checked' : '' }}> OFF
        </div>

        <div class="form-group">
            <label>Page Status *</label>
            <select name="page_status" class="form-control" required>
                <option value="1" {{ $trainingProgram->page_status == '1' ? 'selected' : '' }}>Draft</option>
                <option value="2" {{ $trainingProgram->page_status == '2' ? 'selected' : '' }}>Approval</option>
                <option value="3" {{ $trainingProgram->page_status == '3' ? 'selected' : '' }}>Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('training-programs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0];
        
        const startDateInput = document.querySelector('input[name="start_date"]');
        const endDateInput = document.querySelector('input[name="end_date"]');
        
        // Set min date for both start and end date on page load
        startDateInput.setAttribute('min', today);
        endDateInput.setAttribute('min', today);

        // Update end date min whenever start date is changed
        startDateInput.addEventListener('change', function() {
            endDateInput.setAttribute('min', this.value);
        });
    });
</script>
