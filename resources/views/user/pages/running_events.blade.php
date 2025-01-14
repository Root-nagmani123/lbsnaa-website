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
                            <a href="{{ route('home')}}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Running Events
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-2">
    <div class="container-fluid">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
                <h2 class="fw-semibold fs-18 mb-0">Running Events</h2>
            </div>
            <div class="row">
            @if($current_course->isNotEmpty())
            @foreach($current_course as $course)
                <div class="col-12">
                    
                    <div class="current-course-box mb-3 p-3 border rounded bg-light">
                        <h5 class="fw-bold text-dark mb-2 h4">Course Title: <span class="text-primary"><a
                                    href="{{ route('user.courseDetailslug', [$course->id]) }}"
                                    class="text-primary">{{ $course->course_name }}</a></span></h5>
                        <p style="font-weight: 600">Course Date:
                            {{ \Carbon\Carbon::parse($course->course_start_date)->format('d F, Y') }}
                            to
                            {{ \Carbon\Carbon::parse($course->course_end_date)->format('d F, Y') }}
                        </p>
                    </div>

                </div>
                @endforeach
                    @else
                    <p>No running events available.</p>
                    
                    @endif
            </div>
        </div>
    </div>
</section>

@include('user.includes.footer')