@include('user.includes.header')
<section class="py-5">
    <!-- container -->
    <div class="container">
        <div class="row">
            <!-- Title Column -->
            <div class="col-12 col-lg-5">
                <div class="mb-2">
                    <!-- Title -->
                    <h3 class="mb-3 fw-bold">Media Gallery</h3>
                </div>
            </div>
        </div>
        
        <!-- Success Message -->
        @if(session('success'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Media Gallery -->
        <div class="row g-3 py-lg-4 pt-4 justify-content-start">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('user.audiogallery')}}" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift">
                    <div class="p-3">
                        <img src="{{ asset('assets/images/audio-book.png') }}" alt="Academy Song"
                            class="img-fluid rounded-circle" style="max-width: 100px;">
                    </div>
                    <div class="mt-3">
                        <h4 class="text-center">Academy Song</h4>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('user.videogallery')}}" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift">
                    <div class="p-3">
                        <img src="{{ asset('assets/images/audio-book.png') }}" alt="Academy Song"
                            class="img-fluid rounded-circle" style="max-width: 100px;">
                    </div>
                    <div class="mt-3">
                        <h4 class="text-center">Video Gallery</h4>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('user.photogallery') }}"
                    class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift">
                    <div class="p-3">
                        <img src="{{ asset('assets/images/gallery (1).png') }}" alt="Photo Gallery"
                            class="img-fluid rounded-circle" style="max-width: 100px;">
                    </div>
                    <div class="mt-3">
                        <h4 class="text-center">Photos Gallery</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

@include('user.includes.footer')