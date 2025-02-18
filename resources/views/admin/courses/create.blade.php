@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
                <i class="ri-arrow-right-double-line"></i>
                <span>Manage Course Module</span>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Course</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-sm-0">Add New Course</h4>
                </div>
                @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
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
                                @error('language')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="course_name">Course Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="course_name"
                                        id="course_name" value="{{ old('course_name') }}">
                                    @error('course_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="abbreviation">Abbreviation :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="abbreviation"
                                        id="abbreviation" value="{{ old('abbreviation') }}">
                                    @error('abbreviation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('meta_title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_keyword">Meta Keyword :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="meta_keyword"
                                        id="meta_keyword" value="{{ old('meta_keyword') }}">
                                    @error('meta_keyword')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_description">Meta Description:</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58"
                                        value="{{ old('meta_description') }}" name="meta_description"
                                        id="meta_description">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="description">Description:</label>
                                <div class="form-group position-relative">
                                    <textarea class="form-control" id="description" placeholder="Enter the Description"
                                        name="description" rows="5" value="{{ old('description') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="course_start_date">Course Start Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark  h-58" name="course_start_date"
                                        id="course_start_date" value="{{ old('course_start_date') }}">
                                    @error('course_start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="course_end_date">Course End Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark  h-58" name="course_end_date"
                                        id="course_end_date" value="{{ old('course_end_date') }}">
                                    @error('course_end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="support_section">Support Section :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="support_section"
                                        id="support_section">
                                        <option value="" class="text-dark" selected>Select Section</option>
                                        @foreach($section_category as $section)
                                        <option value="{{ $section->id }}" class="text-dark">{{ $section->name }}
                                        </option>

                                        @endforeach
                                    </select>
                                    @error('support_section')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="support_section">Support Section :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="support_section"
                                        id="support_section">
                                        <option value="" class="text-dark" selected disabled>Select Section</option>
                                        @foreach($section_category as $section)
                                        <option value="{{ $section->id }}" class="text-dark"
                                            {{ old('support_section') == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('support_section')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="organised">Organised By :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="organised"
                                        id="organised" value="{{ old('organised') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="coordinator_id">Coordinator Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" class="form-control text-dark  h-58" name="coordinator_id"
                                        id="coordinator_id"  value="{{ old('coordinator_id') }}"> -->
                                    <select class="form-select form-control  h-58" name="coordinator_id"
                                        id="coordinator_id">
                                        <option value="" class="text-dark">Select Name</option>
                                        @foreach($staff_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('coordinator_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                        @foreach($faculty_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('coordinator_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="asst_coordinator_1_id">1st Asst. Co-ordinator :</label>
                               
                                <div class="form-group position-relative">
                                    <!-- <input type="text" class="form-control text-dark  h-58"
                                        name="asst_coordinator_1_id" id="asst_coordinator_1_id"  value="{{ old('asst_coordinator_1_id') }}"> -->
                                    <select class="form-select form-control  h-58" name="asst_coordinator_1_id"
                                        id="asst_coordinator_1_id">
                                        <option value="" class="text-dark">Select Name</option>
                                        @foreach($staff_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('asst_coordinator_1_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                        @foreach($faculty_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('asst_coordinator_1_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="asst_coordinator_2_id">2nd Asst. Co-ordinator :</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" class="form-control text-dark  h-58"
                                        name="asst_coordinator_2_id" id="asst_coordinator_2_id" 
                                         value="{{ old('asst_coordinator_2_id') }}"> -->
                                    <select class="form-select form-control h-58" name="asst_coordinator_2_id"
                                        id="asst_coordinator_2_id">
                                        <option value="" class="text-dark">Select Name</option>

                                        {{-- Staff Members --}}
                                        @foreach($staff_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('asst_coordinator_2_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach

                                        {{-- Faculty Members --}}
                                        @foreach($faculty_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('asst_coordinator_2_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="asst_coordinator_3_id">3rd Asst. Co-ordinator :</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" class="form-control text-dark  h-58"
                                        name="asst_coordinator_3_id" id="asst_coordinator_3_id"
                                        value="{{ old('asst_coordinator_3_id') }}"> -->
                                    <select class="form-select form-control  h-58" name="asst_coordinator_3_id"
                                        id="asst_coordinator_3_id">
                                        <option value="" class="text-dark" selected>Select Name</option>
                                        @foreach($staff_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('asst_coordinator_3_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                        @foreach($faculty_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('asst_coordinator_3_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="asst_coordinator_4_id">4th Asst. Co-ordinator :</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" class="form-control text-dark  h-58"
                                        name="asst_coordinator_4_id" id="asst_coordinator_4_id"
                                        value="{{ old('asst_coordinator_4_id') }}"> -->
                                    <select class="form-select form-control  h-58" name="asst_coordinator_4_id"
                                        id="asst_coordinator_4_id">
                                        <option value="" class="text-dark" selected>Select Name</option>
                                        @foreach($staff_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('asst_coordinator_4_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                        @foreach($faculty_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('asst_coordinator_4_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="asst_coordinator_5_id">5th Asst. Co-ordinator :</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" class="form-control text-dark  h-58"
                                        name="asst_coordinator_5_id" id="asst_coordinator_5_id"
                                        value="{{ old('asst_coordinator_5_id') }}"> -->
                                    <select class="form-select form-control  h-58" name="asst_coordinator_5_id"
                                        id="asst_coordinator_5_id">
                                        <option value="" class="text-dark">Select Name</option>
                                        @foreach($staff_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('asst_coordinator_5_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                        @foreach($faculty_members as $member)
                                        <option value="{{ $member->name }}" class="text-dark"
                                            {{ old('asst_coordinator_5_id') == $member->name ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Important Links -->
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="label" for="important_links">Important Links:</label>
                                <div class="form-group position-relative">
                                    <textarea class="form-control  text-dark" id="important_links"
                                        name="important_links">{{ old('important_links') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Course Type -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="course_type">Course Type:</label>
                                <div class="form-group position-relative">
                                    <select name="course_type" class="form-control" id="course_type">
                                        <option value="0" {{ old('course_type') == "0" ? 'selected' : '' }}>It is Root
                                            Category</option>
                                        @foreach($tree as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('course_type', $selectedCategoryId ?? '') == $category->id ? 'selected' : '' }}>
                                            {!! $category->name_with_prefix !!}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Venue -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="venue_id">Venue:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="venue_id" id="venue_id">
                                        <option value="" class="text-dark" selected disabled>Select Venue</option>
                                        @foreach($manage_venues as $venues)
                                        <option value="{{ $venues->id }}"
                                            {{ old('venue_id') == $venues->id ? 'selected' : '' }} class="text-dark">
                                            {{ $venues->venue_title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('venue_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Funded By -->
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="label" for="funded">Funded By:</label>
                                <div class="form-group position-relative">
                                    <textarea class="form-control  text-dark" id="funded"
                                        name="funded">{{ old('funded') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Registration On -->

                        <!-- Page Status -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="page_status">Status:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="page_status" id="page_status">
                                        <option value="" class="text-dark" selected disabled>Select</option>
                                        <option value="1" {{ old('page_status') == '1' ? 'selected' : '' }}
                                            class="text-dark">Active</option>
                                        <option value="0" {{ old('page_status') == '0' ? 'selected' : '' }}
                                            class="text-dark">Inactive</option>
                                    </select>
                                    @error('page_status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>&nbsp;
                            <a href="{{ route('admin.courses.index') }}"
                                class="btn btn-secondary text-white fw-semibold">Back</a>
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