@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Center</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
                <i class="ri-arrow-right-double-line"></i>
                <span>Manage Media Center</span>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Home Banner - Micro</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Edit Home Banner - Micro</h4>
                </div>
                <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="language" class="label">Page Language</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        {{ $slider->language == '1' ? 'checked' : '' }}>
                                    English
                                    <input type="radio" name="language" value="2"
                                        {{ $slider->language == '2' ? 'checked' : '' }}>
                                    Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="research_centre">Select Research Centre:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="research_centre"
                                        id="research_centre" required>
                                        <option value="" disabled
                                            {{ is_null($slider->research_centre) ? 'selected' : '' }}>
                                            Select Research Centre
                                        </option>
                                        @foreach($researchCentres as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ (string)$slider ->research_centre === (string)$id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="slider_image" class="label">Slider Image</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="slider_image" id="slider_image"
                                        class="form-control text-dark  h-58">
                                    <span class="star">Best Size for banner is : 1,365px × 475px</span>
                                    <img src="{{ asset('storage/' . $slider->slider_image) }}" alt="Current Image"
                                        width="150" class="mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="slider_text" class="label">Slider Text</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="slider_text" id="slider_text"
                                        class="form-control text-dark  h-58" value="{{ $slider->slider_text }}"
                                        required>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="slider_description" class="label">Slider Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="slider_description" id="description"
                                        class="form-control text-dark  h-58"
                                        required>{{ $slider->slider_description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="status" class="label">Status </label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="status" id="status" class="form-control text-dark  h-58" required>
                                        <option value="1" {{ $slider->status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $slider->status == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0 mt-4">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="{{ route('slider.index') }}" class="btn btn-secondary text-white">Back</a>
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
<!-- here this code use for the editer js -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
  $.noConflict();
jQuery(document).ready(function ($) {
    $('#description').summernote({
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['style']], // Heading styles (e.g., H1, H2)
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']], // Font options
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
            pdf: function () {
                var ui = $.summernote.ui; 

                // Create a PDF upload button
                return ui.button({
                    contents: '<i class="note-icon-file"></i> PDF',
                    tooltip: 'Upload PDF',
                    click: function () {
                        // Trigger file input dialog
                        $('<input type="file" accept="application/pdf">')
                            .on('change', function (event) {
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
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token to headers
        },
            success: function (response) {
                $('#description').summernote('insertText', response.url);
      
            },
            error: function (xhr) {
                alert('Failed to upload PDF. Please try again.');
            }
        });
    }
});
</script>
<!-- here this code end of the editer js -->
<!-- here this code end of the editer js -->
@endsection