@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Research Centers</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Research</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">Add Research Center</h4>
            </div>
            <form action="{{ route('researchcentres.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="language" class="label">Page Language</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="radio" name="language" id="language" value="1"
                                    {{ old('language') == 1 ? 'checked' : '' }}> English
                                <input type="radio" name="language" id="language" value="2"
                                    {{ old('language') == 2 ? 'checked' : '' }}> Hindi
                            </div>
                            @error('language')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="research_centre_name" class="label">Research center name</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="research_centre_name" id="research_centre_name"
                                    class="form-control text-dark  h-58" value="{{ old('research_centre_name') }}">
                            </div>
                            @error('research_centre_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="sub_heading" class="label">Sub Heading</label>
                            <div class="form-group position-relative">
                                <input type="text" name="sub_heading" id="sub_heading"
                                    class="form-control text-dark  h-58" value="{{ old('sub_heading') }}">
                            </div>
                            @error('sub_heading')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="home_title" class="label">Home title</label>
                            <div class="form-group position-relative">
                                <input type="text" name="home_title" id="home_title"
                                    class="form-control text-dark  h-58" value="{{ old('home_title') }}">
                            </div>
                            @error('home_title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="texttype">Menu Type :</label>
                            <div class="form-group position-relative">
                                <select class="form-select form-control h-58" 
                                        aria-label="Default select example" 
                                        name="texttype" 
                                        id="texttype" 
                                        autocomplete="off" 
                                        onchange="addMenuType(this.value)">
                                    <option selected value="" class="text-dark">Select</option>
                                    <option value="1" class="text-dark">PDF file Upload</option>
                                    <option value="2" class="text-dark">Web Site Url</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Fields -->
                    <div id="pdfField" class="form-group mb-4" style="display: none;">
                        <label class="label" for="pdfUpload">Upload PDF:</label>
                        <input type="file" class="form-control h-58" id="pdfUpload" name="pdfUpload" accept="application/pdf">
                    </div>

                    <div id="urlField" class="form-group mb-4" style="display: none;">
                        <label class="label" for="websiteUrl">Website URL:</label>
                        <input type="url" class="form-control h-58" id="websiteUrl" name="websiteUrl" placeholder="Enter website URL">
                    </div>



                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label" for="description">Description :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <textarea class="form-control" id="description" placeholder="Enter the Description"
                                    name="description" rows="5">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label" for="status">Status :</label>
                            <span class="star">*</span>
                            <select name="status" id="status" class="form-control">
                                <option value="" selected>Select</option>
                                <option value="1" >Active</option>
                                <option value="0" >Inactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex ms-sm-3 ms-md-0">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                        &nbsp;
                        <a href="{{ route('researchcentres.index') }}" class="btn btn-secondary text-white">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- here this code use for the editer js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  
<script>
    function addMenuType(value) {
        // Hide both fields initially
        document.getElementById('pdfField').style.display = 'none';
        document.getElementById('urlField').style.display = 'none';

        // Show the appropriate field based on the selected value
        if (value === "1") {
            document.getElementById('pdfField').style.display = 'block';
        } else if (value === "2") {
            document.getElementById('urlField').style.display = 'block';
        }
    }
</script>
<!-- here this code end of the editer js -->

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


@endsection