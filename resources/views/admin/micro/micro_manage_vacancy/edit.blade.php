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
                    <h4 class="fw-semibold fs-18 mb-0">Edit Vacancy</h4>
                </div>

                <form action="{{ route('micro_manage_vacancy.update', $vacancy->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Page Language -->
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="language" class="label">Page Language</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1" {{ $vacancy->language == '1' ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2" {{ $vacancy->language == '2' ? 'checked' : '' }}> Hindi
                                </div>
                            </div>
                        </div>

                        <!-- Research Centre -->
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="research_centre">Select Research Centre:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="research_centre" id="research_centre">
                                        @foreach($researchCentres as $id => $name)
                                        <option value="{{ $id }}" {{ (string)$vacancy->research_centre === (string)$id ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Job Title -->
                        <div class="col-lg-4">
                            <div class="form-group mb-2">
                                <label for="job_title" class="label">Job Title</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control h-58 ps-5 text-dark" name="job_title" value="{{ old('job_title', $vacancy->job_title) }}">
                                    @error('job_title') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Job Description -->
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="job_description" class="label">Job Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea class="form-control text-dark ps-5" id="job_description" name="job_description">{{ old('job_description', $vacancy->job_description) }}</textarea>
                                    @error('job_description') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Content Type (PDF or Website URL) -->
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label for="content_type" class="label">Content Type</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-control text-dark ps-5 h-58" name="content_type" id="content_type">
                                        <option value="PDF" {{ old('content_type', $vacancy->content_type) == 'PDF' ? 'selected' : '' }}>PDF File Upload</option>
                                        <option value="Website" {{ old('content_type', $vacancy->content_type) == 'Website' ? 'selected' : '' }}>Website URL</option>
                                    </select>
                                    @error('content_type') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Document Upload (PDF) -->
                        <div class="col-lg-6" id="document_upload" style="display: {{ old('content_type', $vacancy->content_type) == 'PDF' ? 'block' : 'none' }};">
                            <div class="form-group mb-2">
                                <label for="document_upload" class="label">Document Upload (PDF)</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark ps-5 h-58" name="document_upload" id="document_upload">
                                    @if ($vacancy->document_upload)
                                    <p class="mt-2"><a href="{{ asset('storage/' . $vacancy->document_upload) }}" target="_blank">Download current file</a></p>
                                    @endif
                                    @error('document_upload') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Website Link -->
                        <div class="col-lg-6" id="website_link" style="display: {{ old('content_type', $vacancy->content_type) == 'Website' ? 'block' : 'none' }};">
                            <div class="form-group mb-2">
                                <label for="website_link" class="label">Website Link</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="url" class="form-control text-dark ps-5 h-58" name="website_link" value="{{ old('website_link', $vacancy->website_link) }}">
                                    @error('website_link') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Publish Date -->
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="publish_date" class="label">Publish Date</label>
                                <span class="star">*</span>
                                <input type="date" name="publish_date" id="publish_date" value="{{ old('publish_date', $vacancy->publish_date) }}" class="form-control">
                                @error('publish_date') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Expiry Date -->
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="expiry_date" class="label">Expiry Date</label>
                                <span class="star">*</span>
                                <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $vacancy->expiry_date) }}" class="form-control">
                                @error('expiry_date') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="status" class="label">Status</label>
                                <span class="star">*</span>
                                <select class="form-select" name="status">
                                    <option value="1" {{ old('status', $vacancy->status) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $vacancy->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Toggle the visibility of the file upload or website URL based on content type selection
    document.getElementById('content_type').addEventListener('change', function() {
        if (this.value == 'PDF') {
            document.getElementById('document_upload').style.display = 'block';
            document.getElementById('website_link').style.display = 'none';
        } else {
            document.getElementById('document_upload').style.display = 'none';
            document.getElementById('website_link').style.display = 'block';
        }
    });
</script>
@endsection
