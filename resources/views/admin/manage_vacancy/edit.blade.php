@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Vacancy</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Vacancy</span>
        </li>
    </ul>
</div>
@if(Cache::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Cache::get('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(Cache::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Cache::get('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(Cache::has('validation_errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach (Cache::get('validation_errors') as $field => $errors)
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add Vacancy</h4>
                </div>
              
                <form action="{{ route('manage_vacancy.update', $vacancy->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        {{ $vacancy->language == '1' ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2"
                                        {{ $vacancy->language == '2' ? 'checked' : '' }}> Hindi
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="job_title">Job Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="job_title"
                                        id="job_title" value="{{ old('job_title', $vacancy->job_title) }}">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="job_description">Job Description :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea class="form-control" id="job_description"
                                        placeholder="Enter the Job Description" name="job_description"
                                        rows="5">{{ old('job_description', $vacancy->job_description) }}</textarea>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="content_type">Content Type :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="content_type"
                                        id="content_type" required>
                                        <!-- <option value="" class="text-dark">Select</option> -->
                                        <option value="PDF" class="text-dark"
                                            {{ old('content_type', $vacancy->content_type) == 'PDF' ? 'selected' : '' }}>
                                            PDF File Upload</option>
                                        <option value="Website" class="text-dark"
                                            {{ old('content_type', $vacancy->content_type) == 'Website' ? 'selected' : '' }}>
                                            Website URL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="document_upload"
                            style="display: {{ old('content_type', $vacancy->content_type) == 'PDF' ? 'block' : 'none' }};">
                            <div class="form-group mb-4">
                                <label class="label" for="document_upload">Document Upload :</label>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark  h-58" name="document_upload"
                                        id="document_upload">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="website_link"
                            style="display: {{ old('content_type', $vacancy->content_type) == 'Website' ? 'block' : 'none' }};">
                            <div class="form-group mb-4">
                                <label class="label" for="website_link">Website Link :</label>
                                <div class="form-group position-relative">
                                    <input type="url" class="form-control text-dark  h-58" name="website_link"
                                        id="website_link" value="{{ old('website_link', $vacancy->website_link) }}">

                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="document_upload">
                            <div class="form-group mb-4">
                                <label class="label" for="publish_date">Publish Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark  h-58" name="publish_date"
                                        id="publish_date" value="{{ old('publish_date', $vacancy->publish_date) }}">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="website_link">
                            <div class="form-group mb-4">
                                <label class="label" for="expiry_date">Expiry Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark  h-58" name="expiry_date"
                                        id="expiry_date" value="{{ old('expiry_date', $vacancy->expiry_date) }}">
                                 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="texttype">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="status" id="status"
                                        required>
                                        <option value="1" class="text-dark"
                                            {{ $vacancy->status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark"
                                            {{ $vacancy->status == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="{{ route('manage_vacancy.index') }}"
                                class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
<!-- here this code use for the editer js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$('#job_description').summernote({
    tabsize: 2,
    height: 300
});
</script>  
<!-- here this code end of the editer js -->
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