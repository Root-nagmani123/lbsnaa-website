@include('user.includes.header')

<!-- Page Content -->
<!-- slider start -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <div class="carousel-indicators">
        @foreach($sliders as $i => $slider)
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$i}}"
            class="{{ $i == 0 ? 'active' : '' }}" aria-current="{{ $i == 0 ? 'true' : 'false' }}"
            aria-label="{{ $slider->text }}"></button>
        @endforeach
    </div>

    <!-- Dynamic Slider -->
    <div class="carousel-inner">
        @foreach($sliders as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('slider-images/' . $slider->image) }}" class="d-block w-100 img-fluid"
                alt="{{ $slider->text }}" style="object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <h3 class="text-white">{{ $slider->text }}</h3>
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

    <!-- Play/Pause Button -->
    <button id="playPauseBtn1" class="btn btn-secondary mt-2" style="position: absolute; bottom: 20px; right: 20px;">
        <i class="material-icons menu-icon">pause</i>
    </button>
</div>

<!-- floating notification start -->
<section class="py-2">
    <div class="container-fluid">
        <div class="position-relative d-flex overflow-hidden pt-4 gap-3">
            <button class="btn btn-primary" id="basic-addon2" style="z-index: 1;">Latest Updates</button>
            <div class="animate-marquee d-flex gap-3"> 
            @foreach($news_scrollers as $scroller)
                @if(!empty($scroller->texttype == 3))
                    <a href="{{ $scroller->web_site_target == '2' ? (str_starts_with($scroller->website_url, 'http') ? $scroller->website_url : 'http://' . $scroller->website_url) : url($scroller->website_url) }}"
                        target="_blank" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border marquee-item text-decoration-none text-primary">
                        <div class="p-3">
                            <span class="text-gray-800">{{ $scroller->menutitle }}</span>
                        </div>
                    </a>
                @elseif(!empty($scroller->texttype == 2))
                    <a href="{{ asset($scroller->pdf_file) }}" 
                        target="_blank" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border marquee-item text-decoration-none text-primary">
                        <div class="p-3">
                            <span class="text-gray-800">{{ $scroller->menutitle }}</span>
                        </div>
                    </a>
                @else
                    <div class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border marquee-item">
                        <div class="p-3">
                            <span class="text-gray-800">{{ $scroller->menutitle }}</span>
                        </div>
                    </div>
                @endif
                @endforeach

            </div>
        </div>
    </div>
</section>
<section class="py-lg-8 py-5">
    <div class="container-fluid">
        <div class="row gy-4 gy-xl-0">
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-2">
                        <img src="{{ asset('assets/images/icons/1.jpg') }}" alt="" class="img-fluid rounded-3 w-100 "
                            style="object-fit: cover;">
                    </div>
                    <div class="card-body pt-2" style=" height: 100px;">
                        <h4 class="mb-3">Director Message</h4>
                        <a href="{{ url('menu/director-message') }}" class="icon-link icon-link-hover link-primary">
                            <span>Message</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a> <br>
                        <a href="{{ url('menu/previous-directors') }}" class="icon-link icon-link-hover link-primary">
                            <span>Previous Director</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/3.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100" style="object-fit: cover;"></a>
                    </div>
                    <div class="card-body pt-2" style="overflow-y:scroll; height: 100px;">
                        <h4 class="mb-3">Runing Courses</h4>
                        <ul>
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
                            @endforeach

                        </ul>
                    </div>
                    <div class="card-footer" style="border:none;">

                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/4.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100" style="object-fit: cover;"></a>
                    </div>
                    <div class="card-body pt-2 pb-2" style="overflow-y:scroll;height: 100px;">
                        <h4 class="mb-3">Upcoming Courses</h4>
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
                    </div>
                    <div class="card-footer" style="border:none;">

                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/2.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100" style="object-fit: cover;"></a>
                    </div>
                    <div class="card-body pt-2" style="height: 100px;">
                        <h4 class="mb-3">Training Calendar</h4>
                        <a href="{{ url('cms/training_cal') }}" class="icon-link icon-link-hover link-primary">
                            <small>Training Calendar of LBSNAA</small>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/5.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100" style="object-fit: cover;"></a>
                    </div>
                    <div class="card-body pt-2" style="height: 100px;">
                        <h4 class="mb-3">Life at Academy</h4>
                        <a href="{{ url('menu/the-academy-experience') }}"
                            class="icon-link icon-link-hover link-primary">
                            <small>The Academy Experience</small>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a><br>
                        <a href="{{ url('menu/a-day-in-the-life-of-a-trainee') }}"
                            class="icon-link icon-link-hover link-primary">
                            <small>A day in the life of a Trainee</small>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/6.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100" style="object-fit: cover;"></a>
                    </div>
                    <div class="card-body pt-2" style="height: 100px;">
                        <h4 class="mb-3">Academy Souvenir</h4>
                        <a href="{{ url('souvenir?pro_category=7')}}" class="icon-link icon-link-hover link-primary">
                            <small>Memorabilia</small>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a><br>
                        <a href="{{ url('souvenir?pro_category=6')}}" class="icon-link icon-link-hover link-primary">
                            <small>Apparel</small>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row gy-4">
            <div class="col-12 col-md-9">
                <div class="mb-3">
                    <div class="card card-hover border">
                        <div class="card-header bg-danger">
                            <h3 class="text-white">Quick Links <span class="float-end"><a
                                        href="{{ route('user.news_listing') }}" class="text-white"
                                        style="text-decoration: none;font-size:14px">View All</a></span></h3>
                        </div>
                    </div>
                </div>
                <div class="position-relative py-5">
                    <div class="tns-outer" id="tns1-ow"> 
                        <div id="tns1-mw" class="tns-ovh">
                            <div class="tns-inner" id="tns1-iw">
                                <div class="sliderTestimonialFourth tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                                    id="tns1">
                                    @foreach($news as $slider)
                                    <div class="item tns-item cars-deck">
                                        <div class="card mb-4 shadow-lg card-lift" style="height:450px; width:auto;">
                                            <div class="card-header p-0 border-0">
                                                <a href="#">
                                                    <img src="{{ isset($slider->main_image) || !empty($slider->main_image) ? asset($slider->main_image) : asset('assets/images/4.jpg') }}"
                                                        class="card-img-top" alt="blogpost"
                                                        style="object-fit: cover; height: 200px">
                                                </a>
                                            </div>
                                            <div class="card-body" style="height: 200px; overflow-y: hidden;">
                                                <a href="#" class="fs-5 mb-2 fw-semibold d-block text-success">Posted
                                                    On:
                                                    {{ \Carbon\Carbon::parse($slider->start_date)->format('d F, Y') }}</a>
                                                <h3>
                                                    <a href="{{ route('user.newsbyslug', $slider->title_slug) }}"
                                                        class="text-inherit">{{ $slider->title }}</a>
                                                </h3>
                                                <p>{{ $slider->short_description }}</p>
                                            </div>
                                            <div class="card-footer border-0" style="height:50px;">
                                                <a href="{{ route('user.newsbyslug', $slider->title_slug) }}"
                                                    class="icon-link icon-link-hover link-primary fw-semibold">
                                                    <span>Read More</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        fill="currentColor" class="bi bi-arrow-right"
                                                        viewBox="0 0 16 16">
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
                        </div>
                    </div>
                    <!-- Carousel Controls -->
                    <ul class="controls-testimonial controls justify-content-start" id="sliderTestimonialFourthControls"
                        aria-label="Carousel Navigation" style="bottom: -35px ! important;">
                        <li class="prev ms-0" aria-controls="tns1" tabindex="-1" data-controls="prev">
                            <i class="fe fe-chevron-left"></i>
                        </li>
                        <li class="next ms-2" aria-controls="tns1" tabindex="-1" data-controls="next">
                            <i class="fe fe-chevron-right"></i>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-hover border">
                    <div class="card-header bg-danger">
                        <h3 class="text-white">Quick Links</h3>
                    </div>
                    <div class="card-body p-0">
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

<script>
// JavaScript to handle marquee play/pause
const marqueeContainer = document.getElementById('marqueeContainer');
const playPauseBtn = document.getElementById('playPauseBtn');
let isPaused = false;
let animationFrame;
let currentTransform = 0; // Keep track of the current position

// Marquee function
function startMarquee() {
    const marqueeSpeed = 2; // Speed in pixels per frame

    function animate() {
        currentTransform -= marqueeSpeed;

        // Reset position when the entire content scrolls out
        if (Math.abs(currentTransform) >= marqueeContainer.scrollWidth) {
            currentTransform = marqueeContainer.offsetWidth;
        }

        marqueeContainer.style.transform = `translateX(${currentTransform}px)`;

        if (!isPaused) {
            animationFrame = requestAnimationFrame(animate);
        }
    }

    animate();
}

// Start marquee on page load
startMarquee();

// Play/Pause functionality
playPauseBtn.addEventListener('click', () => {
    if (isPaused) {
        isPaused = false;
        playPauseBtn.innerHTML = '<i class="material-icons menu-icon">pause</i>';
        startMarquee();
    } else {
        isPaused = true;
        playPauseBtn.innerHTML = '<i class="material-icons menu-icon">play_arrow</i>';
        cancelAnimationFrame(animationFrame);
    }
});
</script>
<script>
// JavaScript to control play/pause of the carousel
const carousel = new bootstrap.Carousel('#carouselExampleCaptions', {
    interval: 3000, // Time in milliseconds between slides
    ride: 'carousel'
});

const playPauseBtn = document.getElementById('playPauseBtn1');
let isPaused = false;

playPauseBtn.addEventListener('click', () => {
    if (isPaused) {
        carousel.cycle(); // Resume the carousel
        playPauseBtn.innerHTML = '<i class="material-icons menu-icon">pause</i>';
    } else {
        carousel.pause(); // Pause the carousel
        playPauseBtn.innerHTML = '<i class="material-icons menu-icon">play_arrow</i>';
    }
    isPaused = !isPaused;
});
</script>
<script>
// Tiny Slider Configuration for Two Items per Row
const slider = tns({
    container: '.sliderTestimonialFourth',
    items: 2, // Display two items at a time
    slideBy: 1,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayButtonOutput: false,
    controlsContainer: "#sliderTestimonialFourthControls",
    nav: false,
    gutter: 16, // Spacing between cards
    responsive: {
        0: {
            items: 1 // One item for small screens
        },
        768: {
            items: 2 // Two items for medium and larger screens
        }
    }
});
</script>

@include('user.includes.footer')