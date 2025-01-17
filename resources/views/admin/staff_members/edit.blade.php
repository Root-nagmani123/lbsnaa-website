@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Module</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Staff</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Edit Staff Member</h4>
                </div>

                <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        {{ $staff->language == '1' ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2"
                                        {{ $staff->language == '2' ? 'checked' : '' }}> Hindi
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label class="label" for="name">Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="name" id="name"
                                        value="{{ $staff->name }}">
                                    @error('name')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label class="label" for="name_in_hindi">Name in Hindi :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="name_in_hindi"
                                        id="name_in_hindi" value="{{ $staff->name_in_hindi }}">
                                    @error('name_in_hindi')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="email">Email :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="email" class="form-control text-dark  h-58" name="email" id="email"
                                        value="{{ $staff->email }}">
                                    @error('email')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image">Upload Image :</label>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark  h-58" name="image" id="image">
                                    @if($staff->image)
                                    <img src="{{ asset($staff->image) }}" alt="Staff Image" width="100">
                                    @endif
                                </div>
                                @error('image')
                                    <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description" class="label">Description</label>
                                <div class="form-group position-relative">
                                    <textarea name="description" id="description"
                                        class="form-control  text-dark">{{ $staff->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description_in_hindi" class="label">Description in Hindi</label>
                                <div class="form-group position-relative">
                                    <textarea name="description_in_hindi" id="description_in_hindi"
                                        class="form-control  text-dark">{{ $staff->description_in_hindi }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="designation">Designation :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="designation"
                                        id="designation" value="{{ $staff->designation }}">
                                    @error('designation')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="designation_in_hindi">Designation in Hindi :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58"
                                        name="designation_in_hindi" id="designation_in_hindi"
                                        value="{{ $staff->designation_in_hindi }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="section">Section :</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="section" id="section">
                                        <option value="Section 1" class="text-dark"
                                            {{ $staff->section == 'Section 1' ? 'selected' : '' }}>Select 1</option>
                                        <option value="Section 2" class="text-dark"
                                            {{ $staff->section == 'Section 2' ? 'selected' : '' }}>Select 1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="country_code">Country Code :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="country_code"
                                        id="country_code" value="{{ $staff->country_code }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="std_code">STD Code :</label>
                                <div class="form-group position-relative">
                                    <input type="number" class="form-control text-dark  h-58" name="std_code"
                                        id="std_code" value="{{ $staff->std_code }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_internal_office">Phone Internal Office :</label>
                                <div class="form-group position-relative">
                                    <input type="number" class="form-control text-dark  h-58"
                                        name="phone_internal_office" id="phone_internal_office"
                                        value="{{ $staff->phone_internal_office }}">
                                    @error('phone_internal_office')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_internal_residence">Phone Internal Residence :</label>
                                <div class="form-group position-relative">
                                    <input type="number" class="form-control text-dark  h-58"
                                        name="phone_internal_residence" id="phone_internal_residence"
                                        value="{{ $staff->phone_internal_residence }}">
                                    @error('phone_internal_residence')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_pt_office">Phone P&T Office :</label>
                                <div class="form-group position-relative">
                                    <input type="number" class="form-control text-dark  h-58" name="phone_pt_office"
                                        id="phone_pt_office" value="{{ $staff->phone_pt_office }}">
                                    @error('phone_pt_office')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_pt_residence">Phone P&T Residence :</label>
                                <div class="form-group position-relative">
                                    <input type="number" class="form-control text-dark  h-58"
                                        name="phone_pt_residence" id="phone_pt_residence"
                                        value="{{ $staff->phone_pt_residence }}">
                                    @error('phone_pt_residence')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="mobile">Mobile :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="number" class="form-control text-dark  h-58" name="mobile"
                                        id="mobile" value="{{ $staff->mobile }}">
                                    @error('mobile')
                                    <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="abbreviation">Abbreviation :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="abbreviation"
                                        id="abbreviation" value="{{ $staff->abbreviation }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="rank">Rank :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="rank" id="rank"
                                        value="{{ $staff->rank }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="present_at_station">Present at Station :</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="present_at_station"
                                        id="present_at_station">
                                        <option value="1" class="text-dark"
                                            {{ $staff->present_at_station == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" class="text-dark"
                                            {{ $staff->present_at_station == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="acm_member">ACM Member :</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="acm_member" id="acm_member"
                                        >
                                        <option value="1" class="text-dark"
                                            {{ $staff->acm_member == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" class="text-dark"
                                            {{ $staff->acm_member == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="acm_status_in_committee">ACM Status in Committee :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58"
                                        name="acm_status_in_committee" id="acm_status_in_committee"
                                        value="{{ $staff->acm_status_in_committee }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="co_opted_member">Co-Opted Member :</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="co_opted_member"
                                        id="co_opted_member" required>
                                        <option value="1" class="text-dark"
                                            {{ $staff->co_opted_member == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" class="text-dark"
                                            {{ $staff->co_opted_member == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="page_status">Page Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="page_status"
                                        id="page_status" required>
                                        <option value="1" class="text-dark"
                                            {{ $staff->page_status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark"
                                            {{ $staff->page_status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('page_status')
                                        <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update Staff
                                Member</button>
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary text-white">Back</a>
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
  $.noConflict();
jQuery(document).ready(function ($) {
    $('#product_description').summernote({
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
                $('#product_description').summernote('insertText', response.url);
      
            },
            error: function (xhr) {
                alert('Failed to upload PDF. Please try again.');
            }
        });
    }
});
$('#description_in_hindi').summernote({
    tabsize: 2,
    height: 300
});
</script>  
<!-- here this code end of the editer js -->
@endsection