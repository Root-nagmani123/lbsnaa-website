@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Photo Gallery</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Gallery</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Edit Photo Gallery</h4>
        </div>
                <form action="{{ isset($gallery) ? route('photo-gallery.update', $gallery->id) : route('photo-gallery.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control text-dark ps-5 h-58" id="course-search" name="course-search" required>
                                     <!-- Hidden field to store selected course ID -->
                                        <input type="hidden" name="course_id" id="selected-course-id" class="form-control text-dark ps-5 h-58">

                                        <!-- Dropdown to show course suggestions -->
                                        <div id="course-suggestions" style="display: none; position: relative;" class="form-control text-dark ps-5 h-58 dropdown-menu"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_relate_with_news">Image Relate with News :</label>
                                <span class="star">*</span>
                                <select name="image_relate_with_news" id="image_relate_with_news" class="form-control" required>
                                    <option value="">Select News</option>
                                    <option value="News">News</option>
                                </select>
                            </div>
                        </div>
                        <!-- Placeholder for News-related fields -->
                        <div class="col-lg-6" id="related_news_field" style="display: none;">
                            <div class="form-group mb-4">
                                <label class="label" for="image">Related News :</label>
                                <span class="star">*</span>
                                <input type="text" class="form-control text-dark ps-5 h-58" id="news-search" name="news-search"  placeholder="Type to search for news...">
                                <input type="hidden" name="related_news" id="selected-news-id" class="form-control text-dark ps-5 h-58">
                                <div id="news-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
                            </div>
                        </div>
                        <!-- Dropdown to select related content for Training Programme -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_relate_with_training">Image Relate with :</label>
                                <span class="star">*</span>
                                <select name="image_relate_with_training" id="image_relate_with_training" class="form-control" required>
                                    <option value="">Select Training Programme</option>
                                    <option value="Training Programme">Training Programme</option>
                                </select>
                            </div>
                        </div>
                        <!-- Placeholder for Training Programme-related fields -->
                         <div class="col-lg-6" id="related_training_field" style="display: none;">
                            <div class="form-group mb-4">
                                <label class="label" for="related_training_field">Related Training Field :</label>
                                <span class="star">*</span>
                                <input type="text" class="form-control text-dark ps-5 h-58" id="related_training_field" name="related_training_field">
                                <input type="hidden" name="related_training_program" id="related_training_program" class="form-control text-dark ps-5 h-58">
                                <div id="training-suggestions" style="display: none; position: relative;" class="form-control text-dark ps-5 h-58 dropdown-menu"></div>
                            </div>
                         </div>
                         <!-- Dropdown to select related content for Related Events -->
                         <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_relate_with_events">Image Relate with Events :</label>
                                <span class="star">*</span>
                                <select name="image_relate_with_events" id="image_relate_with_events" class="form-control" required>
                                    <option value="">Select Events</option>
                                    <option value="Related Events">Events</option>
                                </select>
                            </div>
                        </div>
                        <!-- Placeholder for Events-related fields -->
                        <div class="col-lg-6" id="related_events_field" style="display: none;">
                            <div class="form-group mb-4">
                                <label class="label" for="related_events">Related Events :</label>
                                <span class="star">*</span>
                                <input type="text" class="form-control text-dark ps-5 h-58" id="events-search" name="events-search" placeholder="Type to search for events...">
                                <input type="hidden" name="related_events" id="selected-events-id" class="form-control text-dark ps-5 h-58">
                                <div id="events-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_title_english">Image Title(English) :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" id="image_title_english" name="image_title_english" required value="{{ old('image_title_english', $gallery->image_title_english ?? '') }}">
                                </div>
                            </div>
                        </div>
<div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image_title_hindi">Image Title(Hindi) :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" id="image_title_hindi" name="image_title_hindi" required value="{{ old('image_title_hindi', $gallery->image_title_hindi ?? '') }}">
                                </div>
                            </div>
</div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Draft">Draft</option>
                                    <option value="Approval">Approval</option>
                                    <option value="Publish">Publish</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">{{ isset($gallery) ? 'Update' : 'Add' }}</button>
                            &nbsp;
                            <a href="{{ route('photo-gallery.index') }}" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>
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