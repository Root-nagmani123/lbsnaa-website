@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Menu</h3> -->
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('admin.index') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.menus.index') }}" class="text-decoration-none">
                    <i class="ri-arrow-right-double-line"></i>
                    <span>Newsletter</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Add Newsletter</span>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Add Newsletter</h4>
                    </div>



                    <form action="{{ route('admin.newsletter.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="menutitle">Page Language :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="radio" name="txtlanguage" value="1"> English
                                        <input type="radio" name="txtlanguage" value="2"> Hindi
                                    </div>
                                    @error('txtlanguage')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="newsletterTitle">Newsletter Title :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark  h-58" name="newsletterTitle" id="newsletterTitle" value="{{ old('newsletterTitle') }}" placeholder="Enter Newsletter Title" required>
                                        @error('newsletterTitle')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label" for="img_file">Upload Image</label>
                                    <div class="fomr-group position-relative">
                                        <input type="file" name="img_file" src="" alt="" class="form-control text-dark h-58" accept="`">
                                        @error('img_file')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" id="pdf-upload-field">
                                <div class="form-group mb-4">
                                    <label class="label" for="pdf_file">Upload PDF</label>
                                    <div class="fomr-group position-relative">
                                        <input id="pdf_file" type="file" name="pdf_file" accept=".pdf" class="form-control text-dark  h-58">

                                        @error('pdf_file')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" id="pdf-upload-field">
                                <div class="form-group mb-4">
                                    <label class="label" for="ebook_file">Upload E-Book</label>
                                    <div class="fomr-group position-relative">
                                        <input id="ebook_file" type="file" name="ebook_file" accept=".pdf" class="form-control text-dark  h-58">

                                        @error('ebook_file')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex ms-sm-3 ms-md-0">
                                <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>&nbsp;
                                <a href="{{ route('admin.newsletter.index') }}"
                                    class="btn btn-secondary text-white">Back</a>
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

    {{-- <script>
  $.noConflict();
jQuery(document).ready(function ($) {
    $('#content').summernote({
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
                $('#content').summernote('insertText', response.url);
      
            },
            error: function (xhr) {
                alert('Failed to upload PDF. Please try again.');
            }
        });
    }
});
</script>
<!-- here this code end of the editer js -->
<script>
document.getElementById('texttype').addEventListener('change', function() {
    const value = this.value;
    document.getElementById('content-field').style.display = value === '1' ? 'block' : 'none';
    document.getElementById('pdf-upload-field').style.display = value === '2' ? 'block' : 'none';
    document.getElementById('website-url-field').style.display = value === '3' ? 'block' : 'none';

});
document.getElementById('txtpostion').addEventListener('change', function() {
    const value = this.value;
    if (value == 3 || value == 4 || value == 5 || value == 6 || value == 7) {
        var selectElement = document.getElementById('menucategory');

        // Loop through all options and disable them except for the one with value '0'
        for (var i = 0; i < selectElement.options.length; i++) {
            if (selectElement.options[i].value !== '0') {
                selectElement.options[i].disabled = true;
            } else {
                selectElement.options[i].disabled = false; // Ensure '0' is enabled
                selectElement.options[i].selected = true; // Select the '0' option
            }
        }
    }
});
</script>

<script>

function displayFileName() {
    const fileInput = document.getElementById('file-upload');
    const fileNameDiv = document.getElementById('file-name');

    if (fileInput.files && fileInput.files[0]) {
        const fileName = fileInput.files[0].name;
        fileNameDiv.textContent = 'Selected file: ' + fileName;
        fileNameDiv.style.display = 'block'; // Show the file name
    } else {
        fileNameDiv.style.display = 'none'; // Hide if no file is selected
    }
}


</script> --}}
@endsection
