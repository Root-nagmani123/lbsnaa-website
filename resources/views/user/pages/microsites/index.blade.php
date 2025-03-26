@include('user.pages.microsites.includes.header')
<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-9 mb-4 position-relative">
                <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel"
                    data-bs-interval="3000">
                    <div class="carousel-indicators">
                        @foreach ($sliders as $i => $slider)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $i }}"
                            class="{{ $i == 0 ? 'active' : '' }}" aria-label="{{ $slider->slider_text }}" tabindex="0">
                        </button>
                        @endforeach
                    </div>


                    <div class="carousel-inner">
                        @foreach ($sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $slider->slider_image) }}" class="d-block img-fluid"
                                alt="{{ $slider->slider_text }}"
                                style="width: 100%; height: 500px; object-fit: cover; border-radius: 10px;">
                            <div class="carousel-caption d-none d-md-block" style="bottom: 0 !important;">
                                <p class="text-white slider-caption">{{ $slider->slider_text }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Prev & Next Buttons -->
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

                    <!-- Play/Pause Button -->
                    <button id="playPauseBtn" class="btn btn-primary btn-sm" aria-label="Play/Pause button for Sliders">
                        <i class="bi bi-pause-fill"></i>
                        @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                            रोकें
                        @else
                            Pause
                        @endif
                    </button>
                </div>
            </div>


            <!-- What's New Section -->
            <div class="col-12 col-lg-3 mb-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color:#af2910">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2 class="text-white h4">
                                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        नया क्या है
                                    @else
                                        What's New
                                    @endif
                                </h2>
                                
                            </div>
                            <div class="col-lg-6 text-end">
                                <a href="{{ route('user.whatnewall', ['slug' => $slug]) }}" 
                                    style="text-decoration: none; color: #fff" 
                                    aria-label="view all for what's new">
                                    
                                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        सभी देखें
                                    @else
                                        View All
                                    @endif
                                    
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body" style="height:440px;overflow-y: scroll;">
                        <ul class="list-group list-group-flush">
                            @forelse($whatsNew as $news)
                            <li class="list-group-item">
                                @if($news->website_url)
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
                                <a href="{{ asset('storage/' . $news->pdf_file) }}" class="text-primary"
                                    target="_blank">
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
                                @endif
                            </li>
                            @empty
                            <li class="list-group-item text-primary">
                                @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                    कोई डेटा उपलब्ध नहीं है
                                @else
                                    No data available
                                @endif
                            </li>
                                                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-2" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="row">
            <!-- Research Centres -->
            <div class="col-12 col-lg-9 mb-4">
                @foreach($research_centres as $research_centre)
                <h3 class="text-center uppercase fw-bold" style="color:#af2910; font-size:24px;"><a href="#"
                        style="text-decoration: none;color:#af2910;">{{($research_centre->home_title) }}</a>
                    <br><span><img src="{{ asset('assets/images/devider.png') }}"
                            alt="{{ $research_centre->home_title }}"></span>
                </h3>
                <p style="text-align: justify;" class="mb-4">{!! $research_centre->description !!}</p>

                @endforeach

                <div class="d-flex flex-wrap gap-3">
                    @foreach ($research_centres as $research_centre)
                    <a href="{{ route('mediagallery', ['slug' => $research_centre->research_centre_slug]) }}"
                        class="card border shadow-sm text-center" style="width: 200px;">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/image (2).png') }}"
                                alt="{{ $research_centre->home_title }}" class="img-fluid">
                                <p class="mt-3">
                                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        गैलरी
                                    @else
                                        Gallery
                                    @endif
                                </p>
                                                        </div>
                    </a>
                    @endforeach

                    @foreach ($research_centres as $research_centre)
                    <a href="{{ route('news', ['slug' => $research_centre->research_centre_slug]) }}"
                        class="card border shadow-sm text-center" style="width: 200px;">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/newspaper (1).png') }}"
                                alt="{{ $research_centre->home_title }}" class="img-fluid">
                                <p class="mt-3">
                                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        ताज़ा खबर
                                    @else
                                        Latest News
                                    @endif
                                </p>
                                                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-12 col-lg-3 mb-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color:#af2910">
                        <h4 class="text-white h4">
                            @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                त्वरित लिंक
                            @else
                                Quick Links
                            @endif
                        </h4>
                                            </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: scroll;">
                        <ul class="list-group list-group-flush">
                            @forelse($quickLinks as $link)
                            <li class="list-group-item">
                                @if($link->website_url)
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
                                <a href="{{ asset('storage/' . $link->pdf_file) }}" class="text-primary"
                                    target="_blank">
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
                                @endif
                            </li>
                            @empty
                            <li class="list-group-item text-primary">
                                @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                    कोई डेटा उपलब्ध नहीं है
                                @else
                                    No data available
                                @endif
                            </li>
                                                        @endforelse
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('user.pages.microsites.includes.footer')