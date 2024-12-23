@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Vacancy</h3>
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
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add Vacancy</h4>
                </div>
                <!-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif -->
                <form action="{{ route('manage_vacancy.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        {{ old('language') == '1' ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2"
                                        {{ old('language') == '2' ? 'checked' : '' }}> Hindi
                                </div>
                                @error('language')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="job_title">Job Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="job_title"
                                        id="job_title" value="{{ old('job_title') }}">

                                    @error('job_title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                        rows="5">{{ old('job_description')}}</textarea>
                                </div>

                                @error('job_description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="content_type">Content Type :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="content_type"
                                        id="content_type">
                                        <option value="" class="text-dark">Select</option>
                                        <option value="PDF" class="text-dark"  {{ old('content_type') == 'PDF' ? 'selected' : '' }}>PDF File Upload</option>
                                        <option value="Website" class="text-dark"  {{ old('content_type') == 'Website' ? 'selected' : '' }}>Website URL</option>
                                    </select>

                                    @error('content_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="document_upload" style="display:none;">
                            <div class="form-group mb-4">
                                <label class="label" for="document_upload">Document Upload :</label>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark ps-5 h-58" name="document_upload"
                                        id="document_upload"  value="{{ old('document_upload') }}">

                                    @error('document_upload')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="website_link" style="display:none;">
                            <div class="form-group mb-4">
                                <label class="label" for="website_link">Website Link :</label>
                                <div class="form-group position-relative">
                                    <input type="url" class="form-control text-dark ps-5 h-58" name="website_link"
                                        id="website_link"   value="{{ old('website_link') }}">

                                    @error('website_link')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="document_upload">
                            <div class="form-group mb-4">
                                <label class="label" for="publish_date">Publish Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark ps-5 h-58" name="publish_date"
                                        id="publish_date" value="{{ old('publish_date') }}">

                                    @error('publish_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="website_link">
                            <div class="form-group mb-4">
                                <label class="label" for="expiry_date">Expiry Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark ps-5 h-58" name="expiry_date"
                                        id="expiry_date" value="{{ old('expiry_date') }}">

                                    @error('expiry_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="texttype">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status">
                                        <option value="" class="text-dark">Select</option>
                                        <option value="1" class="text-dark" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button> &nbsp;
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    let today = new Date().toISOString().split('T')[0];
    document.querySelector('input[name="publish_date"]').setAttribute('min', today);
    document.querySelector('input[name="expiry_date"]').setAttribute('min', today);
});
</script>