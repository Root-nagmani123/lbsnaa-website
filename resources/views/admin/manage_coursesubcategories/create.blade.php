@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Course Category/Sub Category</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Course Category/Sub Category</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add Course Category/Sub Category</h4>
                </div>

                <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"> English
                                    <input type="radio" name="language" value="2"> Hindi
                                </div>
                                @error('language')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="category_name">Category Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="category_name"
                                        id="category_name">
                                        @error('category_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group position-relative mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- Color Picker Input -->
                                        <label for="color_theme" class="label">Choose Color:</label>
                                        <input type="color" class="form-control text-dark  h-58" name="color_theme"
                                            id="color_theme">
                                            @error('color_theme')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="col-6">
                                        <!-- Hex Code Display -->
                                        <p id="selected-color" class="label">
                                            Selected Color:
                                            <input type="text" class="text-muted form-control mt-2" id="color_hex"
                                                name="color_theme">
                                                @error('color_theme')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                        </p>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="parent_id">Parent Category :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="parent_id" id="parent_id">
                                        <option value="" selected>It is Root Category</option>
                                        {!! buildCategoryOptions($subcategories) !!}
                                    </select>
                                    @error('parent_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="description">Description :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                        <textarea name="description" id="description" rows="3" class="form-control text-dark"></textarea>
                                        @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Product Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="status" id="status">
                                        <option value="" class="text-dark" selected>Select</option>
                                        <option value="1" class="text-dark">Active</option>
                                        <option value="0" class="text-dark">Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button> &nbsp;
                            <a href="{{ route('subcategory.index') }}" class="btn btn-secondary text-white">Back</a>
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
<script>
// Get the color input and hex input elements
const colorInput = document.getElementById('color_theme');
const hexInput = document.getElementById('color_hex');

// Update hex input when color input changes
colorInput.addEventListener('input', function() {
    hexInput.value = colorInput.value; // Set the hex input value to the color picker's value
});

// Update color picker when hex input changes
hexInput.addEventListener('input', function() {
    // Check if the hex input value is valid before updating the color input
    if (/^#([0-9A-F]{3}){1,2}$/i.test(hexInput.value)) {
        colorInput.value = hexInput.value; // Update the color picker's value
    }
});

// Initialize hex input on page load
window.onload = function() {
    hexInput.value = colorInput.value; // Set initial value
};
</script>


<script>
document.getElementById('color_theme').addEventListener('input', function() {
    var color = this.value;
    document.getElementById('color_preview').style.backgroundColor = color;
});
</script>

<script>
// Initialize Pickr
const pickr = Pickr.create({
    el: '#color-picker',
    theme: 'classic', // or 'monolith', or 'nano'

    swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
    ],

    components: {
        // Main components
        preview: true,
        opacity: true,
        hue: true,

        // Input / output Options
        interaction: {
            hex: true,
            rgba: true,
            hsla: true,
            hsva: true,
            cmyk: true,
            input: true,
            clear: true,
            save: true
        }
    }
});

// Event listener to update the selected color
pickr.on('save', (color) => {
    const colorHex = color.toHEXA().toString();
    // document.getElementById('selected-color').innerHTML = `Selected Color: <span class="text-muted">${colorHex}</span>`;
    document.getElementById('selected-color').innerHTML =
        `Selected Color: <input type="text" class="text-muted" name="color_theme" value="${colorHex}">`;
    pickr.hide(); // Hide the picker after selecting the color
});
</script>

    @php
        function buildCategoryOptions($categories, $parentId = 0, $prefix = '')
        {
            $html = '';
            foreach ($categories as $category) {
                if ($category->parent_id == $parentId) {
                    $html .=
                        '<option value="' . $category->id . '">' . $prefix . $category->category_name . '</option>';
                    $html .= buildCategoryOptions($categories, $category->id, $prefix . '-');
                }
            }
            return $html;
        }
    @endphp

@endsection
