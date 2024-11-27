@include('user.includes.header')

<!-- Page Content -->
  <!-- slider start -->
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <div class="carousel-indicators">
     
    @foreach($sliders as $i => $slider)
        @if($i == 0)
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to={{$i}} class="active" aria-current="true" aria-label={{$slider->text}}></button>
        @endif
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$i}}" aria-label={{$slider->text}}></button>
    @endforeach
    </div>

    <!-- Dynamic Slider -->
    <div class="carousel-inner">
        @foreach($sliders as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('public/slider-images/' . $slider->image) }}" class="d-block w-100 img-fluid h-50" alt="{{ $slider->text }}">
            <div class="carousel-caption d-none d-md-block">
                <h5>{{ $slider->text }}</h5>
                <p>{{ $slider->description }}</p>
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
  <div class="caontainer-fluid">
  <div class="position-relative d-flex overflow-x-hidden py-lg-4 pt-4 gap-3">
    <button class="btn btn-primary" id="basic-addon2" style="z-index: 1;">Latest Updates</button>
    <div class="animate-marquee d-flex gap-3">
    @foreach($news_scrollers as $scroller)  
    <a href="#" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border">
        <!--img-->
        <div class="p-3">
          <span class="text-gray-800">{{$scroller->menutitle}}</span>
        </div>
      </a>
      @endforeach  
    </div>
    
  </div>
</div>


<section class="py-8">
    <div class="container my-lg-8">
        <!-- row -->
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <!-- card -->
                <div class="card mb-4 card-hover">
                    <!-- img -->
                    <div>
                        <img src="{{ asset('assets/images/4.jpg') }}" alt="img" class="card-img-top">
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <h3 class="mb-0 fw-semibold"><a href="#" class="text-inherit">Director's Message</a></h3>
                        <p class="mb-3">Message</p>
                        <p class="mb-3">Previous Message</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <!-- card -->
                <div class="card mb-4 card-hover">
                    <!-- img -->
                    <div>
                        <img src="{{ asset('assets/images/2.jpg') }}" alt="img" class="card-img-top">
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                      <h3 class="mb-0 fw-semibold"><a href="#" class="text-inherit">Director's Message</a></h3>
                      <p class="mb-3">Message</p>
                      <p class="mb-3">Previous Message</p>
                  </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <!-- card -->
                <div class="card mb-4 card-hover">
                    <!-- img -->
                    <div>
                        <img src="{{ asset('assets/images/3.jpg') }}" alt="img" class="card-img-top">
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                      <h3 class="mb-0 fw-semibold"><a href="#" class="text-inherit">Director's Message</a></h3>
                      <p class="mb-3">Message</p>
                      <p class="mb-3">Previous Message</p>
                  </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-12 d-lg-none d-xl-block">
                <!-- card -->
                <div class="card mb-4 card-hover">
                    <!-- img -->
                    <div>
                        <img src="{{ asset('assets/images/5.jpg')}}" alt="img" class="card-img-top">
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                      <h3 class="mb-0 fw-semibold"><a href="#" class="text-inherit">Director's Message</a></h3>
                      <p class="mb-3">Message</p>
                      <p class="mb-3">Previous Message</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-8 bg-light">
  <div class="container">
    <div class="row gy-4 gy-xl-0">
      <div class="col-xl-8 col-lg-6 col-12">
        <div class="px-xl-8 my-lg-6">
          <div class="mb-5">
            <span class="fw-semibold text-primary">LBSNAA Academy News</span>
          </div>
          <div class="position-relative">
            <div class="tns-outer" id="tns1-ow">
              <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">
                slide 
                <span class="current">6 to 7</span>  
                of 5
              </div>
              <div id="tns1-mw" class="tns-ovh">
                <div class="tns-inner" id="tns1-iw">
                  <div class="sliderTestimonialFourth tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" id="tns1">
                    @foreach($news as $slider)
                      <div class="item tns-item">
                        <div class="card card-lift h-100 text-center text-lg-start">
                          <div class="p-2">
                            <a href="#"><img src="{{ asset('assets/images/' . $slider->main_image) }}" alt="" class="img-fluid rounded-3 w-100"></a>
                          </div>
                          <div class="card-body pt-2">
                            <h3><a class="text-inherit" href="#">{{ $slider->title }}</a></h3>
                            <p>{{ $slider->short_description }}</p>
                            <a href="{{ route('user.newsbyslug', $slider->title_slug) }}" class="icon-link icon-link-hover link-primary fw-semibold">
                              <span>View Details</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
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
            <ul class="controls-testimonial controls justify-content-start" id="sliderTestimonialFourthControls" aria-label="Carousel Navigation" tabindex="0">
              <li class="prev ms-0" aria-controls="tns1" tabindex="-1" data-controls="prev">
                <i class="fe fe-chevron-left"></i>
              </li>
              <li class="next ms-2" aria-controls="tns1" tabindex="-1" data-controls="next">
                <i class="fe fe-chevron-right"></i>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-6 col-12">
        <div class="bg-primary px-4 pt-4 rounded-3 position-relative d-flex flex-column justify-content-center">
              <ul class="mt-2 mb-2 list-group list-group-flush">
              @foreach($quick_links as $key => $quick_link)
                <li class="text-start list-group-item text-white">{{$quick_link->text}}</li>
              @endforeach     
              </ul>
         
        </div>
      </div>
    </div>
  </div>
</section>

@include('user.includes.footer')