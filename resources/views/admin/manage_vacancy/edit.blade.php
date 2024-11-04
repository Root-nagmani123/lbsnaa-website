@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>Edit Vacancy</h2>

    <form action="{{ route('manage_vacancy.update', $vacancy->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="language">Page Language</label>
            <input type="radio" name="language" value="English" {{ $vacancy->language == 'English' ? 'checked' : '' }}> English
            <input type="radio" name="language" value="Hindi" {{ $vacancy->language == 'Hindi' ? 'checked' : '' }}> Hindi
        </div>

        <div class="form-group">
            <label for="job_title">Job Title</label>
            <input type="text" class="form-control" name="job_title" value="{{ old('job_title', $vacancy->job_title) }}">
        </div>

        <div class="form-group">
            <label for="job_description">Job Description</label>
            <textarea class="form-control" id="job_description" name="job_description">{{ old('job_description', $vacancy->job_description) }}</textarea>
        </div>

        <div class="form-group">
		    <label for="content_type">Content Type</label>
		    <select class="form-control" name="content_type" id="content_type">
		        <option value="PDF" {{ old('content_type', $vacancy->content_type) == 'PDF' ? 'selected' : '' }}>PDF File Upload</option>
		        <option value="Website" {{ old('content_type', $vacancy->content_type) == 'Website' ? 'selected' : '' }}>Website URL</option>
		    </select>
		</div>

		<div class="form-group" id="document_upload" style="display: {{ old('content_type', $vacancy->content_type) == 'PDF' ? 'block' : 'none' }};">
		    <label for="document_upload">Document Upload (PDF)</label>
		    <input type="file" class="form-control" name="document_upload">
		    @if ($vacancy->document_upload)
		        <a href="{{ asset('storage/' . $vacancy->document_upload) }}" target="_blank">View Current Document</a>
		    @endif
		</div>

		<div class="form-group" id="website_link" style="display: {{ old('content_type', $vacancy->content_type) == 'Website' ? 'block' : 'none' }};">
		    <label for="website_link">Website Link</label>
		    <input type="text" class="form-control" name="website_link" value="{{ old('website_link', $vacancy->website_link) }}">
		</div>

        <div class="form-group">
            <label for="publish_date">Publish Date</label>
            <input type="date" class="form-control" name="publish_date" value="{{ old('publish_date', $vacancy->publish_date) }}">
        </div>

        <div class="form-group">
            <label for="expiry_date">Expiry Date</label>
            <input type="date" class="form-control" name="expiry_date" value="{{ old('expiry_date', $vacancy->expiry_date) }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="1" {{ $vacancy->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                <option value="2" {{ $vacancy->status == 'Approval' ? 'selected' : '' }}>Approval</option>
                <option value="3" {{ $vacancy->status == 'Publish' ? 'selected' : '' }}>Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Vacancy</button>
        <a href="{{ route('manage_vacancy.index') }}" class="btn btn-danger">Cancel</a>
    </form>

    <script>
        document.getElementById('content_type').addEventListener('change', function() {
            var contentType = this.value;
            
            if (contentType === 'PDF') {
                document.getElementById('document_upload').style.display = 'block';
                document.getElementById('website_link').style.display = 'none';
            } else if (contentType === 'Website') {
                document.getElementById('website_link').style.display = 'block';
                document.getElementById('document_upload').style.display = 'none';
            } else {
                document.getElementById('document_upload').style.display = 'none';
                document.getElementById('website_link').style.display = 'none';
            }
        });
    </script>
@endsection
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('job_description');
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="publish_date"]').setAttribute('min', today);
        document.querySelector('input[name="expiry_date"]').setAttribute('min', today);
    });
</script>