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
                <i class="ri-arrow-right-double-line"></i>
                <span>CMS Page</span>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Add Menu</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add New Menu</h4>
                </div>
                <form action="{{ route('micromenus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        {{ old('language') == 1 ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2"
                                        {{ old('language') == 2 ? 'checked' : '' }}> Hindi
                                </div>
                                @error('language')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="select_research_centre" class="label">Select Research Centre:</label>
                                <span class="star">*</span>
                                <select id="select_research_centre" name="research_centre"
                                    class="form-control h-58 text-dark">
                                    <option value="" selected>Select Research Centre</option>
                                    @foreach ($researchCentres as $id => $name)
                                    <!-- <option value="{{ $id }}">{{ $name }}</option> -->
                                    <option value="{{ $id }}" {{ old('research_centre') == $id ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('research_centre')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Menu Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="menutitle"
                                        id="menutitle" value="{{ old('menutitle') }}">
                                    @error('menutitle')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="texttype">Menu Type :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" aria-label="Default select example"
                                        name="texttype" id="texttype" autocomplete="off"
                                        onchange="addmenutype(this.value)">
                                        <option selected value="" class="text-dark">Select</option>
                                        <option value="1" class="text-dark">Content</option>
                                        <!-- <option value="1" class="text-dark" {{ old('texttype') == '1' ? 'selected' : '' }}>Content</option> -->


                                        <option value="2" class="text-dark">PDF file Upload</option>
                                        <option value="3" class="text-dark">Web Site Url</option>
                                    </select>
                                    @error('texttype')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div style="display: none;" id="additional-fields">
                            <div class="row" id="content-field" style="display: none;">
                                <div class="col-lg-12">
                                    <div class="form-group mb-0">
                                        <label class="label" for="content">Content :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea class="form-control  text-dark" rows="5" name="content" id="description"
                                             value="{{ old('content') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label class="label" for="meta_title">Meta Title:</label>
                                            <span class="star">*</span>
                                            <div class="form-group position-relative">
                                                <input type="text" class="form-control text-dark  h-58"
                                                    name="meta_title" id="meta_title" value="{{ old('meta_title') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label class="label" for="meta_keyword">Meta Keyword :</label>
                                            <span class="star">*</span>
                                            <div class="form-group position-relative">
                                                <input type="text" class="form-control text-dark  h-58"
                                                    name="meta_keyword" id="meta_keyword"
                                                    value="{{ old('meta_keyword') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label" for="meta_description">Meta Description :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea class="form-control  text-dark" placeholder="Some demo text ... "
                                                cols="30" rows="5" name="meta_description" id="meta_description"
                                                value="{{ old('meta_description') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" style="display: none;" id="pdf-upload-field">
                                <div class="form-group mb-4">
                                    <label class="label" for="pdf_file">Upload PDF :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input id="file-upload" type="file" name="pdf_file" accept=".pdf"
                                            onchange="displayFileName()" class="form-control text-dark  h-58">
                                    </div>
                                    @error('pdf_file')
                                            <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                        @enderror
                                </div>
                            </div>
                            <div class="row" id="website-url-field" style="display: none;">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="website_url">Website URL:</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark  h-58" name="website_url"
                                                id="website_url">
                                            @error('website_url')
                                            <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="web_site_target">Web Site Target :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <select class="form-select form-control  h-58" name="web_site_target"
                                                id="web_site_target" autocomplete="off">
                                                <option selected class="text-dark">Select</option>
                                                <option value="1" class="text-dark">Internal Link</option>
                                                <option value="2" class="text-dark">External Link</option>
                                            </select>
                                            @error('web_site_target')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="menucategory" class="label">Primary Link :</label>
                                <span class="star">*</span>
                                <select class="form-control h-58 text-dark" name="menucategory" id="menucategory">
                                    <option value="0" selected>It is Root Category</option>
                                </select>
                                @error('menucategory')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="txtpostion">Content Position :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" id="txtpostion" autocomplete="off"
                                        autocomplete="off" name="txtpostion" onchange="showDateFields(this.value)">
                                        <option selected value="" class="text-dark">Select</option>
                                        <!-- <option value="1" class="text-dark">Header Menu</option> -->
                                        <option value="1" class="text-dark"
                                            {{ old('txtpostion') == '1' ? 'selected' : '' }}>Header Menu</option>

                                        <!-- <option value="2" class="text-dark">Bottom Menu</option>
                                        <option value="3" class="text-dark">Footer Menu</option>
                                        <option value="4" class="text-dark">Director Message Menu</option>
                                        <option value="5" class="text-dark">Life Academy Menu</option>
                                        <option value="6" class="text-dark">Other Pages</option>
                                        <option value="7" class="text-dark">Latest Updates</option> -->
                                    </select>
                                    @error('txtpostion')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menu_status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" id="menu_status" name="menu_status">
                                        <option value="">Select</option>
                                        <option value="1" class="text-dark"
                                            {{ old('menu_status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark"
                                            {{ old('menu_status') == '0' ? 'selected' : '' }}>Inactive</option>

                                    </select>
                                    @error('menu_status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>&nbsp;
                            <a href="{{ route('micromenus.index') }}" class="btn btn-secondary text-white">Back</a>
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
$('#content').summernote({
    tabsize: 2,
    height: 300
});
</script>
<!-- here this code end of the editer js -->
<script>
function addmenutype(value) {
    // Hide all additional fields initially
    document.getElementById('additional-fields').style.display = 'block';
    document.getElementById('content-field').style.display = 'none';
    document.getElementById('pdf-upload-field').style.display = 'none';
    document.getElementById('website-url-field').style.display = 'none';

    // Show fields based on the selected menu type
    if (value === '1') { // Content
        document.getElementById('content-field').style.display = 'block';
    } else if (value === '2') { // PDF file upload
        document.getElementById('pdf-upload-field').style.display = 'block';
    } else if (value === '3') { // Website URL
        document.getElementById('website-url-field').style.display = 'block';
    }
}

function showDateFields(value) {
    const dateFields = document.getElementById('date-fields');
    if (value === '7') { // Latest Updates
        dateFields.style.display = 'block';
    } else {
        dateFields.style.display = 'none';
    }
}
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
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#select_research_centre').on('change', function() {
        let researchCentreId = $(this).val();

        // Clear previous menu options
        $('#menucategory').html('<option value="0">It is Root Category</option>');

        if (researchCentreId) {
            $.ajax({
                url: "{{ route('get.menus') }}",
                type: "GET",
                data: {
                    research_centre_id: researchCentreId
                },
                success: function(response) {
                    if (response.menuOptions) {
                        $('#menucategory').append(response.menuOptions);
                    } else if (response.error) {
                        alert(response.error);
                    }
                },
                // error: function (xhr) {
                //     console.error('Error fetching menus:', xhr.responseText);
                //     alert('An error occurred while fetching menu options.');
                // }
            });
        }
    });
});
</script>

<!-- here this code use for the editer js -->
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