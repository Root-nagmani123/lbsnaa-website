@include('user.includes.header')



<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Upcoming Courses</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
                    <h3 class="fw-semibold fs-18 mb-0">Upcoming Courses</h3>

                </div>
            </div>
            <div class="col-md-12 content-area">

                @if($current_course->isEmpty())
                <p>No upcoming courses available.</p>
                @else
                @foreach($current_course as $course)
                <p>Course Title:
                    <strong>
                        <b>
                        <a href="{{ route('user.courseDetailslug', [ $course->id]) }}">{{ $course->course_name }}</a>
                        </b>
                    </strong>
                </p>
                <p>Course Date:
                    {{ \Carbon\Carbon::parse($course->course_start_date)->format('d F, Y') }}
                    to
                    {{ \Carbon\Carbon::parse($course->course_end_date)->format('d F, Y') }}
                </p>
                <p>&nbsp;</p>
                @endforeach
                @endif
            </div>

        </div>
    </div>
</section>





@include('user.includes.footer')