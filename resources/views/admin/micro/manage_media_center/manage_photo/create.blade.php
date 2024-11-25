@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Center - Micro</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
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
                                <label class="label" for="course-search">Category Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input class="form-check-input form-control ps-5 h-58" type="text"
                                        name="course-search" id="course-search"
                                        placeholder="Type to search for category...">
                                    <!-- Hidden field to store selected course ID -->
                                    <input type="hidden" name="course_id" id="selected-course-id">
                                    <!-- Dropdown to show course suggestions -->
                                    <div id="course-suggestions" class="dropdown-menu"
                                        style="display: none; position: relative;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Dropdown to select related content for News -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_relate_with_news">Image Relate With News <span
                                        class="star">*</span>:</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="image_relate_with_news"
                                        id="image_relate_with_news" required>
                                        <option value="">Select News</option>
                                        <option value="News">News</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Placeholder for News-related fields -->
                        <div class="col-lg-6" id="related_news_field" style="display: none;">
                                <div class="form-group mb-4">
                                    <label class="label" for="news-search">Related News :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="news-search"
                                            id="news-search" placeholder="Type to search for news...">
                                        <input type="hidden" name="related_news" id="selected-news-id">
                                        <div id="news-suggestions" class="dropdown-menu"
                                            style="display: none; position: relative;"></div>
                                    </div>
                                </div>
                            </div>

                        <!-- Dropdown to select related content for Training Programme -->

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_relate_with_training">Image Relate with Training
                                    :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="image_relate_with_training"
                                        id="image_relate_with_training" required>
                                        <option value="">Select Training Programme</option>
                                        <option value="Training Programme">Training Programme</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Placeholder for Training Programme-related fields -->
                        <div class="col-lg-6" id="related_training_field" style="display: none;">
                                <div class="form-group mb-4">
                                    <label class="label" for="training-search">Related Training Programme :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58"
                                            name="training-search" id="training-search"
                                            placeholder="Type to search for training programmes...">
                                        <input type="hidden" name="related_training_program" id="selected-training-id">
                                        <div id="training-suggestions" class="dropdown-menu"
                                            style="display: none; position: relative;"></div>
                                    </div>
                                </div>
                            </div>
                        <!-- Dropdown to select related content for Related Events -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_relate_with_events">Image Relate with Events :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="image_relate_with_events"
                                        id="image_relate_with_events" required>
                                        <option value="" class="text-dark">Select Events</option>
                                        <option value="Related Events" class="text-dark">Related Events</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Placeholder for Events-related fields -->
                        <div class="col-lg-6" id="related_events_field" style="display: none;">
                                <div class="form-group mb-4">
                                    <label class="label" for="event-search">Related Events :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="text" id="event-search" class="form-control text-dark ps-5 h-58" placeholder="Type to search for events...">
                                        <input type="hidden" name="related_events" id="selected-event-id">
                                        <div id="event-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_title_english">Image Title (English) :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="image_title_english" id="image_title_english"
                                        value="{{ old('image_title_english', $gallery->image_title_english ?? '') }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_title_hindi">Image Title (Hindi) :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="image_title_hindi"
                                        id="image_title_hindi"
                                        value="{{ old('image_title_hindi', $gallery->image_title_hindi ?? '') }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- for image -->

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Image Files:</label>
                                <span class="star">
                                    *
                                </span>
                                <div class="form-group position-relative">
                                    <input type="file" name="image_files[]" class="form-control text-dark ps-5 h-58"
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
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status"
                                        required>
                                        <option value="" class="text-dark">Select</option>
                                        <option value="1" class="text-dark">Active</option>
                                        <option value="0" class="text-dark">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0 mt-4">
                            <button class="btn btn-success text-white fw-semibold"
                                type="submit">Submit</button> &nbsp;
                            <a href="{{ route('photo-gallery.index') }}" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<script>
    // Event listener for the News dropdown
    document.getElementById('image_relate_with_news').addEventListener('change', function() {
        // Show related News fields if 'News' is selected, hide otherwise
        document.getElementById('related_news_field').style.display = this.value === 'News' ? 'block' : 'none';
    });

    // Event listener for the Training Programme dropdown
    document.getElementById('image_relate_with_training').addEventListener('change', function() {
        // Show related Training Programme fields if 'Training Programme' is selected, hide otherwise
        document.getElementById('related_training_field').style.display = this.value === 'Training Programme' ? 'block' : 'none';
    });

    // Event listener for the Events dropdown
    document.getElementById('image_relate_with_events').addEventListener('change', function() {
        // Show related Events fields if 'Related Events' is selected, hide otherwise
        document.getElementById('related_events_field').style.display = this.value === 'Related Events' ? 'block' : 'none';
    });



</script>

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const courseSearch = document.getElementById("course-search");
        const courseSuggestions = document.getElementById("course-suggestions");
        const selectedCourseId = document.getElementById("selected-course-id");

        courseSearch.addEventListener("keyup", function() {
            const query = courseSearch.value;

            if (query.length > 1) {
                fetch(`/admin/search-courses?query=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    courseSuggestions.innerHTML = ""; // Clear previous suggestions

                    // If we have results, show the dropdown and populate it
                    if (data.length > 0) {
                        courseSuggestions.style.display = "block";
                        
                        data.forEach(course => {
                            const option = document.createElement("a");
                            option.href = "#";
                            option.classList.add("dropdown-item");
                            option.textContent = course.name;
                            option.dataset.id = course.id;

                            // When a course is clicked, set the input and hide dropdown
                            option.addEventListener("click", function(e) {
                                e.preventDefault();
                                courseSearch.value = course.name; // Set visible input for display
                                selectedCourseId.value = course.id; // Set hidden input for submission
                                courseSuggestions.style.display = "none";
                            });

                            courseSuggestions.appendChild(option);
                        });
                    } else {
                        courseSuggestions.style.display = "none"; // Hide if no results
                    }
                });
            } else {
                courseSuggestions.style.display = "none"; // Hide if query is too short
            }
        });

        // Hide suggestions if clicked outside
        document.addEventListener("click", function(e) {
            if (!courseSuggestions.contains(e.target) && e.target !== courseSearch) {
                courseSuggestions.style.display = "none";
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const courseSearch = document.getElementById("news-search");
        const courseSuggestions = document.getElementById("news-suggestions");
        const selectedCourseId = document.getElementById("selected-news-id");

        courseSearch.addEventListener("keyup", function() {
            const query = courseSearch.value;

            if (query.length > 1) {
                fetch(`/admin/search-courses?query=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    courseSuggestions.innerHTML = ""; // Clear previous suggestions

                    // If we have results, show the dropdown and populate it
                    if (data.length > 0) {
                        courseSuggestions.style.display = "block";
                        
                        data.forEach(course => {
                            const option = document.createElement("a");
                            option.href = "#";
                            option.classList.add("dropdown-item");
                            option.textContent = course.name;
                            option.dataset.id = course.id;

                            // When a course is clicked, set the input and hide dropdown
                            option.addEventListener("click", function(e) {
                                e.preventDefault();
                                courseSearch.value = course.name; // Set visible input for display
                                selectedCourseId.value = course.id; // Set hidden input for submission
                                courseSuggestions.style.display = "none";
                            });

                            courseSuggestions.appendChild(option);
                        });
                    } else {
                        courseSuggestions.style.display = "none"; // Hide if no results
                    }
                });
            } else {
                courseSuggestions.style.display = "none"; // Hide if query is too short
            }
        });

        // Hide suggestions if clicked outside
        document.addEventListener("click", function(e) {
            if (!courseSuggestions.contains(e.target) && e.target !== courseSearch) {
                courseSuggestions.style.display = "none";
            }
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const courseSearch = document.getElementById("training-search");
        const courseSuggestions = document.getElementById("training-suggestions");
        const selectedCourseId = document.getElementById("selected-training-id");

        courseSearch.addEventListener("keyup", function() {
            const query = courseSearch.value;

            if (query.length > 1) {
                fetch(`/admin/search-courses?query=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    courseSuggestions.innerHTML = ""; // Clear previous suggestions

                    // If we have results, show the dropdown and populate it
                    if (data.length > 0) {
                        courseSuggestions.style.display = "block";
                        
                        data.forEach(course => {
                            const option = document.createElement("a");
                            option.href = "#";
                            option.classList.add("dropdown-item");
                            option.textContent = course.name;
                            option.dataset.id = course.id;

                            // When a course is clicked, set the input and hide dropdown
                            option.addEventListener("click", function(e) {
                                e.preventDefault();
                                courseSearch.value = course.name; // Set visible input for display
                                selectedCourseId.value = course.id; // Set hidden input for submission
                                courseSuggestions.style.display = "none";
                            });

                            courseSuggestions.appendChild(option);
                        });
                    } else {
                        courseSuggestions.style.display = "none"; // Hide if no results
                    }
                });
            } else {
                courseSuggestions.style.display = "none"; // Hide if query is too short
            }
        });

        // Hide suggestions if clicked outside
        document.addEventListener("click", function(e) {
            if (!courseSuggestions.contains(e.target) && e.target !== courseSearch) {
                courseSuggestions.style.display = "none";
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const courseSearch = document.getElementById("event-search");
        const courseSuggestions = document.getElementById("event-suggestions");
        const selectedCourseId = document.getElementById("selected-event-id");

        courseSearch.addEventListener("keyup", function() {
            const query = courseSearch.value;

            if (query.length > 1) {
                fetch(`/admin/search-courses?query=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    courseSuggestions.innerHTML = ""; // Clear previous suggestions

                    // If we have results, show the dropdown and populate it
                    if (data.length > 0) {
                        courseSuggestions.style.display = "block";
                        
                        data.forEach(course => {
                            const option = document.createElement("a");
                            option.href = "#";
                            option.classList.add("dropdown-item");
                            option.textContent = course.name;
                            option.dataset.id = course.id;

                            // When a course is clicked, set the input and hide dropdown
                            option.addEventListener("click", function(e) {
                                e.preventDefault();
                                courseSearch.value = course.name; // Set visible input for display
                                selectedCourseId.value = course.id; // Set hidden input for submission
                                courseSuggestions.style.display = "none";
                            });

                            courseSuggestions.appendChild(option);
                        });
                    } else {
                        courseSuggestions.style.display = "none"; // Hide if no results
                    }
                });
            } else {
                courseSuggestions.style.display = "none"; // Hide if query is too short
            }
        });

        // Hide suggestions if clicked outside
        document.addEventListener("click", function(e) {
            if (!courseSuggestions.contains(e.target) && e.target !== courseSearch) {
                courseSuggestions.style.display = "none";
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Make sure the DOM is fully loaded before running the script

        // Add event listener to "Add More" button
        document.getElementById('add-file').addEventListener('click', function() {
            // Create a new file input group
            var fileGroup = document.createElement('div');
            fileGroup.classList.add('file-group');
            fileGroup.innerHTML = `
                <input type="file" name="image_files[]" class="form-control mb-2" accept="image/*">
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