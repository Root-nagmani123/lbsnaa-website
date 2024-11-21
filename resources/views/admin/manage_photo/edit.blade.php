@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h1>Edit Photo Gallery</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('photo-gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Category Name:</label>
        <input type="text" id="course-search" class="form-control" placeholder="Type to search for course..." value="{{ old('aaa', $aaa ?? '') }}">
        <!-- Hidden input to store the course_id -->
        <input type="hidden" name="course_id" id="selected-course-id" value="{{ old('course_id', $gallery->course_id ?? '') }}">
        <!-- Dropdown for suggestions (optional, for searching courses dynamically) -->
        <div id="course-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
    </div>


    




    <div class="form-group" style="display: none;">
        <label>Image Relate With News</label>
        <select name="image_relate_with_news" id="image_relate_with_news" class="form-control">
            <option value="">Select News</option>
            <option value="News" {{ (old('image_relate_with_news', $gallery->image_relate_with_news) == 'News') ? 'selected' : '' }}>News</option>
        </select>
    </div>

    <div id="related_news_field">
        <div class="form-group">
            <label for="related_news">Related News:</label>
            <!-- Searchable input field -->
            <input type="text" id="news-search" class="form-control" placeholder="Type to search for courses..." value="{{ old('bbb', $bbb ?? '') }}">
            <!-- Store the selected course ID -->
            <input type="hidden" name="related_news" id="selected-news-id" value="{{ old('related_news', $gallery->related_news) }}">
            <!-- Dropdown for suggestions -->
            <div id="news-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
        </div>
    </div>




    <div class="form-group"  style="display: none;">
        <label>Image Relate With Training Programme</label>
        <select name="image_relate_with_training" id="image_relate_with_training" class="form-control">
            <option value="">Select Training Programme</option>
            <option value="Training Programme" {{ (old('image_relate_with_training', $gallery->image_relate_with_training) == 'Training Programme') ? 'selected' : '' }}>Training Programme</option>
        </select>
    </div>

    <div id="related_training_field">
    <div class="form-group">
        <label for="related_training_program">Related Training Programme:</label>
        <!-- Display training program name -->
        <input type="text" id="training-search" class="form-control" placeholder="Type to search for training programmes..." 
            value="{{ old('ccc', $ccc ?? '') }}" >
        <!-- Store the selected training ID -->
        <input type="hidden" name="related_training_program" id="selected-training-id" value="{{ $gallery->related_training_program }}">
        <div id="training-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
    </div>

    <div class="form-group"  style="display: none;">
        <label>Image Relate With Events</label>
        <select name="image_relate_with_events" id="image_relate_with_events" class="form-control">
            <option value="">Select Events</option>
            <option value="Related Events" {{ (old('image_relate_with_events', $gallery->image_relate_with_events) == 'Related Events') ? 'selected' : '' }}>Related Events</option>
        </select>
    </div>

    <div id="related_events_field">
        <div class="form-group">
            <label>Related Events:</label>
            <input type="text" id="event-search" class="form-control" placeholder="Type to search for events..." value="{{ old('ddd', $ddd ?? '') }}">
            <input type="hidden" name="related_events" id="selected-event-id" value="{{ old('related_events', $gallery->related_events ?? '') }}">
            <div id="event-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
        </div>
    </div>

    <div class="form-group">
        <label>Image Title (English)</label>
        <input type="text" name="image_title_english" value="{{ old('image_title_english', $gallery->image_title_english ?? '') }}" required class="form-control">
    </div>

    <div class="form-group">
        <label>Image Title (Hindi)</label>
        <input type="text" name="image_title_hindi" value="{{ old('image_title_hindi', $gallery->image_title_hindi ?? '') }}" class="form-control">
    </div>

    

    <div class="form-group">
        <label>Image Files</label>
        <div id="file-container">
            @if($gallery->image_files)  <!-- Check if image_files is not null -->
                @php
                    // Decode the JSON string into an array
                    $imageFiles = json_decode($gallery->image_files);
                @endphp

                @if(is_array($imageFiles) && count($imageFiles) > 0)
                    @foreach($imageFiles as $file)
                        <div class="file-group">
                            <!-- Display the image thumbnail -->
                            <div class="image-preview">
                                <img src="{{ asset('storage/' . $file) }}" alt="image" width="100" height="100">
                            </div>

                            <!-- File input to update image -->
                            <input type="file" name="image_files[]" class="form-control mb-2" accept="image/*">
                            <button type="button" class="btn btn-danger remove-file">Remove</button>
                        </div>
                    @endforeach
                @else
                    <p>No images available.</p>
                @endif
            @else
                <p>No images available.</p>
            @endif
        </div>
        <button type="button" class="btn btn-primary" id="add-file">Add More</button>
    </div>



    <div class="form-group">
        <label>Status</label>
        <select name="status" required class="form-control">
            <option value="1" {{ (old('status', $gallery->status) == '1') ? 'selected' : '' }}>Draft</option>
            <option value="2" {{ (old('status', $gallery->status) == '2') ? 'selected' : '' }}>Approval</option>
            <option value="3" {{ (old('status', $gallery->status) == '3') ? 'selected' : '' }}>Publish</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('photo-gallery.index') }}" class="btn btn-danger">Cancel</a>
</form>

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
                    courseSuggestions.innerHTML = "";

                    if (data.length > 0) {
                        courseSuggestions.style.display = "block";
                        
                        data.forEach(course => {
                            const option = document.createElement("a");
                            option.href = "#";
                            option.classList.add("dropdown-item");
                            option.textContent = course.name;
                            option.dataset.id = course.id;

                            option.addEventListener("click", function(e) {
                                e.preventDefault();
                                courseSearch.value = course.name;
                                selectedCourseId.value = course.id;
                                courseSuggestions.style.display = "none";
                            });

                            courseSuggestions.appendChild(option);
                        });
                    } else {
                        courseSuggestions.style.display = "none";
                    }
                });
            } else {
                courseSuggestions.style.display = "none";
            }
        });

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
        // Handle file input fields dynamically
        const addFileButton = document.getElementById("add-file");
        const fileContainer = document.getElementById("file-container");

        addFileButton.addEventListener("click", function() {
            const newFileGroup = document.createElement("div");
            newFileGroup.classList.add("file-group");
            newFileGroup.innerHTML = `
                <input type="file" name="image_files[]" class="form-control mb-2" accept="image/*">
                <button type="button" class="btn btn-danger remove-file">Remove</button>
            `;
            fileContainer.appendChild(newFileGroup);

            // Add event listener to the remove button
            newFileGroup.querySelector(".remove-file").addEventListener("click", function() {
                fileContainer.removeChild(newFileGroup);
            });
        });

        // Handle file removal
        document.querySelectorAll(".remove-file").forEach(function(button) {
            button.addEventListener("click", function() {
                fileContainer.removeChild(button.parentElement);
            });
        });
    });
</script>

@endsection
