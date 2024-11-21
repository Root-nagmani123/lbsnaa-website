@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')


@section('content')
<div class="container">
    <h2>Edit Organization Setup</h2>
    
    <form action="{{ route('organization_setups.update', $organizationSetup->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="col-lg-6">
            <div class="form-group mb-4">
                <label class="label" for="research_centre">Select Research Centre:</label>
                <span class="star">*</span>
                <div class="form-group position-relative">
                    <select class="form-select form-control ps-5 h-58" name="research_centre" id="research_centre" required>
                        <option value="" disabled {{ is_null($organizationSetup->research_centre) ? 'selected' : '' }}>
                            Select Research Centre
                        </option>
                        dd($researchCentres);
                        @foreach($researchCentres as $id => $name)
                            <option value="{{ $id }}" {{ (string)$organizationSetup ->research_centre === (string)$id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Page Language *</label><br>
            <input type="radio" name="language" value="1" {{ $organizationSetup->language == '1' ? 'checked' : '' }} required> English
            <input type="radio" name="language" value="2" {{ $organizationSetup->language == '2' ? 'checked' : '' }}> Hindi
        </div>

        <div class="form-group">
            <label>Employee Name *</label>
            <input type="text" name="employee_name" class="form-control" value="{{ old('employee_name', $organizationSetup->employee_name) }}" required>
        </div>

        <div class="form-group">
            <label>Designation *</label>
            <input type="text" name="designation" class="form-control" value="{{ old('designation', $organizationSetup->designation) }}" required>
        </div>

        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $organizationSetup->email) }}" required>
        </div>

        <div class="form-group">
            <label>Program Description *</label>
            <textarea name="program_description" class="form-control" required>{{ old('program_description', $organizationSetup->program_description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Upload Main Image</label><br>
            @if ($organizationSetup->main_image)
                <!-- Display image from public/images -->
                <img src="{{ asset('images/' . basename($organizationSetup->main_image)) }}" alt="Current Image" width="100" height="100"><br>
            @endif
            <input type="file" name="main_image" class="form-control">
            <small class="form-text text-muted">Leave blank to keep the current image.</small>
        </div>


        <div class="form-group">
            <label>Page Status *</label>
            <select name="page_status" class="form-control" required>
                <option value="1" {{ $organizationSetup->page_status == '1' ? 'selected' : '' }}>Draft</option>
                <option value="2" {{ $organizationSetup->page_status == '2' ? 'selected' : '' }}>Approval</option>
                <option value="3" {{ $organizationSetup->page_status == '3' ? 'selected' : '' }}>Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('organization_setups.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
