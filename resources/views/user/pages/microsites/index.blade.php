@include('user.pages.microsites.includes.header')

<!-- Page Content -->



<section class="py-4">
    <div class="container-fluid">
        <div class="row">
            <!-- Slider Section -->
            <div class="col-12 col-lg-9 mb-4">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel"
                    data-bs-interval="3000">
                    <div class="carousel-inner">
                        @foreach ($sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $slider->slider_image) }}" class="d-block img-fluid"
                                alt="{{ $slider->slider_text }}"
                                style="width: 100%; height: 400px; object-fit: cover; border-radius: 10px;">
                            <div class="carousel-caption d-none d-md-block" style="bottom: 0 !important;">
                                <h3 class="text-white slider-caption">{{ $slider->slider_text }}</h3>
                            </div>
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


            <!-- What's New Section -->
            <div class="col-12 col-lg-3 mb-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color:#af2910">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-white">What's New</h5>

                            </div>
                            <div class="col-lg-6 text-end">
                                <a href="{{ route('user.whatnewall', ['slug' => $slug]) }}"
                                    style="text-decoration: none;color: #fff">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="height:340px;overflow-y: scroll;">
                    <ul class="list-group list-group-flush">
                        @forelse($whatsNew as $news)
                            <li class="list-group-item">
                                @if($news->website_url)
                                    <a href="{{ $news->website_url }}" class="text-primary" target="_blank">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                                            </svg>
                                        </span>
                                        {{ $news->txtename }}
                                    </a>
                                @elseif($news->pdf_file)
                                    <a href="{{ asset('storage/' . $news->pdf_file) }}" class="text-primary" target="_blank">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                                            </svg>
                                        </span>
                                        {{ $news->txtename }}
                                    </a>
                                @endif
                            </li>
                        @empty
                            <li class="list-group-item text-danger">No data available</li>
                        @endforelse
                    </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Research Centres -->
            <div class="col-12 col-lg-9 mb-4">
                @foreach($research_centres as $research_centre)
                <h2 class="text-center uppercase" style="color:#af2910">{{($research_centre->home_title) }} <br><span><img
                            src="{{ asset('assets/images/devider.png') }}" alt=""></span></h2>
                <p style="text-align: justify;" class="mb-4">{!! $research_centre->description !!}</p>

                @endforeach

                <div class="d-flex flex-wrap gap-3">
                    @foreach ($research_centres as $research_centre)
                    <a href="{{ route('mediagallery', ['slug' => $research_centre->research_centre_slug]) }}"
                        class="card border shadow-sm text-center" style="width: 200px;">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/image (2).png') }}" alt="Gallery" class="img-fluid">
                            <h6 class="mt-3">Gallery</h6>
                        </div>
                    </a>
                    @endforeach

                    @foreach ($research_centres as $research_centre)
                    <a href="{{ route('news', ['slug' => $research_centre->research_centre_slug]) }}"
                        class="card border shadow-sm text-center" style="width: 200px;">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/newspaper (1).png') }}" alt="News" class="img-fluid">
                            <h6 class="mt-3">Latest News</h6>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-12 col-lg-3 mb-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color:#af2910">
                        <h5 class="text-white">Quick Links</h5>
                    </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: scroll;">
                    <ul class="list-group list-group-flush">
                        @forelse($quickLinks as $link)
                            <li class="list-group-item">
                                @if($link->website_url)
                                    <a href="{{ $link->website_url }}" class="text-primary" target="_blank">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                                            </svg>
                                        </span>
                                        {{ $link->txtename }}
                                    </a>
                                @elseif($link->pdf_file)
                                    <a href="{{ asset('storage/' . $link->pdf_file) }}" class="text-primary" target="_blank">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                                            </svg>
                                        </span>
                                        {{ $link->txtename }}
                                    </a>
                                @endif
                            </li>
                        @empty
                            <li class="list-group-item text-danger">No data available</li>
                        @endforelse
                    </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('user.pages.microsites.includes.footer')