@include('user.includes.header')

@if(isset($course) && isset($subcategory))
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
                            <a href="{{ route('user.navigationpagesbyslug', ['slug' => 'training']) }}"
                                style="color: #af2910;">Training Courses</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.courseslug', ['slug' => $subcategory->slug]) }}"
                                style="color: #af2910;">
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

<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="fw-bold text-primary">{{ $course->course_name }}</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <th colspan="2">Course Information</th>
                        </tr>
                        <tr>
                            <td><strong>Section</strong></td>
                            <td>{{ $course->section_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Venue</strong></td>
                            <td>{{ $course->venue_title }}</td>
                        </tr>
                        <tr>
                            <td><strong>Course Coordinator</strong></td>
                            <td>{{ $course->coordinator_id ?? '' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Associate Course Coordinators</strong></td>
                            <td>
                                {{ $course->asst_coordinator_1_id ?? '' }}<br>
                                {{ $course->asst_coordinator_2_id ?? '' }}<br>
                                {{ $course->asst_coordinator_3_id ?? '' }}<br>
                                {{ $course->asst_coordinator_4_id ?? '' }}<br>
                                {{ $course->asst_coordinator_5_id ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Duration</strong></td>
                            <td>{{ \Carbon\Carbon::parse($course->course_start_date)->format('d M, Y') }} to
                                {{ \Carbon\Carbon::parse($course->course_end_date)->format('d M, Y') }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Add any other course details you want to display -->

                <!-- If you have more data, you can display here -->
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 content-box mt-4">
                <h4>Archived Courses:</h4>
                @if($courses_list->isNotEmpty())
                    <select name="archive" id="archive_course" onchange="navigateToArchivedCourse(this.value)">
                        <option value="">Select Archived Course</option>
                        @foreach ($courses_list as $archived)
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
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Course not found!</h4>
            </div>
        </div>
    </div>
</section>
@endif

@include('user.includes.footer')