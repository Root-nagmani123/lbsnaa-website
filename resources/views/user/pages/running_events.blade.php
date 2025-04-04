@include('user.includes.header')

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">@if($_COOKIE['language'] ==
                                '2')होम
                                @else
                                Home
                                @endif</a>
                        </li>
                        <li class="breadcrumb-item active">
                            @if($_COOKIE['language'] ==
                            '2')चल रहे पाठ्यक्रम
                            @else
                            Running Events
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-2" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
                <h2 class="fw-semibold fs-18 mb-0">@if($_COOKIE['language'] ==
                    '2')चल रहे पाठ्यक्रम
                    @else
                    Running Events
                    @endif</h2>
            </div>
            <div class="row">
                @if($current_course->isNotEmpty())
                @foreach($current_course as $course)
                <div class="col-12">

                <div class="current-course-box mb-3 p-3 border rounded bg-light">
    <h5 class="fw-bold text-dark mb-2 h4">
        @if($_COOKIE['language'] == '2')
            पाठ्यक्रम शीर्षक:
        @else
            Course Title:
        @endif
        <span class="text-primary">
            <a href="{{ route('user.courseDetailslug', [$course->id]) }}" class="text-primary">
                {{ $course->course_name }}
            </a>
        </span>
    </h5>

    <p style="font-weight: 600">
        @if($_COOKIE['language'] == '2')
            पाठ्यक्रम तिथि:
        @else
            Course Date:
        @endif

        @php
            \Carbon\Carbon::setLocale($_COOKIE['language'] == '2' ? 'hi' : 'en');
            $startDate = \Carbon\Carbon::parse($course->course_start_date)->translatedFormat('d F, Y');
            $endDate = \Carbon\Carbon::parse($course->course_end_date)->translatedFormat('d F, Y');
        @endphp

        {{ $startDate }} to {{ $endDate }}
    </p>
</div>


                </div>
                @endforeach
                @else
                <p>
                    @if($_COOKIE['language'] ==
                    '2')कोई दौड़ प्रतियोगिता उपलब्ध नहीं है।
                    @else
                    No running events available.
                    @endif
                </p>

                @endif
            </div>
        </div>
    </div>
</section>

@include('user.includes.footer')