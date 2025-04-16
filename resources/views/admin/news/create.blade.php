@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage News</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">News</span>
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
                    <h4 class="fw-semibold fs-18 mb-0">Add News</h4>
                </div>

                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        {{ old('language') == 1 ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2"
                                        {{ old('language') == 2 ? 'checked' : '' }}> Hindi
                                        <input type="radio" name="language" value="0"
                                        {{ old('language') == 0 ? 'checked' : '' }}> All
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="title">Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="title" id="title"
                                        value="{{ old('title') }}">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="title_hindi">Title in Hindi :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="title_hindi"
                                        id="title_hindi" value="{{ old('title_hindi') }}">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="short_description" class="label">Short Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="short_description" id="short_description"
                                        class="form-control  text-dark">{{ old('short_description') }}</textarea>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_title">Meta Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="meta_title"
                                        id="meta_title" value="{{ old('meta_title') }}">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="meta_keywords" class="label">Meta Keywords :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="meta_keywords"
                                        id="meta_keywords" value="{{ old('meta_keywords') }}">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="meta_description" class="label">Meta Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="meta_description" id="meta_description"
                                        class="form-control  text-dark">{{ old('meta_description') }}</textarea>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description" class="label">Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="description" id="description"
                                        class="form-control  text-dark">{{ old('description') }}</textarea>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description_hindi" class="label">Description in Hindi</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="description_hindi" id="description_hindi"
                                        class="form-control  text-dark">{{ old('description_hindi') }}</textarea>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="main_image" class="label">Main Image</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="main_image" id="main_image"
                                        class="form-control text-dark  h-58">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="multiple_images" class="label">Upload Multiple Image</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="multiple_images[]" id="multiple_images"
                                        class="form-control text-dark  h-58" multiple>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="start_date" class="label">Start Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" name="start_date" id="start_date"
                                        class="form-control text-dark  h-58" value="{{ old('start_date') }}">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="end_date" class="label">End Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" name="end_date" id="end_date"
                                        class="form-control text-dark  h-58" value="{{ old('end_date') }}">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="status" id="status">
                                        <option value="" class="text-dark" selected>Select</option>
                                        <option value="1" class="text-dark"
                                            {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark"
                                            {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                            &nbsp;
                            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary text-white">Back</a>
                        </div>

                    </div>
                </form>



            </div>
        </div>
    </div>
</div>
<!-- here this code use for the editer js -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
$.noConflict();
jQuery(document).ready(function($) {
    $('#description').summernote({
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['style']], // Heading styles (e.g., H1, H2)
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript',
                'clear'
            ]], // Font options
            ['fontname', ['fontname']], // Font family selector
            ['fontsize', ['fontsize']], // Font size selector
            ['color', ['color']], // Font and background color
            ['para', ['ul', 'ol', 'paragraph', 'align']], // Lists and alignment
            ['height', ['height']], // Line height adjustment
            ['table', ['table']], // Table insertion
            ['insert', ['link', 'picture', 'video', 'pdf']], // Insert elements
            ['view', ['fullscreen', 'codeview', 'help']], // Fullscreen, code view, and help
            ['misc', ['undo', 'redo']] // Undo and redo actions
        ],
        buttons: {
            pdf: function() {
                var ui = $.summernote.ui;

                // Create a PDF upload button
                return ui.button({
                    contents: '<i class="note-icon-file"></i> PDF',
                    tooltip: 'Upload PDF',
                    click: function() {
                        // Trigger file input dialog
                        $('<input type="file" accept="application/pdf">')
                            .on('change', function(event) {
                                var file = event.target.files[0];
                                if (file) {
                                    uploadPDF(file);
                                }
                            })
                            .click();
                    }
                }).render();
            }
        }
    });


    function uploadPDF(file) {
        // Use AJAX to upload the file to your server
        var formData = new FormData();
        formData.append('file', file);

        $.ajax({
            url: '/admin/upload-pdf', // Your server endpoint
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content') // Add CSRF token to headers
            },
            success: function(response) {
                $('#description').summernote('insertText', response.url);

            },
            error: function(xhr) {
                alert('Failed to upload PDF. Please try again.');
            }
        });
    }
});
jQuery(document).ready(function($) {
    $('#description_hindi').summernote({
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['style']], // Heading styles (e.g., H1, H2)
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript',
                'clear'
            ]], // Font options
            ['fontname', ['fontname']], // Font family selector
            ['fontsize', ['fontsize']], // Font size selector
            ['color', ['color']], // Font and background color
            ['para', ['ul', 'ol', 'paragraph', 'align']], // Lists and alignment
            ['height', ['height']], // Line height adjustment
            ['table', ['table']], // Table insertion
            ['insert', ['link', 'picture', 'video', 'pdf']], // Insert elements
            ['view', ['fullscreen', 'codeview', 'help']], // Fullscreen, code view, and help
            ['misc', ['undo', 'redo']] // Undo and redo actions
        ],
        buttons: {
            pdf: function() {
                var ui = $.summernote.ui;

                // Create a PDF upload button
                return ui.button({
                    contents: '<i class="note-icon-file"></i> PDF',
                    tooltip: 'Upload PDF',
                    click: function() {
                        // Trigger file input dialog
                        $('<input type="file" accept="application/pdf">')
                            .on('change', function(event) {
                                var file = event.target.files[0];
                                if (file) {
                                    uploadPDF(file);
                                }
                            })
                            .click();
                    }
                }).render();
            }
        }
    });


    function uploadPDF(file) {
        // Use AJAX to upload the file to your server
        var formData = new FormData();
        formData.append('file', file);

        $.ajax({
            url: '/admin/upload-pdf', // Your server endpoint
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content') // Add CSRF token to headers
            },
            success: function(response) {
                $('#description').summernote('insertText', response.url);

            },
            error: function(xhr) {
                alert('Failed to upload PDF. Please try again.');
            }
        });
    }
});
</script>
<!-- here this code end of the editer js -->

@endsection