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

                <form action="{{ route('micro_manage_vacancy.update', $vacancy->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="language" class="label">Page Language</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        {{ $vacancy->language == '1' ? 'checked' : '' }}>
                                    English
                                    <input type="radio" name="language" value="2"
                                        {{ $vacancy->language == '2' ? 'checked' : '' }}>
                                    Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="research_centre">Select Research Centre:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="research_centre"
                                        id="research_centre" required>
                                        <option value="" disabled
                                            {{ is_null($vacancy->research_centre) ? 'selected' : '' }}>
                                            Select Research Centre
                                        </option>
                                        @foreach($researchCentres as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ (string)$vacancy ->research_centre === (string)$id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-2">
                                <label for="job_title" class="label">Job Title</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control h-58 ps-5 text-dark" name="job_title"
                                        value="{{ old('job_title', $vacancy->job_title) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="job_description" class="label">Job Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea class="form-control text-dark ps-5" id="job_description"
                                        name="job_description">{{ old('job_description', $vacancy->job_description) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label for="content_type" class="label">Content Type</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-control text-dark ps-5 h-58" name="content_type"
                                        id="content_type">
                                        <option value="PDF"
                                            {{ old('content_type', $vacancy->content_type) == 'PDF' ? 'selected' : '' }}>
                                            PDF File
                                            Upload</option>
                                        <option value="Website"
                                            {{ old('content_type', $vacancy->content_type) == 'Website' ? 'selected' : '' }}>
                                            Website
                                            URL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6"
                            style="display: {{ old('content_type', $vacancy->content_type) == 'PDF' ? 'block' : 'none' }};">
                            <div class="form-group mb-2" id="document_upload">
                                <label for="document_upload" class="label">Document Upload (PDF)</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark ps-5 h-58" name="document_upload"
                                        id="document_upload">
                                    @if ($vacancy->document_upload)
                                    <a href="{{ $vacancy->document_upload }}" target="_blank">View document</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6"
                            style="display: {{ old('content_type', $vacancy->content_type) == 'Website' ? 'block' : 'none' }};">
                            <div class="form-group mb-2" id="website_link">
                                <label for="website_link" class="label">Website Link</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="url" class="form-control text-dark ps-5 h-58" name="website_link"
                                        id="website_link" value="{{ old('website_link', $vacancy->website_link) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="publish_date" class="label">Publish Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark ps-5 h-58" name="publish_date"
                                        id="publish_date" value="{{ old('publish_date', $vacancy->publish_date) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="expiry_date" class="label">Expiry Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark ps-5 h-58" name="expiry_date"
                                        id="expiry_date" value="{{ old('expiry_date', $vacancy->expiry_date) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="status" class="label">Status</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-control text-dark ps-5 h-58" name="status">
                                        <option value="1" {{ $vacancy->status == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $vacancy->status == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="{{ route('micro_manage_vacancy.index') }}" class="btn btn-secondary text-white">Cancel</a>
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

    const startDateInput = document.querySelector('input[name="publish_date"]');
    const endDateInput = document.querySelector('input[name="expiry_date"]');

    // Set min date for both start and end date on page load
    startDateInput.setAttribute('min', today);
    endDateInput.setAttribute('min', today);

    // Update end date min whenever start date is changed
    startDateInput.addEventListener('change', function() {
        endDateInput.setAttribute('min', this.value);
    });
});
</script>