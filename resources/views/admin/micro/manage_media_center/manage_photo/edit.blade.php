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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Photo Gallery</span>
        </li>
    </ul>
</div> 
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Edit Photo</h4>
                </div>

                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('micro-photo-gallery.update', $gallery->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Category Name:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" id="course-search" class="form-control text-dark  h-58"
                                        placeholder="Type to search for course..." value="{{ old('aaa', $aaa ?? '') }}">
                                    
                                    <input type="hidden" name="course_id" id="selected-course-id"
                                        value="{{ old('course_id', $gallery->course_id ?? '') }}">
                                    
                                    <div id="course-suggestions" class="dropdown-menu"
                                        style="display: none; position: relative;">
                                        @error('course_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label for="research_centre_id" class="label">Select Research Center</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="research_centre" id="select_research_centre" class="form-control text-dark  h-58">
                                        <option value="">Select Research Centre</option>
                                        @foreach ($researchCentres as $id => $name)
                                            <option value="{{ $id }}" {{ old('research_centre', $gallery->research_centre) == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('research_centre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-lg-6" id="related_news_field">
                            <div class="form-group mb-4">
                                <label for="related_news" class="label">Related News:</label>
                                <div class="form-group position-relative">
                                     
                                    <input type="text" id="news-search" class="form-control text-dark  h-58"
                                        placeholder="Type to search for courses..."
                                        value="{{ old('bbb', $bbb ?? '') }}">
                                    
                                    <input type="hidden" name="related_news" id="selected-news-id"
                                        value="{{ old('related_news', $gallery->related_news) }}">
                                     
                                    <div id="news-suggestions" class="dropdown-menu"
                                        style="display: none; position: relative;">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-6" id="related_training_field">
                            <div class="form-group mb-4">
                                <label for="related_training_program" class="label">Related Training Programme:</label>
                                <div class="form-group position-relative">
                                    
                                    <input type="text" id="training-search" class="form-control text-dark  h-58"
                                        placeholder="Type to search for training programmes..."
                                        value="{{ old('ccc', $ccc ?? '') }}">
                                    
                                    <input type="hidden" name="related_training_program" id="selected-training-id"
                                        value="{{ $gallery->related_training_program }}">
                                    <div id="training-suggestions" class="dropdown-menu"
                                        style="display: none; position: relative;"></div>
                                </div>
                            </div> 
                        </div> -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Select Category Center</label>
                                <div class="form-group position-relative">
                                <select name="media_categories" id="media_categories" class="form-control text-dark  h-58">
                                    <option value="">Select Category Centre</option>
                                    @foreach ($mediaCategories as $id => $name)
                                        <option value="{{ $id }}" {{ old('media_categories', $gallery->media_categories ?? '') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6" id="related_events_field">
                            <div class="form-group mb-4">
                                <label for="related_events" class="label">Related Events:</label>
                                <div class="form-group position-relative">
                                    <input type="text" id="event-search" class="form-control text-dark  h-58"
                                        placeholder="Type to search for events..." value="{{ old('ddd', $ddd ?? '') }}">
                                    <input type="hidden" name="related_events" id="selected-event-id"
                                        value="{{ old('related_events', $gallery->related_events ?? '') }}">
                                    <div id="event-suggestions" class="dropdown-menu"
                                        style="display: none; position: relative;"></div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Image Title (English)</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="image_title_english"
                                        value="{{ old('image_title_english', $gallery->image_title_english ?? '') }}"
                                        class="form-control text-dark  h-58">
                                    @error('image_title_english')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Image Title (Hindi)</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="image_title_hindi"
                                        value="{{ old('image_title_hindi', $gallery->image_title_hindi ?? '') }}"
                                        class="form-control text-dark  h-58">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Image Files</label>
                                <span class="star">*</span>
                                <div id="file-container">
                                    @if($gallery->image_files)
                                    @php
                                    $imageFiles = json_decode($gallery->image_files);
                                    @endphp
                                    @if(is_array($imageFiles) && count($imageFiles) > 0)
                                    @foreach($imageFiles as $file)
                                    <div class="file-group">
                                        <div class="image-preview mb-2">
                                            <!-- Display the image thumbnail -->
                                            <img src="{{ asset('storage/' . $file) }}" alt="image" width="100"
                                                height="100">
                                        </div>
                                        <!-- File input for updating image -->
                                        <input type="file" name="image_files[]"
                                            class="form-control text-dark  h-58 mb-2" accept="image/*">
                                        <button type="button"
                                            class="btn btn-primary remove-existing-file text-white mb-2"
                                            data-file="{{ $file }}">Remove</button>
                                    </div>
                                    @endforeach
                                    @else
                                    <p>No images available.</p>
                                    @endif
                                    @else
                                    <p>No images available.</p>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-success text-white" id="add-file">Add More</button>
                                <!-- Hidden input to track removed images -->
                                <input type="hidden" name="removed_files" id="removed-files" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Status</label>
                            <div class="form-group position-relative">
                                <select class="form-select form-control  h-58" name="status" id="status">
                                    <option value="1" class="text-dark" {{ $gallery->status == '1' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" class="text-dark" {{ $gallery->status == '0' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex ms-sm-3 ms-md-0 mt-4">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                        <a href="{{ route('micro-photo-gallery.index') }}"
                            class="btn btn-secondary text-white fw-semibold">Back</a>
                    </div>
            </div>

            </form>
        </div>


    </div>
</div>
</div>
</div>


<script>
// Event listener for the News dropdown
// document.getElementById('image_relate_with_news').addEventListener('change', function() {
//     // Show related News fields if 'News' is selected, hide otherwise
//     document.getElementById('related_news_field').style.display = this.value === 'News' ? 'block' : 'none';
// });

// Event listener for the Training Programme dropdown
// document.getElementById('image_relate_with_training').addEventListener('change', function() {
//     // Show related Training Programme fields if 'Training Programme' is selected, hide otherwise
//     document.getElementById('related_training_field').style.display = this.value === 'Training Programme' ?
//         'block' : 'none';
// });

// Event listener for the Events dropdown
// document.getElementById('image_relate_with_events').addEventListener('change', function() {
//     // Show related Events fields if 'Related Events' is selected, hide otherwise
//     document.getElementById('related_events_field').style.display = this.value === 'Related Events' ? 'block' :
//         'none';
// });
</script>

@endsection

<script>
// document.addEventListener("DOMContentLoaded", function() {
//     const courseSearch = document.getElementById("course-search");
//     const courseSuggestions = document.getElementById("course-suggestions");
//     const selectedCourseId = document.getElementById("selected-course-id");

//     courseSearch.addEventListener("keyup", function() {
//         const query = courseSearch.value;

//         if (query.length > 1) {
//             fetch(`/admin/search-courses?query=${query}`, {
//                     headers: {
//                         'X-Requested-With': 'XMLHttpRequest'
//                     }
//                 })
//                 .then(response => response.json())
//                 .then(data => {
//                     courseSuggestions.innerHTML = ""; // Clear previous suggestions

//                     // If we have results, show the dropdown and populate it
//                     if (data.length > 0) {
//                         courseSuggestions.style.display = "block";

//                         data.forEach(course => {
//                             const option = document.createElement("a");
//                             option.href = "#";
//                             option.classList.add("dropdown-item");
//                             option.textContent = course.name;
//                             option.dataset.id = course.id;

//                             // When a course is clicked, set the input and hide dropdown
//                             option.addEventListener("click", function(e) {
//                                 e.preventDefault();
//                                 courseSearch.value = course
//                                     .name; // Set visible input for display
//                                 selectedCourseId.value = course
//                                     .id; // Set hidden input for submission
//                                 courseSuggestions.style.display = "none";
//                             });

//                             courseSuggestions.appendChild(option);
//                         });
//                     } else {
//                         courseSuggestions.style.display = "none"; // Hide if no results
//                     }
//                 });
//         } else {
//             courseSuggestions.style.display = "none"; // Hide if query is too short
//         }
//     });

//     // Hide suggestions if clicked outside
//     document.addEventListener("click", function(e) {
//         if (!courseSuggestions.contains(e.target) && e.target !== courseSearch) {
//             courseSuggestions.style.display = "none";
//         }
//     });
// });
</script>

<script>
// document.addEventListener("DOMContentLoaded", function() {
//     const courseSearch = document.getElementById("news-search");
//     const courseSuggestions = document.getElementById("news-suggestions");
//     const selectedCourseId = document.getElementById("selected-news-id");

//     courseSearch.addEventListener("keyup", function() {
//         const query = courseSearch.value;

//         if (query.length > 1) {
//             fetch(`/admin/search-courses?query=${query}`, {
//                     headers: {
//                         'X-Requested-With': 'XMLHttpRequest'
//                     }
//                 })
//                 .then(response => response.json())
//                 .then(data => {
//                     courseSuggestions.innerHTML = ""; // Clear previous suggestions

//                     // If we have results, show the dropdown and populate it
//                     if (data.length > 0) {
//                         courseSuggestions.style.display = "block";

//                         data.forEach(course => {
//                             const option = document.createElement("a");
//                             option.href = "#";
//                             option.classList.add("dropdown-item");
//                             option.textContent = course.name;
//                             option.dataset.id = course.id;

//                             // When a course is clicked, set the input and hide dropdown
//                             option.addEventListener("click", function(e) {
//                                 e.preventDefault();
//                                 courseSearch.value = course
//                                     .name; // Set visible input for display
//                                 selectedCourseId.value = course
//                                     .id; // Set hidden input for submission
//                                 courseSuggestions.style.display = "none";
//                             });

//                             courseSuggestions.appendChild(option);
//                         });
//                     } else {
//                         courseSuggestions.style.display = "none"; // Hide if no results
//                     }
//                 });
//         } else {
//             courseSuggestions.style.display = "none"; // Hide if query is too short
//         }
//     });

//     // Hide suggestions if clicked outside
//     document.addEventListener("click", function(e) {
//         if (!courseSuggestions.contains(e.target) && e.target !== courseSearch) {
//             courseSuggestions.style.display = "none";
//         }
//     });
// });
</script>


<script>
// document.addEventListener("DOMContentLoaded", function() {
//     const courseSearch = document.getElementById("training-search");
//     const courseSuggestions = document.getElementById("training-suggestions");
//     const selectedCourseId = document.getElementById("selected-training-id");

//     courseSearch.addEventListener("keyup", function() {
//         const query = courseSearch.value;

//         if (query.length > 1) {
//             fetch(`/admin/search-courses?query=${query}`, {
//                     headers: {
//                         'X-Requested-With': 'XMLHttpRequest'
//                     }
//                 })
//                 .then(response => response.json())
//                 .then(data => {
//                     courseSuggestions.innerHTML = ""; // Clear previous suggestions

//                     // If we have results, show the dropdown and populate it
//                     if (data.length > 0) {
//                         courseSuggestions.style.display = "block";

//                         data.forEach(course => {
//                             const option = document.createElement("a");
//                             option.href = "#";
//                             option.classList.add("dropdown-item");
//                             option.textContent = course.name;
//                             option.dataset.id = course.id;

//                             // When a course is clicked, set the input and hide dropdown
//                             option.addEventListener("click", function(e) {
//                                 e.preventDefault();
//                                 courseSearch.value = course
//                                     .name; // Set visible input for display
//                                 selectedCourseId.value = course
//                                     .id; // Set hidden input for submission
//                                 courseSuggestions.style.display = "none";
//                             });

//                             courseSuggestions.appendChild(option);
//                         });
//                     } else {
//                         courseSuggestions.style.display = "none"; // Hide if no results
//                     }
//                 });
//         } else {
//             courseSuggestions.style.display = "none"; // Hide if query is too short
//         }
//     });

//     // Hide suggestions if clicked outside
//     document.addEventListener("click", function(e) {
//         if (!courseSuggestions.contains(e.target) && e.target !== courseSearch) {
//             courseSuggestions.style.display = "none";
//         }
//     });
// });
</script>

<script>
// document.addEventListener("DOMContentLoaded", function() {
//     const courseSearch = document.getElementById("event-search");
//     const courseSuggestions = document.getElementById("event-suggestions");
//     const selectedCourseId = document.getElementById("selected-event-id");

//     courseSearch.addEventListener("keyup", function() {
//         const query = courseSearch.value;

//         if (query.length > 1) {
//             fetch(`/admin/search-courses?query=${query}`, {
//                     headers: {
//                         'X-Requested-With': 'XMLHttpRequest'
//                     }
//                 })
//                 .then(response => response.json())
//                 .then(data => {
//                     courseSuggestions.innerHTML = ""; // Clear previous suggestions

//                     // If we have results, show the dropdown and populate it
//                     if (data.length > 0) {
//                         courseSuggestions.style.display = "block";

//                         data.forEach(course => {
//                             const option = document.createElement("a");
//                             option.href = "#";
//                             option.classList.add("dropdown-item");
//                             option.textContent = course.name;
//                             option.dataset.id = course.id;

//                             // When a course is clicked, set the input and hide dropdown
//                             option.addEventListener("click", function(e) {
//                                 e.preventDefault();
//                                 courseSearch.value = course
//                                     .name; // Set visible input for display
//                                 selectedCourseId.value = course
//                                     .id; // Set hidden input for submission
//                                 courseSuggestions.style.display = "none";
//                             });

//                             courseSuggestions.appendChild(option);
//                         });
//                     } else {
//                         courseSuggestions.style.display = "none"; // Hide if no results
//                     }
//                 });
//         } else {
//             courseSuggestions.style.display = "none"; // Hide if query is too short
//         }
//     });

//     // Hide suggestions if clicked outside
//     document.addEventListener("click", function(e) {
//         if (!courseSuggestions.contains(e.target) && e.target !== courseSearch) {
//             courseSuggestions.style.display = "none";
//         }
//     });
// });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const removedFilesInput = document.getElementById('removed-files'); // Hidden input for removed files
    const fileContainer = document.getElementById('file-container'); // Container for all files

    // Event listener for dynamically adding new file inputs
    document.getElementById('add-file').addEventListener('click', function() {
        const fileGroup = document.createElement('div');
        fileGroup.classList.add('file-group', 'mt-2');
        fileGroup.innerHTML = `
            <input type="file" name="image_files[]" class="form-control text-dark  h-58" accept="image/*">
            <button type="button" class="btn btn-danger remove-file mt-2 text-white">Remove</button>
        `;
        fileContainer.appendChild(fileGroup);

        // Attach remove event listener to the new "Remove" button
        fileGroup.querySelector('.remove-file').addEventListener('click', function() {
            fileGroup.remove();
        });
    });

    // Event delegation for removing existing images
    fileContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-existing-file')) {
            const fileGroup = event.target.closest('.file-group');
            const fileName = event.target.getAttribute('data-file');

            // Add the removed file to the hidden input value
            const removedFiles = removedFilesInput.value ? JSON.parse(removedFilesInput.value) : [];
            removedFiles.push(fileName);
            removedFilesInput.value = JSON.stringify(removedFiles);

            // Remove the file group from the DOM
            fileGroup.remove();
        }
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