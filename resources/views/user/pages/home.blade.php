@include('user.includes.header')

<!-- Page Content -->
<!-- slider start -->

<!-- Carousel Container -->

<div id="carouselExampleCaptions" class="carousel slide position-relative carousel-fade" data-bs-ride="carousel"
    data-bs-interval="3000">
    <div class="carousel-indicators ">
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
            <img src="{{ asset('slider-images/' . $slider->image) }}" class="d-block w-100"
                alt="{{ $slider->description }}">
            <div class="carousel-caption">
                <p class="text-center slider-caption">{{ $slider->text }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Carousel Navigation Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

    <!-- Play/Pause Button -->
   <button id="playPauseBtn" class="btn btn-primary btn-sm" aria-label="
    {{ $_COOKIE['language'] == '2' ? 'स्लाइडर के लिए प्ले / पॉज़ बटन' : 'Play/Pause button for Sliders' }}">
    <i class="bi bi-pause-fill"></i>
    {{ $_COOKIE['language'] == '2' ? 'रोकें' : 'Pause' }}
</button>

</div>




<!-- Play/Pause Script -->


<!-- floating notification start -->
<section class="py-3 bg-light" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="position-relative d-flex overflow-x-hidden align-items-center">
            <!-- Latest Updates Button -->
            <button class="btn btn-primary btn-sm me-2 rounded py-2" id="basic-addon2"
                style="z-index: 999;width: 200px;">
                @if($_COOKIE['language'] == '2')
                नवीनतम अपडेट
                @else
                Latest Updates
                @endif
            </button>

            <!-- Marquee Section -->
            <div id="marqueeWrapper" class="w-100 overflow-hidden position-relative">
                <div id="marqueeContainer" class="d-flex gap-3 flex-nowrap align-items-center">
                    @foreach($news_scrollers as $scroller)
                    @if(!empty($scroller->website_url))
                    <a href="{{ str_starts_with($scroller->website_url, 'http') ? $scroller->website_url : 'http://' . $scroller->website_url }}"
                        target="_blank"
                        class="d-inline-flex align-items-center justify-content-center text-center card-lift px-3 rounded border shadow-sm marquee-item">
                        <span class="text-gray-800">{{ $scroller->menutitle }}</span>
                    </a>
                    @elseif(!empty($scroller->pdf_file))
                    <a href="{{ asset($scroller->pdf_file) }}" target="_blank"
                        class="d-inline-flex align-items-center justify-content-center text-center card-lift px-3 rounded border shadow-sm marquee-item">
                        <span class="text-gray-800">{{ $scroller->menutitle }}</span>
                    </a>
                    @else
                    <a href="{{ route('user.letest_updates', $scroller->menu_slug) }}"
                        class="d-inline-flex align-items-center justify-content-center text-center card-lift px-3 rounded border shadow-sm marquee-item">
                        <span class="text-gray-800">{{ $scroller->menutitle }}</span>
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>

            <!-- Play/Pause Button -->
            <button id="playPauseBtn1" class="btn btn-primary ms-2 btn-sm"
                aria-label="Play/Pause button for Latest Updates">
                <i class="bi bi-pause-fill"></i>
            </button>
        </div>
    </div>
</section>




<section class="py-3">
    <div class="container-fluid">
        <div class="row gy-4 gy-xl-0">
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="{{ asset('assets/images/icons/1.jpg') }}" alt=""
                            class="avatar avatar-xl rounded-circle">
                    </div>
                    <div class="card-header " style="border-bottom: none;">
                        <p class="mb-3 fw-bold">
                            @if($_COOKIE['language'] == '2')
                            निदेशक संदेश
                            @else
                            Director Message
                            @endif
                        </p>
                    </div>
                    <div class="card-body pt-2" style=" height: 80px;">
                    <a href="{{ url($_COOKIE['language'] == '2' ? 'menu/director-message_hi' : 'menu/director-message') }}" 
                            class="icon-link icon-link-hover link-primary">
                                {{ $_COOKIE['language'] == '2' ? 'संदेश' : 'Message' }}
                            </a> 
                            <br>
                            <a href="{{ url($_COOKIE['language'] == '2' ? 'menu/previous-directors_hi' : 'menu/previous-directors') }}" 
                            class="icon-link icon-link-hover link-primary">
                                {{ $_COOKIE['language'] == '2' ? 'पूर्व निदेशक' : 'Previous Director' }}
                            </a>

                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="{{ asset('assets/images/icons/3.jpg') }}" alt=""
                            class="avatar avatar-xl rounded-circle">
                    </div>
                    <div class="card-header" style="border-bottom: none;">
                        <p class="fw-bold">
                            @if($_COOKIE['language'] == '2')
                            चल रहे पाठ्यक्रम
                            @else
                            Running Courses
                            @endif
                        </p>
                    </div>
                    <div class="card-body pt-2" style="overflow-y:scroll; height: 80px;">

                        @if(count($current_course) > 0)
                        <ul>
                            @php $i = 0; @endphp
                            @foreach ($current_course as $course)
                            <li>
                                <a href="{{ route('user.courseDetailslug', ['slug' => $course->id]) }}"
                                    style="color: #af2910;">
                                    {{ $course->course_name }}
                                </a><br>
                                @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        @php \Carbon\Carbon::setLocale('hi'); @endphp
                                        पाठ्यक्रम समन्वयक: {{ $course->coordinator_id }}<br>
                                        {{ \Carbon\Carbon::parse($course->course_start_date)->translatedFormat('d F, Y') }} से
                                        {{ \Carbon\Carbon::parse($course->course_end_date)->translatedFormat('d F, Y') }} तक
                                    @else
                                        Course Coordinator: {{ $course->coordinator_id }}<br>
                                        {{ \Carbon\Carbon::parse($course->course_start_date)->format('d F, Y') }} to
                                        {{ \Carbon\Carbon::parse($course->course_end_date)->format('d F, Y') }}
                                    @endif


                            </li>
                            @php $i++; @endphp
                            @endforeach

                        </ul>



                        @else
                        <span>
                            @if($_COOKIE['language'] == '2')
                            कोई पाठ्यक्रम उपलब्ध नहीं है
                            @else
                            No Course Available
                            @endif
                        </span>
                        @endif
                    </div>
                    <div class="card-footer" style="border:none;float: right;text-align: right;">
                        <button class="btn btn-primary btn-sm"> <a href="{{ route('user.runningCourses') }}"
                                style="color: white;" aria-label="View All Running Courses">
                                @if($_COOKIE['language'] == '2')
                                सभी को देखें
                                @else
                                View All
                                @endif
                            </a></button>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="{{ asset('assets/images/icons/4.jpg') }}" alt=""
                            class="avatar avatar-xl rounded-circle text-center">
                    </div>
                    <div class="card-header" style="border-bottom: none;">
                        <p class="fw-bold">
                            @if($_COOKIE['language'] == '2')
                            आगामी पाठ्यक्रम
                            @else
                            Upcoming Courses
                            @endif
                        </p>
                    </div>
                    <div class="card-body pt-2 pb-2" style="overflow-y:scroll;height: 80px;">
                        @if(count($upcoming_course) > 0)
                        <ul>

                            @foreach ($upcoming_course as $course)
                            <li>
                                <a href="{{ route('user.courseDetailslug', ['slug' => $course->id]) }}"
                                    style="color: #af2910;">
                                    {{ $course->course_name }}
                                </a><br>
                                @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                    @php \Carbon\Carbon::setLocale('hi'); @endphp
                                    पाठ्यक्रम समन्वयक: {{ $course->coordinator_id }}<br>
                                    {{ \Carbon\Carbon::parse($course->course_start_date)->translatedFormat('d F, Y') }} से
                                    {{ \Carbon\Carbon::parse($course->course_end_date)->translatedFormat('d F, Y') }} तक
                                @else
                                    Course Coordinator: {{ $course->coordinator_id }}<br>
                                    {{ \Carbon\Carbon::parse($course->course_start_date)->format('d F, Y') }} to
                                    {{ \Carbon\Carbon::parse($course->course_end_date)->format('d F, Y') }}
                                @endif
                            </li>
                            @endforeach

                        </ul>

                        @else
                        <span> @if($_COOKIE['language'] == '2')
                            कोई पाठ्यक्रम उपलब्ध नहीं है
                            @else
                            No Course Available
                            @endif</span>
                        @endif
                    </div>
                    <div class="card-footer" style="border:none;float: right;text-align: right;">
                        <button class="btn btn-primary btn-sm"><a href="{{ route('user.upcomingCourses') }}"
                                style="color: white;" aria-label="View All Upcoming Courses">@if($_COOKIE['language']
                                == '2')
                                सभी को देखें
                                @else
                                View All
                                @endif</a></button>

                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="{{ asset('assets/images/icons/2.jpg') }}" alt=""
                            class="avatar avatar-xl rounded-circle text-center">
                    </div>
                    <div class="card-header" style="border-bottom: none;">
                        <p class="fw-bold">
                            @if($_COOKIE['language'] == '2')
                            प्रशिक्षण कैलेंडर
                            @else
                            Training Calendar
                            @endif
                        </p>
                    </div>

                    <div class="card-body pt-2" style="height: 80px;">
                        <a href="{{ url('cms/training_cal') }}" class="icon-link icon-link-hover link-primary">
                            @if($_COOKIE['language'] == '2')
                            एलबीएसएनएए का प्रशिक्षण कैलेंडर
                            @else
                            Training Calendar of LBSNAA
                            @endif
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="{{ asset('assets/images/icons/5.jpg') }}" alt=""
                            class="avatar avatar-xl rounded-circle text-center" style="object-fit: cover;">
                    </div>
                    <div class="card-header" style="border-bottom: none;">
                        <p class="fw-bold">
                            {{ $_COOKIE['language'] == '2' ? 'अकादमी में जीवन' : 'Life at Academy' }}
                        </p>
                    </div>
                    <div class="card-body pt-2" style="height: 80px;">
                        <a href="{{ url($_COOKIE['language'] == '2' ? 'menu/the-academy-experience_hi' : 'menu/the-academy-experience') }}" 
                        class="icon-link icon-link-hover link-primary">
                            {{ $_COOKIE['language'] == '2' ? 'अकादमी का अनुभव' : 'The Academy Experience' }}
                        </a><br>
                        
                        <a href="{{ url($_COOKIE['language'] == '2' ? 'menu/a-day-in-the-life-of-a-trainee_hi' : 'menu/a-day-in-the-life-of-a-trainee') }}" 
                        class="icon-link icon-link-hover link-primary">
                            {{ $_COOKIE['language'] == '2' ? 'एक प्रशिक्षु के जीवन का एक दिन' : 'A day in the life of a Trainee' }}
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="{{ asset('assets/images/icons/6.jpg') }}" alt=""
                            class="avatar avatar-xl rounded-circle text-center" style="object-fit: cover;">
                    </div>
                    <div class="card-header" style="border-bottom: none;">
                        <p class="fw-bold">
                            @if($_COOKIE['language'] == '2')
                            अकादमी स्मारिका
                            @else
                            Academy Souvenir
                            @endif
                        </p>
                    </div>
                    <div class="card-body pt-2" style="height: 80px;">
                        <a href="{{ url('souvenir?pro_category=7')}}" class="icon-link icon-link-hover link-primary">
                            @if($_COOKIE['language'] == '2')
                            यादगार लम्हे
                            @else
                            Memorabilia
                            @endif
                        </a><br>
                        <a href="{{ url('souvenir?pro_category=6')}}" class="icon-link icon-link-hover link-primary">
                            @if($_COOKIE['language'] == '2')
                            परिधान
                            @else
                            Apparel
                            @endif
                        </a>
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
                        <div class="card-header" style="background-color:#af2910">
                            <h2 class="text-white h4">@if($_COOKIE['language'] == '2')
                                अकादमी समाचार
                                @else
                                LBSNAA Academy News
                                @endif <span class="float-end"><a href="{{ route('user.news_listing') }}"
                                        class="text-white" style="text-decoration: none;font-size:14px"
                                        aria-label="View All Academy News">@if($_COOKIE['language'] == '2')
                                        सभी को देखें
                                        @else
                                        View All
                                        @endif</a></span></h2>
                        </div>
                    </div>
                </div>
                <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                    <!-- Carousel Inner (carousel items) -->
                    <div class="carousel-inner">
                        @foreach ($news->chunk(3) as $chunk)
                        <!-- Group cards into chunks of 3 for each slide -->
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $slider)
                                <!-- Card -->
                                <div class="col-lg-4 col-md-6 col-12 mb-4">
                                    <div class="card">
                                        <div class="card-header p-0 border-0">
                                            <img src="{{ isset($slider->main_image) && !empty($slider->main_image) ? asset($slider->main_image) : asset('assets/images/4.jpg') }}"
                                                class="card-img-top img-fluid" alt="{{ $slider->short_description }}"
                                                aria-label="{{ $slider->short_description }}"
                                                style="object-fit: cover; height: 250px; width: 100%;">
                                        </div>
                                        <div class="card-body" style="height: 200px; overflow-y: hidden;">
                                            <span class="fs-5 mb-2 fw-semibold d-block" style="color:#007A33;">
                                                @if($_COOKIE['language'] == '2')
                                                प्रकाशित किया गया:
                                                @else
                                                Posted On:
                                                @endif

                                                {{ \Carbon\Carbon::parse($slider->start_date)->format('d F, Y') }}</span>
                                            <h3><a href="{{ route('user.newsbyslug', $slider->title_slug) }}"
                                                    class="icon-link icon-link-hover link-dark fw-semibold">{{ $slider->title }}</a>
                                            </h3>
                                            <p>{{ $slider->short_description }}</p>
                                        </div>
                                        <div class="card-footer border-0" style="height:50px;">
                                            <a href="{{ route('user.newsbyslug', $slider->title_slug) }}"
                                                class="icon-link icon-link-hover link-primary fw-semibold"
                                                aria-label="Read More {{ $slider->short_description }}">
                                                <span>
                                                    @if($_COOKIE['language'] == '2')
                                                    और पढ़ें
                                                    @else
                                                    Read More
                                                    @endif
                                                </span>
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
                </div>



            </div>
            <div class="col-12 col-md-3">
                <!-- Quick Links Section -->
                <div class="card card-hover border">
                    <div class="card-header" style="background-color:#af2910">
                        <h4 class="text-white">@if($_COOKIE['language'] == '2') त्वरित लिंक्स @else Quick Links
                            @endif</h4>
                    </div>
                    <div class="card-body p-0" style="height: 520px; overflow-y: scroll;">
                        <ul class="mt-2 mb-2 list-group list-group-flush">
                            @foreach($quick_links as $key => $quick_link)
                            <li class="text-start list-group-item">
                                @if(!empty($quick_link->url))
                                <a href="{{ $quick_link->url_type == 'external' ? (str_starts_with($quick_link->url, 'http') ? $quick_link->url : 'http://' . $quick_link->url) : url($quick_link->url) }}"
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
@include('user.includes.footer')