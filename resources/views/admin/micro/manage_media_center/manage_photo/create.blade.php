@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Center - Micro</h3> -->
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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Photo Gallery</span>
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
                    <h4 class="fw-semibold fs-18 mb-0">Add New Photo</h4>
                </div>
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form 
                    action="{{ isset($gallery) ? route('micro-photo-gallery.update', $gallery->id) : route('micro-photo-gallery.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($gallery))
                    @method('PUT')
                    @endif
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="select_research_centre" class="label">Select Research Centre :</label>
                                <span class="star">*</span>
                                <select name="research_centre" id="select_research_centre" class="form-control h-58 text-dark">
                                    <option value="" selected>Select Research Centre</option>
                                    @foreach ($researchCentres as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                             
                            </div>
                        </div>

                        <!-- Placeholder for Training Programme-related fields -->
                        <div class="col-lg-6" id="related_training_field" style="display: none;">
                            <div class="form-group mb-4">
                                <label class="label" for="training-search">Related Training Programme :</label>
                                <div class="form-group position-relative">
                                    <!-- Text Input -->
                                    <input type="text" class="form-control text-dark  h-58" name="training-search"
                                        id="training-search" placeholder="Type to search for training programmes..."
                                        value="{{ old('training-search') }}">
                                    <!-- Hidden Field -->
                                    <input type="hidden" name="related_training_program" id="selected-training-id"
                                        value="{{ old('related_training_program') }}">
                                    <!-- Dropdown Suggestions -->
                                    <div id="training-suggestions" class="dropdown-menu"
                                        style="display: none; position: relative;"></div>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="media_categories" class="label">Media Category:</label>
                                <span class="star">*</span>
                                <select name="media_categories" id="media_categories" class="form-control">
                                    <option value="" selected>Select Media Category</option>
                                </select>
                               
                            </div>
                        </div>









                        
                        <!-- Placeholder for Events-related fields -->

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_title_english">Image Title (English) :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58"
                                        name="image_title_english" id="image_title_english"
                                        value="{{ old('image_title_english', $gallery->image_title_english ?? '') }}">
                                 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_title_hindi">Image Title (Hindi) :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="image_title_hindi"
                                        id="image_title_hindi"
                                        value="{{ old('image_title_hindi', $gallery->image_title_hindi ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <!-- for image -->

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Image Files:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="image_files[]" class="form-control text-dark  h-58"
                                        accept="image/*">
                                  
                                    <button type="button" class="btn btn-outline-danger text-danger remove-file mt-2"
                                        style="display: none;">Remove</button>
                                </div>
                            </div>
                            <!-- Button to add more file input fields -->
                            <button type="button" class="btn btn-secondary text-white mt-2" id="add-file">Add
                                More</button>
                            <div id="file-container"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="status" id="status">
                                        <option value="" class="text-dark">Select</option>
                                        <option value="1" class="text-dark"
                                            {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark"
                                            {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0 mt-4">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button> &nbsp;
                            <a href="{{ route('micro-photo-gallery.index') }}"
                                class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Make sure the DOM is fully loaded before running the script

    // Add event listener to "Add More" button
    document.getElementById('add-file').addEventListener('click', function() {
        // Create a new file input group
        var fileGroup = document.createElement('div');
        fileGroup.classList.add('file-group');
        fileGroup.innerHTML = `
                <input type="file" name="image_files[]" class="form-control mb-2 mt-2" accept="image/*">
                <button type="button" class="btn btn-danger remove-file">Remove</button>
            `;

        // Append the new file group to the container
        document.getElementById('file-container').appendChild(fileGroup);

        // Bind the event listener for the "Remove" button in the new file group
        fileGroup.querySelector('.remove-file').addEventListener('click', function() {
            // Remove the file group when the "Remove" button is clicked
            fileGroup.remove();
        });

        // Make the "Remove" button visible for the newly added input
        fileGroup.querySelector('.remove-file').style.display = 'inline-block';
    });
});
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#select_research_centre').on('change', function () {
            const researchCentreId = $(this).val();
            // alert(researchCentreId);

            $('#media_categories').html('<option value="" selected>Select Media Category</option>');

            if (researchCentreId) {
                $.ajax({
                    url: "{{ route('fetchMediaCategories') }}",
                    type: "GET",
                    data: { research_centre_id: researchCentreId },
                    success: function (data) {
                        if (data.length > 0) {
                            data.forEach(function (category) {
                                $('#media_categories').append(
                                    `<option value="${category.id}">${category.name}</option>`
                                );
                            });
                        }
                    },
                    error: function () {
                        alert('Failed to fetch media categories. Please try again.');
                    }
                });
            }
        });
    });
</script>
