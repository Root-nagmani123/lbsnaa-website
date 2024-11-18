@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h1>Add/Update Photo Gallery</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ isset($gallery) ? route('photo-gallery.update', $gallery->id) : route('photo-gallery.store') }}" method="POST">
    @csrf
    @if(isset($gallery))
        @method('PUT')
    @endif
 
    <div class="form-group">
        <label>Category Name:</label>
        <input type="text" id="course-search" class="form-control" placeholder="Type to search for category...">
        <!-- Hidden field to store selected course ID -->
        <input type="hidden" name="course_id" id="selected-course-id">
        <!-- Dropdown to show course suggestions -->
        <div id="course-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
    </div>

    <!-- Dropdown to select related content for News -->
    <div class="form-group">
        <label>Image Relate With News</label>
        <select name="image_relate_with_news" id="image_relate_with_news" class="form-control">
            <option value="">Select News</option>
            <option value="News">News</option>
        </select>
    </div>

    <!-- Placeholder for News-related fields -->
    <div id="related_news_field" style="display: none;">
        <div class="form-group">
            <label>Related News:</label>
            <input type="text" id="news-search" class="form-control" placeholder="Type to search for news...">
            <input type="hidden" name="related_news" id="selected-news-id">
            <div id="news-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
        </div>
    </div>

    <!-- Dropdown to select related content for Training Programme -->
    <div class="form-group">
        <label>Image Relate With Training Programme</label>
        <select name="image_relate_with_training" id="image_relate_with_training" class="form-control">
            <option value="">Select Training Programme</option>
            <option value="Training Programme">Training Programme</option>
        </select>
    </div>

    <!-- Placeholder for Training Programme-related fields -->
    <div id="related_training_field" style="display: none;">
        <div class="form-group">
            <label>Related Training Programme:</label>
            <input type="text" id="training-search" class="form-control" placeholder="Type to search for training programmes...">
            <input type="hidden" name="related_training_program" id="selected-training-id">
            <div id="training-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
        </div>
    </div>

    <!-- Dropdown to select related content for Related Events -->
    <div class="form-group">
        <label>Image Relate With Events</label>
        <select name="image_relate_with_events" id="image_relate_with_events" class="form-control">
            <option value="">Select Events</option>
            <option value="Related Events">Related Events</option>
        </select>
    </div>

    <!-- Placeholder for Events-related fields -->
    <div id="related_events_field" style="display: none;">
        <div class="form-group">
            <label>Related Events:</label>
            <input type="text" id="event-search" class="form-control" placeholder="Type to search for events...">
            <input type="hidden" name="related_events" id="selected-event-id">
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
        <label>Status</label>
        <select name="status" required class="form-control">
            <option value="Draft">Draft</option>
            <option value="Approval">Approval</option>
            <option value="Publish">Publish</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($gallery) ? 'Update' : 'Add' }}</button>
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