@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">All Vacancy</h3> -->
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
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form action="{{ route('micro_manage_vacancy.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-2">
                            <div class="form-group mb-4">
                                <label for="language" class="label">Page Language</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1" id="language_english"
                                        {{ old('language') == '1' ? 'checked' : '' }}>
                                    <label for="language_english">English</label>

                                    <input type="radio" name="language" value="2" id="language_hindi"
                                        {{ old('language') == '2' ? 'checked' : '' }}>
                                    <label for="language_hindi">Hindi</label>
                                </div>
                                @error('language')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- New Dropdown for Research Centre -->
                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label for="research_centre_id" class="label">Select Research Centre</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="research_centre" id="research_centre_id"
                                        class="form-control text-dark  h-58">
                                        <option value="">Select Research Centre</option>
                                        @foreach ($researchCentres as $id => $name)
                                        <option value="{{ $id }}" {{ old('research_centre') == $id ? 'selected' : '' }}>
                                            {{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('research_centre')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label class="label" for="job_title">Job Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="job_title"
                                        id="job_title" value="{{ old('job_title') }}">
                                    @error('job_title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Job Description with Textarea -->
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="job_description">Job Description :</label>
                                <span class="star">*</span>
                                <textarea class="form-control" name="job_description" id="job_description" rows="5"
                                    value="{{ old('program_name') }}"></textarea>
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
                                    <select class="form-select form-control  h-58" name="content_type"
                                        id="content_type">
                                        <option value="" class="text-dark">Select</option>
                                        <option value="PDF" class="text-dark"
                                            {{ old('content_type') == 'PDF' ? 'checked' : '' }}>PDF File Upload</option>
                                        <option value="Website" class="text-dark"
                                            {{ old('content_type') == 'Website' ? 'checked' : '' }}>Website URL</option>
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
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark  h-58" name="document_upload"
                                        id="document_upload" value="{{ old('document_upload') }}">
                                    @error('document_upload')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="website_link" style="display:none;">
                            <div class="form-group mb-4">
                                <label class="label" for="website_link">Website Link :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="url" class="form-control text-dark  h-58" name="website_link"
                                        id="website_link" value="{{ old('website_link') }}">
                                    @error('website_link')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="publish_date">
                            <div class="form-group mb-4">
                                <label class="label" for="publish_date">Publish Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark  h-58" name="publish_date"
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
                                    <input type="date" class="form-control text-dark  h-58" name="expiry_date"
                                        id="expiry_date" value="{{ old('expiry_date') }}">
                                    @error('expiry_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="texttype">Product Status:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="status" id="status">
                                        <option value="" class="text-dark">Select</option>
                                        <option value="1" class="text-dark"
                                            {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark"
                                            {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button> &nbsp;
                            <a href="{{ route('micro_manage_vacancy.index') }}"
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const contentTypeSelector = document.getElementById("content_type");
        const documentUploadField = document.getElementById("document_upload");
        const websiteLinkField = document.getElementById("website_link");

        // Function to toggle visibility
        function toggleFields() {
            const selectedValue = contentTypeSelector.value;

            // Hide both fields by default
            documentUploadField.style.display = "none";
            websiteLinkField.style.display = "none";

            // Show the appropriate field based on the selected value
            if (selectedValue === "PDF") {
                documentUploadField.style.display = "block";
            } else if (selectedValue === "Website") {
                websiteLinkField.style.display = "block";
            }
        }

        // Add event listener to the select element
        contentTypeSelector.addEventListener("change", toggleFields);

        // Trigger the function on page load to handle old values
        toggleFields();
    });
</script>
