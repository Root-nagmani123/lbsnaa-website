@include('user.pages.microsites.includes.header')

<!-- Page Content -->

<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Objectives</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Page Content -->
<section class="py-2">
    <div class="container">
    <div class="row">
    <div class="col-8">
        <!-- slider start -->
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

            <div class="carousel-indicators">

                @foreach ($sliders as $i => $slider)
                @if ($i == 0)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to={{ $i }} class="active"
                    aria-current="true" aria-label={{ $slider->slider_text }}></button>
                @endif
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $i }}"
                    aria-label={{ $slider->slider_text }}></button>
                @endforeach
            </div>

            <!-- Dynamic Slider -->
            <div class="carousel-inner">
                @foreach ($sliders as $key => $slider)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $slider->slider_image) }}" class="d-block img-fluid"
                        alt="{{ $slider->slider_text }}" style="
width: 100%;
height: 300px; background-size: content; background-position: center; border-radius: 10px;background-repeat: no-repeat;">
                    {{-- <div class="carousel-caption d-none d-md-block">
                <h3 class="text-white">{{ $slider->slider_text }}</h3>
                    <!-- <p>{{ $slider->slider_text }}</p> -->
                </div> --}}
            </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<div class="col-4">
<div class="card card-hover border">
                    <div class="card-header" style="background-color: #af2910;">
                        <h5 class="text-white">What's New</h5>
                    </div>
                    <div class="card-body">
                        <ul class="mt-2 mb-2 list-group list-group-flush">
                            @foreach($whatsNew as $news)
                            <li class="text-start list-group-item">
                                @if($news->website_url)
                                <!-- For website URL -->
                                <a href="{{ $news->website_url }}" class="text-primary" target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    {{ $news->txtename }}
                                </a>
                                @elseif($news->pdf_file)
                                <!-- For PDF URL -->
                                <a href="{{ asset('storage/' . $news->pdf_file) }}" class="text-primary"
                                    target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                            <path
                                                d="M9 1H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7l-5-6zm0 1.5V6h5L9 2.5zM4 2h5v4H4V2zM3 12V4h5v4h5v4H3z" />
                                        </svg>
                                    </span>
                                    {{ $news->txtename }}
                                </a>
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

<section class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div>
                    <h4 class="fw-bold text-primary">
                        The Ministry of Rural Development and Planning Commission assigned following objectives to B. N.
                        Yugandhar Centre for Rural Studies:
                    </h4>
                    <p class="mb-0" style="text-align: left;">Preparation and Canvassing of questionnaires on Tenancy,
                        Land Ceiling, Land Records, Land Consolidation, Government Waste Land, Homelessness, Rural
                        Development, including Poverty Alleviation Programmes and generation of empirical data on all
                        these programmes by the IAS Officer Trainees during their district training.</p>
                    <p class="mb-0 mt-2" style="text-align: left;">Preparation and Canvassing of questionnaires on
                        Tenancy, Land Ceiling, Land Records, Land Consolidation, Government Waste Land, Homelessness,
                        Rural Development, including Poverty Alleviation Programmes and generation of empirical data on
                        all these programmes by the IAS Officer Trainees during their district training.</p>
                    <p class="mb-0 mt-2" style="text-align: left;">Preparation and Canvassing of questionnaires on
                        Tenancy, Land Ceiling, Land Records, Land Consolidation, Government Waste Land, Homelessness,
                        Rural Development, including Poverty Alleviation Programmes and generation of empirical data on
                        all these programmes by the IAS Officer Trainees during their district training.</p>
                    <p class="mb-0 mt-2" style="text-align: left;">Preparation and Canvassing of questionnaires on
                        Tenancy, Land Ceiling, Land Records, Land Consolidation, Government Waste Land, Homelessness,
                        Rural Development, including Poverty Alleviation Programmes and generation of empirical data on
                        all these programmes by the IAS Officer Trainees during their district training.</p>
                </div>


                <div class="row pt15">
                    <div class="col-md-4">
                        <div class="event_box bg-red hvr-float-shadow">
                            <a href="{{ route('mediagallery') }}" target="_blank">
                                <span class=""><img src="images/gallery.png" alt="" title=""></span>
                                <h3 class="text-center">Photo Gallery</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="event_box bg-green hvr-float-shadow">
                            <a href="{{ route('calendar') }}">
                                <span class=""><img src="images/upcoming-event.png" alt="" title=""></span>
                                <h3 class="text-center">Training Calender</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="event_box bg-pink hvr-float-shadow">
                            <a href="{{ route('news') }}">
                                <span class=""><img src="images/latest.png" alt="" title=""></span>
                                <h3 class="text-center">Latest News</h3>
                            </a>
                        </div>
                    </div>
                </div>



            </div>
            <div class="col-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color: #af2910;">
                        <h5 class="text-white">Quick Links</h5>
                    </div>
                    <div class="card-body">
                        <ul class="mt-2 mb-2 list-group list-group-flush">
                            @foreach($quickLinks as $link)
                            <li class="text-start list-group-item">
                                @if($link->website_url)
                                <!-- For website URL -->
                                <a href="{{ $link->website_url }}" class="text-primary" target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    {{ $link->txtename }}
                                </a>
                                @elseif($link->pdf_file)
                                <!-- For PDF URL -->
                                <a href="{{ asset('storage/' . $link->pdf_file) }}" class="text-primary"
                                    target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                            <path
                                                d="M9 1H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7l-5-6zm0 1.5V6h5L9 2.5zM4 2h5v4H4V2zM3 12V4h5v4h5v4H3z" />
                                        </svg>
                                    </span>
                                    {{ $link->txtename }}
                                </a>
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

@include('user.pages.microsites.includes.footer')