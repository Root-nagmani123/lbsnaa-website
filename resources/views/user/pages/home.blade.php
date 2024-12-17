@include('user.includes.header')

<!-- Page Content -->
<!-- slider start -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

    <div class="carousel-indicators">

        @foreach($sliders as $i => $slider)
        @if($i == 0)
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to={{$i}} class="active"
            aria-current="true" aria-label={{$slider->text}}></button>
        @endif
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$i}}"
            aria-label={{$slider->text}}></button>
        @endforeach
    </div>

    <!-- Dynamic Slider -->
    <div class="carousel-inner">
        @foreach($sliders as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('slider-images/' . $slider->image) }}" class="d-block img-fluid"
                alt="{{ $slider->text }}"
                style="
  width: 100%;
  height: 600px; background-size: cover; background-position: center; border-radius: 10px;background-repeat: no-repeat; object-fit: cover">
            <div class="carousel-caption d-none d-md-block">
                <h3 class="text-white">{{ $slider->text }}</h3>
                <!-- <p>{{ $slider->description }}</p> -->
            </div>
        </div>
        @endforeach
    </div>

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
<section class="py-2 bg-white">
    <div class="container-fluid">
        <div class="position-relative d-flex overflow-hidden pt-4 gap-3">
            <button class="btn btn-primary" id="basic-addon2" style="z-index: 1;">Latest Updates</button>
            <div class="animate-marquee d-flex gap-3">
                @foreach($news_scrollers as $scroller)
                <a href="{{ route('user.letest_updates', $scroller->menu_slug) }}"
                    class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border marquee-item">
                    <div class="p-3">
                        <span class="text-gray-800">{{$scroller->menutitle}}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="py-lg-8 py-5 bg-white">
    <div class="container">
        <div class="row gy-4 gy-xl-0">
            <div class="col-xl-3 col-md-6 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start" style="height:400px;">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/1.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100 " style="object-fit: cover; height: 200px"></a>
                    </div>
                    <div class="card-body pt-2" style=" height: 190px;">
                        <h3><a class="text-inherit" href="#!">Director Message</a></h3>
                        <a href="{{ url('menu/director-message') }}"
                            class="icon-link icon-link-hover link-primary fw-semibold">
                            <span>Message</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a> <br>
                        <a href="{{ url('menu/previous-directors') }}"
                            class="icon-link icon-link-hover link-primary fw-semibold">
                            <span>Previous Director</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class="card-footer" style="border:none;height:10px;">

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start" style="height:400px;">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/3.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100" style="object-fit: cover; height: 200px"></a>
                    </div>
                    <div class="card-body pt-2" style="overflow-y:scroll; height: 190px;">
                        <h3><a class="text-inherit" href="#!">Runing Courses</a></h3>
                        <ul>
                            @foreach ($current_course as $course)
                            <li>
                                <strong>
                                    <a href="{{ route('user.courseDetailslug', ['slug' => $course->id]) }}">
                                        {{ $course->course_name }}
                                    </a>
                                </strong><br>
                                Course Coordinator: {{ $course->coordinator_id }}<br>
                                {{ date('d F, Y', strtotime($course->course_start_date)) }} to
                                {{ date('d F, Y', strtotime($course->course_end_date)) }}
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="card-footer" style="border:none;height:10px;">

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start mb-2" style="height:400px;">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/4.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100" style="object-fit: cover; height: 200px "></a>
                    </div>
                    <div class="card-body pt-2 pb-2" style="overflow-y:scroll" style=" height: 190px;">
                        <h3><a class="text-inherit" href="#!">Upcoming Courses</a></h3>
                        <ul>
                            @foreach ($upcoming_course as $course)
                            <li>
                                <strong> <a href="{{ route('user.courseDetailslug', ['slug' => $course->id]) }}">
                                        {{ $course->course_name }}
                                    </a></strong><br>
                                Course Coordinator: {{ $course->coordinator_id }}<br>
                                {{ date('d F, Y', strtotime($course->course_start_date)) }} to
                                {{ date('d F, Y', strtotime($course->course_end_date)) }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer" style="border:none;height:10px;">

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start" style="height:400px;">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/2.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100" style="object-fit: cover; height: 200px"></a>
                    </div>
                    <div class="card-body pt-2" style="height:190px;">
                        <h3><a class="text-inherit" href="#!">Training Calendar</a></h3>
                        <a href="{{ url('cms/training_cal') }}"
                            class="icon-link icon-link-hover link-primary fw-semibold">
                            <span>Training Calendar of LBSNAA</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class="card-footer" style="border:none;height:10px;">

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start" style="height:400px;">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/5.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100" style="object-fit: cover; height: 200px"></a>
                    </div>
                    <div class="card-body pt-2" style="height:190px;">
                        <h3><a class="text-inherit" href="#!">Life at Academy</a></h3>
                        <a href="{{ url('menu/the-academy-experience') }}"
                            class="icon-link icon-link-hover link-primary fw-semibold">
                            <span>The Academy Experience</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a><br>
                        <a href="{{ url('menu/a-day-in-the-life-of-a-trainee') }}"
                            class="icon-link icon-link-hover link-primary fw-semibold">
                            <span>A day in the life of a Trainee</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class="card-footer" style="border:none;height:10px;">

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start" style="height:400px;">
                    <div class="p-2">
                        <a href="#"><img src="{{ asset('assets/images/icons/6.jpg') }}" alt=""
                                class="img-fluid rounded-3 w-100" style="object-fit: cover; height: 200px"></a>
                    </div>
                    <div class="card-body pt-2" style="height:190px;">
                        <h3><a class="text-inherit" href="#!">Academy Souvenir</a></h3>
                        <a href="{{ url('souvenir?pro_category=7')}}"
                            class="icon-link icon-link-hover link-primary fw-semibold">
                            <span>Memorabilia</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a><br>
                        <a href="{{ url('souvenir?pro_category=6')}}"
                            class="icon-link icon-link-hover link-primary fw-semibold">
                            <span>Apparel</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class="card-footer" style="border:none;height:10px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-8 bg-light">
    <div class="container">
        <div class="row gy-4 gy-xl-0">
            <div class="col-8">
                <div class="mb-5">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="fw-semibold text-primary">LBSNAA Academy News</h3>
                        </div>
                        <div class="col-6">
                            <span style="float:right;"><a href="{{ route('user.news_listing') }}"
                                    class="fw-semibold text-primary">View All</a></span>
                        </div>
                    </div>
                </div>
                <div class="position-relative">
                    <div class="tns-outer" id="tns1-ow">
                        <!-- <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">
                                slide
                                <span class="current">6 to 7</span>
                                of 5
                            </div> -->
                        <div id="tns1-mw" class="tns-ovh">
                            <div class="tns-inner" id="tns1-iw">
                                <div class="sliderTestimonialFourth tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                                    id="tns1">
                                    @foreach($news as $slider)
                                    <div class="item tns-item cars-deck">
                                        <!-- Card -->
                                        <div class="card mb-4 shadow-lg card-lift" style="height:450px;width:400px;">
                                            <div class="card-header" style="border:none;padding:0;">
                                                <a href="#">
                                                    <!-- Img  -->
                                                    <img src="{{ isset($slider->main_image) || !empty($slider->main_image) ? asset($slider->main_image) : asset('assets/images/4.jpg') }}"
                                                        class="card-img-top" alt="blogpost "
                                                        style="object-fit: cover; height: 200px">
                                                </a>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body" style="height: 200px; overflow-y:hidden;">
                                                <a href="#" class="fs-5 mb-2 fw-semibold d-block text-success">Posted On
                                                    :-
                                                    {{ \Carbon\Carbon::parse($slider->created_at)->format('d F, Y') }}</a>
                                                <h3><a href="{{ route('user.newsbyslug', $slider->title_slug) }}"
                                                        class="text-inherit">{{ $slider->title }}</a></h3>
                                                <p>{{ $slider->short_description }}</p>
                                                <!-- Media content -->
                                            </div>
                                            <div class="card-footer" style="border-top:none;height:50px">
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
                    <ul class="controls-testimonial controls justify-content-start" id="sliderTestimonialFourthControls"
                        aria-label="Carousel Navigation" tabindex="0">
                        <li class="prev ms-0" aria-controls="tns1" tabindex="-1" data-controls="prev">
                            <i class="fe fe-chevron-left"></i>
                        </li>
                        <li class="next ms-2" aria-controls="tns1" tabindex="-1" data-controls="next">
                            <i class="fe fe-chevron-right"></i>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color: #af2910;">
                        <h3 class="text-white">Quick Links</h3>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        <ul class="mt-2 mb-2 list-group list-group-flush">
                            @foreach($quick_links as $key => $quick_link)
                            <li class="text-start list-group-item">
                                @if(!empty($quick_link->url))
                                @if(!empty($quick_link->url_type) || ($quick_link->url_type == 'internal'))
                                <a href="{{ url($quick_link->url)}}" target="_blank"
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
                                @elseif(!empty($quick_link->url_type) || ($quick_link->url_type == 'external'))
                                <a href="{{ str_starts_with($quick_link->url, 'http://') || str_starts_with($quick_link->url, 'https://') ? $quick_link->url : 'http://' . $quick_link->url }}"
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
                                @else
                                <a href="{{ str_starts_with($quick_link->url, 'http://') || str_starts_with($quick_link->url, 'https://') ? $quick_link->url : 'http://' . $quick_link->url }}"
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
                                @endif
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
</section>
<style>
.animate-marquee {
    display: flex;
    animation: marquee 5s linear infinite;
    gap: 20px;
    /* Adjust gap between items */
}

.marquee-item {
    min-width: 500px;
    /* Set a minimum width for the items */
    white-space: nowrap;
}

@keyframes marquee {
    0% {
        transform: translateX(150%);
        /* Start outside the right edge */
    }

    100% {
        transform: translateX(-100%);
        /* Move past the left edge */
    }
}

.overflow-hidden {
    overflow: hidden;
    /* Ensure content stays inside the container */
}

.card-deck {
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
}
</style>
@include('user.includes.footer')