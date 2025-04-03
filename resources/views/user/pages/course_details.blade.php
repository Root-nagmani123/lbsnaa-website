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
                            <a href="{{ route('home') }}" class="text-danger">
                                @if($_COOKIE['language'] == '2')
                               होम
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.navigationpagesbyslug', ['slug' => 'training']) }}"
                                class="text-danger">
                                @if($_COOKIE['language'] == '2')
                                प्रशिक्षण पाठ्यक्रम
                                @else
                                Training Courses
                                @endif
                            </a>
                        </li>
                        @if($subcategory->parent_id != 0)
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.course_subcourse_slug', ['slug' => $parentcategory->slug]) }}"
                                class="text-danger">{{ $parentcategory->category_name }}</a>
                        </li>
                        @endif
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

<section class="py-2" id="skip_to_main_content">
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
                                <th colspan="2" class="text-primary"><b>
                                        @if($_COOKIE['language'] == '2')
                                        पाठ्यक्रम संबंधी जानकारी
                                        @else
                                        Course Information
                                        @endif
                                    </b></th>
                            </tr>
                            <tr>
                                <td style="width:50%;"><b>
                                        @if($_COOKIE['language'] == '2')
                                        अनुभाग:
                                        @else
                                        Section:
                                        @endif
                                    </b></td>
                                <td>{{ $course->section_name }}</td>
                            </tr>
                            <tr>
                                <td><b>
                                        @if($_COOKIE['language'] == '2')
                                        कार्यक्रम का स्थान:
                                        @else
                                        Venue:
                                        @endif
                                    </b></td>
                                <td>{{ $course->venue_title }}</td>
                            </tr>
                            <tr>
                                <td><b>
                                        @if($_COOKIE['language'] == '2')
                                        पाठ्यक्रम समन्वयक:
                                        @else
                                        Course Coordinator:
                                        @endif
                                    </b></td>
                                <td>{{ $course->coordinator_id ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><b>
                                        @if($_COOKIE['language'] == '2')
                                        एसोसिएट कोर्स समन्वयक:
                                        @else
                                        Associate Course Coordinators:
                                        @endif
                                    </b></td>
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
                                <td><b>
                                    @if($_COOKIE['language'] == '2')
                                        अवधि:
                                    @else
                                        Duration:
                                    @endif
                                </b></td>
                                <td>
                                    @php
                                        \Carbon\Carbon::setLocale($_COOKIE['language'] == '2' ? 'hi' : 'en');
                                        $startDate = \Carbon\Carbon::parse($course->course_start_date)->translatedFormat('d F, Y');
                                        $endDate = \Carbon\Carbon::parse($course->course_end_date)->translatedFormat('d F, Y');
                                    @endphp

                                    {{ $startDate }} to {{ $endDate }}
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@if($course->important_links != '')
<section class="py-2">

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <h4>Related Links</h4>
                <div class="form-group">
                {!! $course->important_links !!}

                </div>
            </div>
        </div>
    </div>
</section>
@endif
<section class="py-4">

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <h4>
                    @if($_COOKIE['language'] == '2')
                    संग्रहीत पाठ्यक्रम:
                    @else
                    Archived Courses:
                    @endif
                </h4>
                @if($courses_list->isNotEmpty())
                <div class="form-group">
                    <select class="form-control ps-5 text-dark h-58" name="archive" id="archive_course"
                        onchange="navigateToArchivedCourse(this.value)">
                        <option value="">
                            @if($_COOKIE['language'] == '2')
                            संग्रहीत पाठ्यक्रम चुनें
                            @else
                            Select Archived Course
                            @endif
                        </option>
                        @foreach ($courses_list as $archived)
                        <option value="{{ route('user.courseDetailslug', $archived->id) }}">
                            {{ $archived->course_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @else
                <p>@if($_COOKIE['language'] == '2')
                    कोई संग्रहित पाठ्यक्रम उपलब्ध नहीं है.
                    @else
                    No archived courses available.
                    @endif
                </p>
                @endif
            </div>
        </div>
    </div>
</section>

@else
<section class="py-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h4 class="text-center">
                    @if($_COOKIE['language'] == '2')
                    पाठ्यक्रम नहीं मिला!
                    @else
                    Course not found!
                    @endif
                </h4>
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