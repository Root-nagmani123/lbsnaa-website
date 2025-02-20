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
                <i class="ri-arrow-right-double-line"></i>
                <span>Manage Organization Module</span>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Sections</span>
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
                    <h4 class="fw-semibold fs-18 mb-0">Create Section Category</h4>
                </div>
                <form action="{{ route('admin.section_category.update', $sectionCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio"  name="language" value="1"> English
                                    <input type="radio" name="language" value="2"> Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="name" class="label">Name</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="name" class="form-control  text-dark h-58"
                                        value="{{ old('name', $sectionCategory->name) }}" required>
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description" class="label">Description</label>
                                <div class="form-group position-relative">
                                    <textarea name="description" class="form-control  text-dark"
                                        rows="5">{{ old('description', $sectionCategory->description) }}</textarea>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="officer_incharge" class="label">Officer Incharge</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" name="officer_Incharge" class="form-control  text-dark h-58" value="{{ old('officer_Incharge', $sectionCategory->officer_Incharge) }}"> -->
                                    <select name="officer_Incharge" id="officer_Incharge" class="form-control">
                                        <option value="">Select Officer Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}" @if ($sectionCategory->officer_Incharge ==
                                            $officer->email)
                                            selected
                                            @endif>
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_Incharge_1st" class="label">Alternative Incharge 1st</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" name="alternative_Incharge_1st" class="form-control" value="{{ old('alternative_Incharge_1st', $sectionCategory->alternative_Incharge_1st) }}"> -->
                                    <select name="alternative_Incharge_1st" id="alternative_Incharge_1st"
                                        class="form-control">
                                        <option value="">Select Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}" @if ($sectionCategory->alternative_Incharge_1st ==
                                            $officer->email)
                                            selected
                                            @endif>
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_Incharge_2st" class="label">Alternative Incharge 2nd</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" name="alternative_Incharge_2st" class="form-control  text-dark h-58" value="{{ old('alternative_Incharge_2st', $sectionCategory->alternative_Incharge_2st) }}"> -->
                                    <select name="alternative_Incharge_2st" id="alternative_Incharge_2st"
                                        class="form-control">
                                        <option value="">Select Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}" @if ($sectionCategory->alternative_Incharge_2st ==
                                            $officer->email)
                                            selected
                                            @endif>
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_Incharge_3st" class="label">Alternative Incharge 3rd</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" name="alternative_Incharge_3st" class="form-control  text-dark h-58" value="{{ old('alternative_Incharge_3st', $sectionCategory->alternative_Incharge_3st) }}"> -->
                                    <select name="alternative_Incharge_3st" id="alternative_Incharge_3st"
                                        class="form-control">
                                        <option value="">Select Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}" @if ($sectionCategory->alternative_Incharge_3st ==
                                            $officer->email)
                                            selected
                                            @endif>
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_Incharge_4st" class="label">Alternative Incharge 4th</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" name="alternative_Incharge_4st" class="form-control  text-dark h-58" value="{{ old('alternative_Incharge_4st', $sectionCategory->alternative_Incharge_4st) }}"> -->
                                    <select name="alternative_Incharge_4st" id="alternative_Incharge_4st"
                                        class="form-control">
                                        <option value="">Select Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}" @if ($sectionCategory->alternative_Incharge_4st ==
                                            $officer->email)
                                            selected
                                            @endif>
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_Incharge_5st" class="label">Alternative Incharge 5th</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" name="alternative_Incharge_5st" class="form-control  text-dark h-58" value="{{ old('alternative_Incharge_5st', $sectionCategory->alternative_Incharge_5st) }}"> -->
                                    <select name="alternative_Incharge_5st" id="alternative_Incharge_5st"
                                        class="form-control">
                                        <option value="">Select Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}" @if ($sectionCategory->alternative_Incharge_5st ==
                                            $officer->email)
                                            selected
                                            @endif>
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="section_head" class="label">Section Head</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="section_head" class="form-control  text-dark h-58"
                                        value="{{ old('section_head', $sectionCategory->section_head) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_internal_office" class="label">Phone Internal Office</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="phone_internal_office"
                                        class="form-control  text-dark h-58"
                                        value="{{ old('phone_internal_office', $sectionCategory->phone_internal_office) }}">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_internal_residence" class="label">Phone Internal Residence</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="phone_internal_residence"
                                        class="form-control  text-dark h-58"
                                        value="{{ old('phone_internal_residence', $sectionCategory->phone_internal_residence) }}">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_p_t_office" class="label">Phone P&T Office</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="phone_p_t_office" class="form-control  text-dark h-58"
                                        value="{{ old('phone_p_t_office', $sectionCategory->phone_p_t_office) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_p_t_residence" class="label">Phone P&T Residence</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="phone_p_t_residence"
                                        class="form-control  text-dark h-58"
                                        value="{{ old('phone_p_t_residence', $sectionCategory->phone_p_t_residence) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="fax" class="label">Fax</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="fax" class="form-control  text-dark h-58"
                                        value="{{ old('fax', $sectionCategory->fax) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="email" class="label">Email</label>
                                <div class="form-group position-relative">
                                    <input type="email" name="email" class="form-control  text-dark h-58"
                                        value="{{ old('email', $sectionCategory->email) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="status" class="label">Status</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="status" class="form-control  text-dark h-58" required>
                                        <option value="1" {{ $sectionCategory->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $sectionCategory->status == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="section_id" class="form-control"
                            value="{{ old('fax', $sectionCategory->section_id) }}">

                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button>&nbsp;
                            <a href="{{ route('admin.section_category', ['catid' => $sectionCategory->section_id]) }}"
                                class="btn btn-secondary text-white">Back</a>
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
<!-- here this code end of the editer js -->
@endsection