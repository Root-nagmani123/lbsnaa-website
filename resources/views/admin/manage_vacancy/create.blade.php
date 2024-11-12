@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Add Vacancy</h4>
            </div>
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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1">English
                                    <input type="radio" name="language" value="2">Hindi
                                </div>
                            </div>
                            
                        </div>
                      
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="job_title">Job Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="job_title"
                                        id="job_title"  value="{{ old('job_title') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="job_description">Job Description :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <div id="standalone-container">
                                        <div id="toolbar-container">
                                            <span class="ql-formats">
                                                <select class="ql-font"></select>
                                                <select class="ql-size"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-bold"></button>
                                                <button class="ql-italic"></button>
                                                <button class="ql-underline"></button>
                                                <button class="ql-strike"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-blockquote"></button>
                                                <button class="ql-code-block"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-list" value="ordered"></button>
                                                <button class="ql-list" value="bullet"></button>
                                                <button class="ql-indent" value="-1"></button>
                                                <button class="ql-indent" value="+1"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-link"></button>
                                                <button class="ql-image"></button>
                                                <button class="ql-video"></button>
                                            </span>
                                        </div>
                                        <div id="editor-container" style="height: 250px;">{{ old('job_description') }}</div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="content_type">Content Type :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="content_type" id="content_type" required>
                                        <option value="" class="text-dark">Select</option>
                                        <option value="PDF" class="text-dark">PDF File Upload</option>
                                        <option value="Website" class="text-dark">Website URL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="document_upload" style="display:none;">
                            <div class="form-group mb-4">
                                <label class="label" for="document_upload">Document Upload :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark ps-5 h-58" name="document_upload"
                                        id="document_upload">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="website_link" style="display:none;">
                            <div class="form-group mb-4">
                                <label class="label" for="website_link">Website Link :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="url" class="form-control text-dark ps-5 h-58" name="website_link"
                                        id="website_link">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="texttype">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status" required>
                                        <option value="0" class="text-dark">Select</option>
                                        <option value="1" class="text-dark">Draft</option>
                                        <option value="2" class="text-dark">Approval</option>
                                        <option value="3" class="text-dark">Publish</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button> &nbsp;
                            <button class="btn btn-warning text-white fw-semibold" type="reset">Reset</button> &nbsp;
                            <a href="{{ route('manage_vacancy.index') }}" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>


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