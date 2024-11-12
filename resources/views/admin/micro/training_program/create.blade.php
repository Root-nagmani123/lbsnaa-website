@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Add Program</h2>
    <form action="{{ route('training-programs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Research Centre *</label>
            <input type="text" name="research_centre" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Page Language *</label><br>
            <input type="radio" name="language" value="english" required> English
            <input type="radio" name="language" value="hindi"> Hindi
        </div>

        <div class="form-group">
            <label>Program Name *</label>
            <input type="text" name="program_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Venue *</label>
            <input type="text" name="venue" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Program Co-ordinator</label>
            <input type="text" name="program_coordinator" class="form-control">
        </div>

        <div class="form-group">
            <label>Program Description *</label>
            <textarea name="program_description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>Start Date *</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label>End Date *</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Important Links</label>
            <textarea name="important_links" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Registration Status *</label><br>
            <input type="radio" name="registration_status" value="on" required> ON
            <input type="radio" name="registration_status" value="off"> OFF
        </div>

        <div class="form-group">
            <label>Page Status *</label>
            <select name="page_status" class="form-control" required>
                <option value="">Select</option>
                <option value="1">Draft</option>
                <option value="2">Approval</option>
                <option value="3">Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-warning">Reset</button>
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
