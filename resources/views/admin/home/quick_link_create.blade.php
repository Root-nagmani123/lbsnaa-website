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
                    <h4 class="fw-semibold fs-18 mb-0">Add Quick Links</h4>
                </div>
              
                <form action="{{ route('admin.quick_links.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <label class="me-3">
                                        <input type="radio" name="language" value="1"
                                            {{ old('language') == '1' ? 'checked' : '' }}> English
                                    </label>
                                    <label>
                                        <input type="radio" name="language" value="2"
                                            {{ old('language') == '2' ? 'checked' : '' }}> Hindi
                                    </label>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="Text">Text:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="text" class="form-control text-dark  h-58" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="link_type">Link Type:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select id="link_type" class="form-control h-58 text-dark " name="link_type"
                                        onchange="toggleLinkInput()">
                                        <option value="" selected>Select</option>
                                        <option value="url">URL</option>
                                        <option value="file">Document</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="url_input" style="display: none;">
                            <div class="col-lg-6 mb-4">
                                <label for="url" class="label">URL :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="url" class="form-control text-dark  h-58">
                                    <small class="text-muted">Provide a URL if you're not uploading a document.</small>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="url_type" class="label">URL Type</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="url_type" id="url_type" class="form-control h-58 text-dark ">
                                        <option value="" selected>Select</option>
                                        <option value="internal">Internal Link</option>
                                        <option value="external">External Link</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4" id="file_input" style="display: none;">
                            <label for="file" class="label">Document (PDF) :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="file" name="file" class="form-control text-dark  h-58">
                                <small class="text-muted">Provide a file if you're not entering a URL.</small>
                            </div>

                        </div>

                        <!-- Status Field -->
                        <div class="col-lg-6 mb-4">
                            <label for="status" class="label">Status : </label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="status" id="status" class="form-control h-58 text-dark ">
                                    <option value="" selected>Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                            &nbsp;
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