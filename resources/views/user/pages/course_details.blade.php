@include('user.includes.header')

@if(isset($course))
<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="col-12 mb-4 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-danger">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.navigationpagesbyslug', ['slug' => 'training']) }}"
                                class="text-danger">Training Courses</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.course_subcourse_slug', ['slug' => $parentcategory->slug]) }}"
                                class="text-danger">{{ $parentcategory->category_name }}</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('user.courseslug', ['slug' => $subcategory->slug]) }}"
                                class="text-danger">
                                {{ $subcategory->category_name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $course->course_name }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-primary shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="fw-bold mb-0 text-white">{{ $course->course_name }}</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                               <th colspan="2" class="text-primary"><b>Course Information</b></th> 
                            </tr>
                            <tr>
                                <td style="width:50%;"><b>Section:</b></td>
                                <td>{{ $course->section_name }}</td>
                            </tr>
                            <tr>
                                <td><b>Venue:</b></td>
                                <td>{{ $course->venue_title }}</td>
                            </tr>
                            <tr>
                                <td><b>Course Coordinator:</b></td>
                                <td>{{ $course->coordinator_id ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><b>Associate Course Coordinators:</b></td>
                                <td>
                                <ul>
                                    <li>{{ $course->asst_coordinator_1_id ?? 'N/A' }}</li>
                                    <li>{{ $course->asst_coordinator_2_id ?? 'N/A' }}</li>
                                    <li>{{ $course->asst_coordinator_3_id ?? 'N/A' }}</li>
                                    <li>{{ $course->asst_coordinator_4_id ?? 'N/A' }}</li>
                                    <li>{{ $course->asst_coordinator_5_id ?? 'N/A' }}</li>
                                </ul>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Duration:</b></td>
                                <td>{{ \Carbon\Carbon::parse($course->course_start_date)->format('d M, Y') }} to
                                {{ \Carbon\Carbon::parse($course->course_end_date)->format('d M, Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <h4>Archived Courses:</h4>
                @if($courses_list->isNotEmpty())
                <div class="form-group">
                    <select class="form-control ps-5 text-dark h-58" name="archive" id="archive_course"
                        onchange="navigateToArchivedCourse(this.value)">
                        <option value="">Select Archived Course</option>
                        @foreach ($courses_list as $archived)
                        <option value="{{ route('user.courseDetailslug', $archived->id) }}">
                            {{ $archived->course_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @else
                <p>No archived courses available.</p>
                @endif
            </div>
        </div>
    </div>
</section>

@else
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Course not found!</h4>
            </div>
        </div>
    </div>
</section>
@endif


@include('user.includes.footer')

<script>
function navigateToArchivedCourse(url) {
    if (url) {
        window.location.href = url; // Redirects to the selected URL
    }
}
</script>