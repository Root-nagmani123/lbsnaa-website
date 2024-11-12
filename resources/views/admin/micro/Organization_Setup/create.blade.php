@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Organization Setup</h2>
    
    <form action="{{ route('organization_setups.store') }}" method="POST" enctype="multipart/form-data">
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
            <label>Employee Name *</label>
            <input type="text" name="employee_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Designation *</label>
            <input type="text" name="designation" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Program Description *</label>
            <textarea name="program_description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>Upload Main Image *</label>
            <input type="file" name="main_image" class="form-control" required>
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
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="{{ route('organization_setups.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
