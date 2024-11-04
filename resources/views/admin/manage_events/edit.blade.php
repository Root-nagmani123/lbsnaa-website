@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>Edit Event</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('manage_events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Page Language:</label>
            <div>
                <label><input type="radio" name="language" value="English" {{ old('language', $event->language) == 'English' ? 'checked' : '' }}> English</label>
                <label><input type="radio" name="language" value="Hindi" {{ old('language', $event->language) == 'Hindi' ? 'checked' : '' }}> Hindi</label>
            </div>
        </div>

        <div class="form-group">
            <label>Event Title:</label>
            <input type="text" name="event_title" class="form-control" value="{{ old('event_title', $event->event_title) }}">
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control ckeditor">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Search Course:</label>
            <div style="position: relative;">
                <input type="text" id="course-search" class="form-control" placeholder="Type to search for courses..."
                       value="{{ old('course_name', $courseName) }}"> <!-- Prepopulate saved course name -->

                <!-- Hidden field to store selected course ID -->
                <input type="hidden" name="course_id" id="selected-course-id" value="{{ old('course_id', $event->course_id) }}">

                <!-- Dropdown to show course suggestions -->
                <div id="course-suggestions" class="dropdown-menu" style="display: none; position: absolute; z-index: 1000;"></div>

                <!-- Clear Button to reset search, visible if there is a saved value -->
                <button type="button" id="clear-course-selection" class="btn btn-light"
                        style="position: absolute; right: 10px; top: 0; bottom: 0; display: {{ isset($courseName) ? 'inline' : 'none' }};">&times;</button>
            </div>
        </div>


        <div class="form-group">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $event->start_date) }}">
        </div>

        <div class="form-group">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $event->end_date) }}">
        </div>

        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="1" {{ old('status', $event->status) == '1' ? 'selected' : '' }}>Draft</option>
                <option value="2" {{ old('status', $event->status) == '2' ? 'selected' : '' }}>Approval</option>
                <option value="3" {{ old('status', $event->status) == '3' ? 'selected' : '' }}>Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('manage_events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const courseSearch = document.getElementById("course-search");
        const courseSuggestions = document.getElementById("course-suggestions");
        const selectedCourseId = document.getElementById("selected-course-id");
        const clearButton = document.getElementById("clear-course-selection");

        // Elements for displaying course details
        const courseDetails = document.getElementById("course-details");
        const courseName = document.getElementById("course-name");
        const courseDescription = document.getElementById("course-description");

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
                                clearButton.style.display = "inline"; // Show clear button after selection

                                // Fetch course details
                                fetch(`/admin/get-course-details/${course.id}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.status === 'success') {
                                            courseName.textContent = data.data.name;
                                            courseDescription.textContent = data.data.description;
                                            courseDetails.style.display = "block"; // Show course details section
                                        } else {
                                            courseDetails.style.display = "none";
                                        }
                                    })
                                    .catch(error => {
                                        console.error("Error fetching course details:", error);
                                        courseDetails.style.display = "none";
                                    });
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

        // Clear selection and reset fields
        clearButton.addEventListener("click", function() {
            courseSearch.value = "";
            selectedCourseId.value = "";
            clearButton.style.display = "none";
            courseSuggestions.style.display = "none";
            courseDetails.style.display = "none"; // Hide course details
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
        let today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="start_date"]').setAttribute('min', today);
        document.querySelector('input[name="end_date"]').setAttribute('min', today);
    });
</script>
