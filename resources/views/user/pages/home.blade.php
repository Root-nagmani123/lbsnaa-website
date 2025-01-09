@include('user.includes.header')

<!-- Page Content -->
<!-- slider start -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-indicators">
        @foreach($sliders as $i => $slider)
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $i }}"
            class="{{ $i == 0 ? 'active' : '' }}" aria-current="{{ $i == 0 ? 'true' : 'false' }}"
            aria-label="{{ $slider->text }}"></button>
        @endforeach
    </div>

    <!-- Dynamic Slider -->
    <div class="carousel-inner">
        @foreach($sliders as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('slider-images/' . $slider->image) }}" class="d-block img-fluid" alt="{{ $slider->text }}">
            <div class="carousel-caption">
                <h3 class="text-center slider-caption">{{ $slider->text }}</h3>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<!-- floating notification start -->
<section class="py-3">
    <div class="container-fluid">
        <div>
            <div class="position-relative d-flex overflow-x-hidden align-items-center">
                <!-- Latest Updates Button -->
                <button class="btn btn-primary btn-sm me-2 rounded py-2" id="basic-addon2"
                    style="z-index: 999;width: 200px;">Latest Updates</button>
                <!-- Marquee Section -->
                <div id="marqueeWrapper" class="w-100 overflow-hidden">
                    <div id="marqueeContainer" class="d-flex gap-3 flex-nowrap align-items-center">
                        @foreach($news_scrollers as $scroller)
                        @if(!empty($scroller->website_url))
                        <a href="{{ $scroller->website_url != '' ? (str_starts_with($scroller->website_url, 'http') ? $scroller->website_url : 'http://' . $scroller->website_url) : url($scroller->website_url) }}"
                            target="_blank"
                            class="d-inline-flex align-items-center justify-content-center text-center card-lift px-3 rounded border shadow-sm"
                            style="height: 30px; white-space: nowrap; background-color: #f8f9fa;">
                            <span class="text-gray-800">{{ $scroller->menutitle }}</span>
                        </a>
                        @elseif(!empty($scroller->pdf_file))
                        <a href="{{ asset($scroller->pdf_file) }}" target="_blank"
                            class="d-inline-flex align-items-center justify-content-center text-center card-lift px-3 rounded border shadow-sm"
                            style="height: 30px; white-space: nowrap; background-color: #f8f9fa;">
                            <span class="text-gray-800">{{ $scroller->menutitle }}</span>
                        </a>
                        @else
                        <a href="{{ route('user.letest_updates', $scroller->menu_slug) }}"
                            class="d-inline-flex align-items-center justify-content-center text-center card-lift px-3 rounded border shadow-sm"
                            style="height: 30px; white-space: nowrap; background-color: #f8f9fa;">
                            <span class="text-gray-800">{{ $scroller->menutitle }}</span>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
                <!-- Play/Pause Button -->
                <button class="btn btn-secondary btn-sm me-2 rounded" id="playPauseBtn" style="z-index: 999;">
                    <i class="material-icons menu-icon">pause</i>
                </button>
            </div>

        </div>
    </div>
    </div>
</section>
<section class="py-3">
    <div class="container-fluid">
        <div class="row gy-4 gy-xl-0">
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="{{ asset('assets/images/icons/1.jpg') }}" alt="" class="avatar avatar-xl rounded-circle"
                            style="object-fit: cover;">
                    </div>
                    <div class="card-body pt-2" style=" height: 100px;">
                        <h4 class="mb-3">Director Message</h4>
                        <a href="{{ url('menu/director-message') }}" class="icon-link icon-link-hover link-primary">Message</a> <br>
                        <a href="{{ url('menu/previous-directors') }}" class="icon-link icon-link-hover link-primary">Previous Director</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <a href="#"><img src="{{ asset('assets/images/icons/3.jpg') }}" alt=""
                                class="avatar avatar-xl rounded-circle" style="object-fit: cover;"></a>
                    </div>
                    <div class="card-body pt-2" style="overflow-y:scroll; height: 100px;">
                        <h4 class="mb-3">Runing Courses</h4>
                        @if(count($current_course) > 0)
                        <ul>
                       @php $i = 0; @endphp
                            @foreach ($current_course as $course)
                            <li>
                                <a href="{{ route('user.courseDetailslug', ['slug' => $course->id]) }}"
                                    style="color: #af2910;">
                                    {{ $course->course_name }}
                                </a><br>
                                Course Coordinator: {{ $course->coordinator_id }}<br>
                                {{ date('d F, Y', strtotime($course->course_start_date)) }} to
                                {{ date('d F, Y', strtotime($course->course_end_date)) }}
                            </li>
                            @php $i++; @endphp
                            @endforeach
                           
                        </ul>
                        
                            
                        
                        @else
                            <span>No Course Available</span>
                            @endif
                    </div>
                    <div class="card-footer" style="border:none;float: right;text-align: right;">
                    <button class="btn btn-primary btn-sm"> <a href="{{ route('user.runningCourses') }}" style="color: white;">View All</a></button>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <a href="#"><img src="{{ asset('assets/images/icons/4.jpg') }}" alt=""
                                class="avatar avatar-xl rounded-circle text-center" style="object-fit: cover;"></a>
                    </div>
                    <div class="card-body pt-2 pb-2" style="overflow-y:scroll;height: 100px;">
                        <h4 class="mb-3">Upcoming Courses</h4>
                        @if(count($upcoming_course) > 0)
                        <ul>
                           
                            @foreach ($upcoming_course as $course)
                            <li>
                                <a href="{{ route('user.courseDetailslug', ['slug' => $course->id]) }}"
                                    style="color: #af2910;">
                                    {{ $course->course_name }}
                                </a><br>
                                Course Coordinator: {{ $course->coordinator_id }}<br>
                                {{ date('d F, Y', strtotime($course->course_start_date)) }} to
                                {{ date('d F, Y', strtotime($course->course_end_date)) }}
                            </li>
                            @endforeach
                           
                        </ul>
                        
                        @else
                            <span>No Course Available</span>
                            @endif
                    </div>
                    <div class="card-footer" style="border:none;float: right;text-align: right;">
                        <button class="btn btn-primary btn-sm"><a href="{{ route('user.upcomingCourses') }}" style="color: white;">View All</a></button>
                    
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <a href="#"><img src="{{ asset('assets/images/icons/2.jpg') }}" alt=""
                                class="avatar avatar-xl rounded-circle text-center" style="object-fit: cover;"></a>
                    </div>
                    <div class="card-body pt-2" style="height: 100px;">
                        <h4 class="mb-3">Training Calendar</h4>
                        <a href="{{ url('cms/training_cal') }}" class="icon-link icon-link-hover link-primary">Training Calendar of LBSNAA</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <a href="#"><img src="{{ asset('assets/images/icons/5.jpg') }}" alt=""
                                class="avatar avatar-xl rounded-circle text-center" style="object-fit: cover;"></a>
                    </div>
                    <div class="card-body pt-2" style="height: 100px;">
                        <h4 class="mb-3">Life at Academy</h4>
                        <a href="{{ url('menu/the-academy-experience') }}" class="icon-link icon-link-hover link-primary">The Academy Experience
                        </a><br>
                        <a href="{{ url('menu/a-day-in-the-life-of-a-trainee') }}" class="icon-link icon-link-hover link-primary">A day in the life of a Trainee</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <a href="#"><img src="{{ asset('assets/images/icons/6.jpg') }}" alt=""
                                class="avatar avatar-xl rounded-circle text-center" style="object-fit: cover;"></a>
                    </div>
                    <div class="card-body pt-2" style="height: 100px;">
                        <h4 class="mb-3">Academy Souvenir</h4>
                        <a href="{{ url('souvenir?pro_category=7')}}" class="icon-link icon-link-hover link-primary">Memorabilia</a><br>
                        <a href="{{ url('souvenir?pro_category=6')}}" class="icon-link icon-link-hover link-primary">Apparel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 mb-5 bg-light" id="news">
    <div class="container-fluid">
        <div class="row gy-4">
            <div class="col-12 col-md-9">
                <div class="mb-3">
                    <div class="card card-hover border">
                        <div class="card-header bg-danger">
                            <h3 class="text-white">LBSNAA Academy News <span class="float-end"><a
                                        href="{{ route('user.news_listing') }}" class="text-white"
                                        style="text-decoration: none;font-size:14px">View All</a></span></h3>
                        </div>
                    </div>
                </div>
                <div id="multiItemCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Group cards in sets of 3 -->
                        @foreach ($news->chunk(3) as $chunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $slider)
                                <div class="col-lg-4 col-12 gap-3">
                                    <div class="card">
                                        <div class="card-header p-0 border-0">
                                            <img src="{{ isset($slider->main_image) && !empty($slider->main_image) ? asset($slider->main_image) : asset('assets/images/4.jpg') }}"
                                                class="card-img-top" alt="blogpost"
                                                style="object-fit: cover; height: 250px">
                                        </div>
                                        <div class="card-body" style="height: 200px; overflow-y: hidden;">
                                            <span class="fs-5 mb-2 fw-semibold d-block text-success">Posted On:
                                                {{ \Carbon\Carbon::parse($slider->start_date)->format('d F, Y') }}</span>
                                            <h3>{{ $slider->title }}</h3>
                                            <p>{{ $slider->short_description }}</p>
                                        </div>
                                        <div class="card-footer border-0" style="height:50px;">
                                            <a href="{{ route('user.newsbyslug', $slider->title_slug) }}"
                                                class="icon-link icon-link-hover link-primary fw-semibold">
                                                <span>Read More</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#multiItemCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#multiItemCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <!-- Quick Links Section -->
                <div class="card card-hover border">
                    <div class="card-header bg-danger">
                        <h3 class="text-white">Quick Links</h3>
                    </div>
                    <div class="card-body p-0" style="height: 520px; overflow-y: scroll;">
                        <ul class="mt-2 mb-2 list-group list-group-flush">
                            @foreach($quick_links as $key => $quick_link)
                            <li class="text-start list-group-item">
                                @if(!empty($quick_link->url))
                                <a href="{{ $quick_link->url_type == 'external' ? (str_starts_with($quick_link->url, 'http') ? $quick_link->url : 'http://' . $quick_link->url) : url($quick_link->url) }}"
                                    target="_blank" class="text-decoration-none text-primary">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    {{ $quick_link->text }}
                                </a>
                                @elseif(!empty($quick_link->file))
                                <a href="{{ asset('quick-links-files/'.$quick_link->file) }}" target="_blank"
                                    class="text-decoration-none text-primary">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    {{ $quick_link->text }}
                                </a>
                                @else
                                {{ $quick_link->text }}
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
#marqueeWrapper {
    position: relative;
    overflow: hidden;
    white-space: nowrap;
}

#marqueeContainer {
    display: inline-flex;
    white-space: nowrap;
    will-change: transform;
}
</style>

@include('user.includes.footer')