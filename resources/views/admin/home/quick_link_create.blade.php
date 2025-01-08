@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Quill Better Table CSS -->
<link href="https://cdn.jsdelivr.net/npm/quill-better-table@1.2.10/dist/quill-better-table.min.css" rel="stylesheet">


<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Quick Links</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add Quick Links</h4>
                </div>

                <form action="{{ route('admin.quick_links.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Main Grid -->
                    <div class="row">
                        <!-- Text Field -->

                        <div class="col-lg-6 mb-4">
                            <label for="text" class="label">Text <span class="star">*</span></label>
                            <input type="text" name="text" class="form-control text-dark  h-58" required>
                        </div>

                        <!-- Hidden Input Field -->
                        <!-- <input type="hidden" name="text" id="hiddenContent"> -->

                        <!-- Link Type -->
                        <div class="col-lg-6 mb-4">
                            <label for="link_type" class="label">Link Type <span class="star">*</span></label>
                            <select id="link_type" class="form-control h-58 text-dark " name="link_type"
                                onchange="toggleLinkInput()">
                                <option value="" selected>Select</option>
                                <option value="url">URL</option>
                                <option value="file">Document</option>
                            </select>
                        </div>
                    </div>

                    <!-- Conditional URL Input Row -->
                    <div class="row" id="url_input" style="display: none;">
                        <div class="col-lg-6 mb-4">
                            <label for="url" class="label">URL <span class="star">*</span></label>
                            <input type="text" name="url" class="form-control text-dark  h-58">
                            <small class="text-muted">Provide a URL if you're not uploading a document.</small>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label for="url_type" class="label">URL Type</label>
                            <select name="url_type" id="url_type" class="form-control h-58 text-dark ">
                                <option value="" selected>Select</option>
                                <option value="internal">Internal Link</option>
                                <option value="external">External Link</option>
                            </select>
                        </div>
                    </div>

                    <!-- Conditional File Input Row -->
                    <div class="row" id="file_input" style="display: none;">
                        <div class="col-lg-6 mb-4">
                            <label for="file" class="label">Document (PDF) <span class="star">*</span></label>
                            <input type="file" name="file" class="form-control text-dark  h-58">
                            <small class="text-muted">Provide a file if you're not entering a URL.</small>
                        </div>
                    </div>

                    <!-- Status Field -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label for="status" class="label">Status <span class="star">*</span></label>
                            <select name="status" id="status" class="form-control h-58 text-dark ">
                                <option value="" selected>Select</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row mt-4">
                        <div class="col-lg-6 d-flex gap-2">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                            <a href="{{ route('admin.quick_links.index') }}"
                                class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    function toggleLinkInput() {
        var linkType = document.getElementById('link_type').value;

        // Hide both by default
        document.getElementById('url_input').style.display = 'none';
        document.getElementById('file_input').style.display = 'none';

        // Show the relevant input based on the selection
        if (linkType === 'url') {
            document.getElementById('url_input').style.display = 'block';
        } else if (linkType === 'file') {
            document.getElementById('file_input').style.display = 'block';
        }
    }

    // Call the function on page load in case there's a default selection
    toggleLinkInput();
    
    document.getElementById('link_type').addEventListener('change', toggleLinkInput);
});
</script>