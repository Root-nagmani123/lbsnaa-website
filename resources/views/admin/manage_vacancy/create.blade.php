@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>Add Vacancy</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('manage_vacancy.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Language</label>
            <div>
                <label><input type="radio" name="language" value="English" checked> English</label>
                <label><input type="radio" name="language" value="Hindi"> Hindi</label>
            </div>
        </div>

        <div class="form-group">
            <label>Job Title</label>
            <input type="text" name="job_title" class="form-control" value="{{ old('job_title') }}">
        </div>

        <div class="form-group">
            <label>Job Description</label>
            <textarea name="job_description" class="form-control ckeditor">{{ old('job_description') }}</textarea>
        </div>

		<div class="form-group">
		    <label for="content_type">Content Type</label>
		    <select class="form-control" name="content_type" id="content_type">
		        <option value="">Select</option>
		        <option value="PDF">PDF File Upload</option>
		        <option value="Website">Website URL</option>
		    </select>
		</div>

		<div class="form-group" id="document_upload" style="display:none;">
		    <label for="document_upload">Document Upload (PDF)</label>
		    <input type="file" class="form-control" name="document_upload" accept="application/pdf">
		</div>

		<div class="form-group" id="website_link" style="display:none;">
		    <label for="website_link">Website Link</label>
		    <input type="url" class="form-control" name="website_link">
		</div>

        <div class="form-group">
            <label>Publish Date</label>
            <input type="date" name="publish_date" class="form-control" value="{{ old('publish_date') }}">
        </div>

        <div class="form-group">
            <label>Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date') }}">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
            	<option value="">Select</option>
                <option value="1">Draft</option>
                <option value="2">Approval</option>
                <option value="3">Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
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
    CKEDITOR.replace('description');
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="publish_date"]').setAttribute('min', today);
        document.querySelector('input[name="expiry_date"]').setAttribute('min', today);
    });
</script>