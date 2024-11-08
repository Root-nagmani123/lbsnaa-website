@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>Add Event</h2>

    <form action="{{ route('manage_events.store') }}" method="POST" id="descriptionForm">
        @csrf
 
        <div class="form-group">
            <label>Page Language:</label><br>
            <label><input type="radio" name="language" value="English" {{ old('language') == 'English' ? 'checked' : '' }}> English</label>
            <label><input type="radio" name="language" value="Hindi" {{ old('language') == 'Hindi' ? 'checked' : '' }}> Hindi</label>
            @error('language')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Event Title:</label>
            <input type="text" name="event_title" class="form-control" value="{{ old('event_title') }}">
            @error('event_title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label>Discription:</label>       
            <div id="standalone-container">
                <div id="toolbar-container">
                    <span class="ql-formats">
                        <select class="ql-font"></select>
                        <select class="ql-size"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                        <button class="ql-strike"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-blockquote"></button>
                        <button class="ql-code-block"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                        <button class="ql-indent" value="-1"></button>
                        <button class="ql-indent" value="+1"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-link"></button>
                        <button class="ql-image"></button>
                        <button class="ql-video"></button>
                    </span>
                
                    <input type="hidden" name="description" id="description">
                </div>
                <div id="editor-container" style="height: 250px;">{!! old('description') !!}</div>
            </div>
        </div>


        <div class="form-group">
            <label>Search Course:</label>
            <input type="text" id="course-search" class="form-control" placeholder="Type to search for courses...">
            
            <!-- Hidden field to store selected course ID -->
            <input type="hidden" name="course_id" id="selected-course-id">

            <!-- Dropdown to show course suggestions -->
            <div id="course-suggestions" class="dropdown-menu" style="display: none; position: relative;"></div>
        </div>


        <div class="form-group">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
            @error('start_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
            @error('end_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control">
            	<option value="">Select</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Draft</option>
                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Approval</option>
                <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Publish</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="{{ route('manage_events.index') }}" class="btn btn-danger">Cancel</a>
    </form>
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
        let today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="start_date"]').setAttribute('min', today);
        document.querySelector('input[name="end_date"]').setAttribute('min', today);
    });
</script>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Initialize Quill editor
    const quill = new Quill('#editor-container', {
        modules: {
            toolbar: '#toolbar-container'
        },
        theme: 'snow'
    });

    // Populate Quill with old value if available
    quill.root.innerHTML = "{!! old('description') !!}";

    // Form submit listener
    const form = document.querySelector("form");
    form.onsubmit = function(e) {
        // Set hidden input with Quill content
        const descriptionInput = document.querySelector('input[name=description]');
        descriptionInput.value = quill.root.innerHTML.trim();

        // Check if the description is empty and prevent submission if it is
        if (descriptionInput.value === "<p><br></p>" || descriptionInput.value === "") {
            e.preventDefault(); // Stop form from submitting
            alert("The description field is required."); // Display alert or custom message
            return false;
        }
    };
});
</script>




