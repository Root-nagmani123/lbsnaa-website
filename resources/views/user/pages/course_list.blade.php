@include('user.includes.header')

@if(isset($subcategory))
<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">{{ $subcategory->category_name }}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="mb-6 mb-lg-8">
                    <h2 class="h1 fw-bold text-primary">
                        {{ $subcategory->category_name }}
                    </h2>
                </div>
            </div>
        </div>

        <p>{{ $subcategory->description }}</p>
    </div>

    <section class="py-4">
        <div class="container">
            <h4>Current Courses:</h4>
            @if($currentCourse)
                <div class="current-course-box mb-3 p-3 border rounded">
                    <h5>{{ $currentCourse->course_name }}</h5>
                    <p>
                        <strong>Course Date:</strong> 
                        {{ \Carbon\Carbon::parse($currentCourse->course_start_date)->format('d F, Y') }} 
                        to 
                        {{ \Carbon\Carbon::parse($currentCourse->course_end_date)->format('d F, Y') }}
                    </p>
                </div>
            @else
                <p>No current courses available for this category.</p>
            @endif
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12 content-box mt-4">
                <h4>Archived Courses:</h4>
                @if($courses->isNotEmpty())
                    <select name="archive" id="archive_course" onchange="navigateToArchivedCourse(this.value)">
                        <option value="">Select Archived Course</option>
                        @foreach ($courses as $archived)
                            <option value="{{ route('user.courseDetailslug', $archived->id) }}">
                                {{ $archived->course_name }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <p>No archived courses available.</p>
                @endif
            </div>
        </div>
    </div>
</section>

@else
    <h4>Does not exist</h4>
@endif

@include('user.includes.footer')

<script>
    function navigateToArchivedCourse(url) {
        if (url) {
            window.location.href = url; // Redirects to the selected URL
        }
    }
</script>
