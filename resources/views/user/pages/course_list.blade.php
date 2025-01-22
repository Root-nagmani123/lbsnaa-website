@include('user.includes.header')

@if(isset($subcategory))
<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-light rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">
                                @if(Cookie::get('language') == '2')
                                घर
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.navigationpagesbyslug', ['slug' => 'training']) }}"
                                class="text-danger">
                                @if(Cookie::get('language') == '2')
                                प्रशिक्षण पाठ्यक्रम
                                @else
                                Training Courses
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.course_subcourse_slug', ['slug' => $parent_category->slug]) }}"
                                class="text-danger">{{ $parent_category->category_name }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #af2910;">
                            {{ $subcategory->category_name }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>


<section class="py-1">
    <div class="container-fluid">
        <!-- Section Header -->
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <h2 class="h1 fw-bold text-primary">
                        {{ $subcategory->category_name }}
                    </h2>
                </div>
                <p class="text-muted"><?=$subcategory->description;?></p>
            </div>
        </div>
        <section class="py-4">
            <div class="container-fluid">
                <h4 class="mb-3">
                    @if(Cookie::get('language') == '2')
                    आगामी पाठ्यक्रम:
                    @else
                    Upcoming Courses:
                    @endif
                </h4>
                @if(count($upcomingCourse) >0)
                @foreach($upcomingCourse as $upcomingCourses)
                <div class="current-course-box mb-3 p-3 border rounded bg-light">
                    <h5 class="fw-bold">{{ $upcomingCourses->course_name }}</h5>
                    <p>
                        <strong>
                            @if(Cookie::get('language') == '2')
                            पाठ्यक्रम तिथि:
                            @else
                            Course Date:
                            @endif
                        </strong>
                        {{ \Carbon\Carbon::parse($upcomingCourses->course_start_date)->format('d F, Y') }}
                        to
                        {{ \Carbon\Carbon::parse($upcomingCourses->course_end_date)->format('d F, Y') }}
                    </p>
                </div>
                @endforeach
                @else
                <p class="text-muted">
                    @if(Cookie::get('language') == '2')
                    इस श्रेणी के लिए कोई आगामी पाठ्यक्रम उपलब्ध नहीं है।
                    @else
                    No Upcoming courses available for this category.
                    @endif
                </p>
                @endif
            </div>
        </section>
        <!-- Current Courses Section -->
        <section class="py-4">
            <div class="container-fluid">
                <h4 class="mb-3">
                    @if(Cookie::get('language') == '2')
                    वर्तमान पाठ्यक्रम:
                    @else
                    Current Courses:
                    @endif
                </h4>
                @if(count($currentCourse) >0)
                @foreach($currentCourse as $currentCourse)
                <div class="current-course-box mb-3 p-3 border rounded bg-light">
                    <h5 class="fw-bold">{{ $currentCourse->course_name }}</h5>
                    <p>
                        <strong>
                            @if(Cookie::get('language') == '2')
                            पाठ्यक्रम तिथि:
                            @else
                            Course Date:
                            @endif
                        </strong>
                        {{ \Carbon\Carbon::parse($currentCourse->course_start_date)->format('d F, Y') }}
                        to
                        {{ \Carbon\Carbon::parse($currentCourse->course_end_date)->format('d F, Y') }}
                    </p>
                </div>
                @endforeach
                @else
                <p class="text-muted">
                    @if(Cookie::get('language') == '2')
                    इस श्रेणी के लिए कोई वर्तमान पाठ्यक्रम उपलब्ध नहीं है।
                    @else
                    No current courses available for this category.
                    @endif
                </p>
                @endif
            </div>
        </section>

        <!-- Archived Courses Section -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-4">
                    <h4 class="mb-3">@if(Cookie::get('language') == '2')
                        संग्रहीत पाठ्यक्रम:
                        @else
                        Archived Courses:
                        @endif</h4>
                    @if($courses->isNotEmpty())
                    <div class="form-group">
                        <label for="archive_course" class="form-label">
                        @if(Cookie::get('language') == '2')
                        संग्रहीत पाठ्यक्रम का चयन करें:
                        @else
                        Select Archived Course:
                        @endif
                        </label>
                        <select name="archive" id="archive_course" class="form-select"
                            onchange="navigateToArchivedCourse(this.value)">
                            <option value="">Select Archived Course</option>
                            @foreach ($courses as $archived)
                            <option value="{{ route('user.courseDetailslug', $archived->id) }}">
                                {{ $archived->course_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <p class="text-muted">
                        @if(Cookie::get('language') == '2')
                        कोई संग्रहित पाठ्यक्रम उपलब्ध नहीं है.
                        @else
                        No archived courses available.
                        @endif
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>



@else
<h4>
    @if(Cookie::get('language') == '2')
    मौजूद नहीं
    @else
    Does not exist
    @endif
</h4>
@endif

@include('user.includes.footer')

<script>
function navigateToArchivedCourse(url) {
    if (url) {
        window.location.href = url; // Redirects to the selected URL
    }
}
</script>