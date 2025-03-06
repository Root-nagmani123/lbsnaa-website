@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Structure</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Organization Structure</span>
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
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">Add Organization Setup</h4>
            </div>

            <form action="{{ route('non_org.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
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
                          
                        </div>
                    </div>
                    <div class="col-lg-6">
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
                             
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="employee_name" class="label">Employee Name</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="employee_name" class="form-control text-dark  h-58"
                                    id="employee_name" value="{{ old('employee_name') }}">
                             
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="designation" class="label">Designation</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="designation" class="form-control text-dark  h-58"
                                    id="designation" value="{{ old('designation') }}">
                             
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="email" class="label">Email</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input 
                                    type="email" 
                                    name="email" 
                                    class="form-control text-dark  h-58" 
                                    id="email" 
                                    value="{{ old('email') }}"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}" 
                                    title="Please enter a valid email address.">
                                <small id="email-feedback" class="text-muted"></small>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label for="program_description" class="label">Program Description</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <textarea name="program_description" class="form-control text-dark  h-58"
                                    value="{{ old('program_description') }}" id="description"></textarea>
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="main_image" class="label">Main Image</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="file" name="main_image" class="form-control text-dark  h-58"
                                    id="main_image" accept=".jpg,.jpeg,.png">
                                <small id="file-name" class="text-muted"></small>
                              
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="page_status" class="label">Page Status</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="page_status" class="form-control text-dark  h-58" id="page_status">
                                    <option value="" class="col">Select</option>
                                    <option value="1" class="col" {{ old('page_status') == '1' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" class="col" {{ old('page_status') == '0' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                              
                            </div>
                        </div>
                    </div>
                    <div class="d-flex ms-sm-3 ms-md-0">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                        &nbsp;
                        <a href="{{ route('non_org.index') }}"
                            class="btn btn-secondary text-white">Back</a>
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
$('#program_description').summernote({
    tabsize: 2,
    height: 300
});
</script>  
<!-- here this code end of the editer js -->
<script>
    const fileInput = document.getElementById('main_image');
    const fileNameDisplay = document.getElementById('file-name');

    // Allowed file types
    const allowedExtensions = ['jpg', 'jpeg', 'png'];

    // Display file name and validate file type
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const fileName = file.name;
            const fileExtension = fileName.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                alert('Only JPG, JPEG, and PNG files are allowed.');
                fileInput.value = ''; // Reset file input
                fileNameDisplay.textContent = ''; // Clear display
            } else {
                fileNameDisplay.textContent = `Selected file: ${fileName}`;
            }
        } else {
            fileNameDisplay.textContent = "No file chosen";
        }
    });
</script>
<script>
    const emailInput = document.getElementById('email');
    const emailFeedback = document.getElementById('email-feedback');

    // Frontend validation for email format
    emailInput.addEventListener('input', () => {
        const emailValue = emailInput.value.trim();
        const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;

        if (emailValue === '') {
            emailFeedback.textContent = "Email is required.";
            emailFeedback.classList.add('text-danger');
            emailFeedback.classList.remove('text-muted');
        } else if (!emailRegex.test(emailValue)) {
            emailFeedback.textContent = "Please enter a valid email address.";
            emailFeedback.classList.add('text-danger');
            emailFeedback.classList.remove('text-muted');
        } else {
            emailFeedback.textContent = "Email looks good.";
            emailFeedback.classList.add('text-muted');
            emailFeedback.classList.remove('text-danger');
        }
    });
</script>

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