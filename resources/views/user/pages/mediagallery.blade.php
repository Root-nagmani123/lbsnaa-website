@include('user.includes.header')
<section class="py-5">
    <!-- container -->
    <div class="container">
        <!-- Breadcrumb -->
        <div class="row align-items-center pb-lg-2 mb-4">
            <div class="col-12">
                <div class="bg-gray-200 rounded-4 py-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-2 mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Media Gallery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
        <!-- Media Gallery -->
        <div class="row gap-2 py-lg-4 pt-4 justify-content-start">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card">
                    <a href="{{ route('user.audiogallery')}}"
                        class="bg-white text-center shadow-sm text-wrap rounded-4 w-100">
                        <div class="p-3">
                            <img src="{{ asset('assets/images/audio-book.png') }}" alt="Academy Song" class="img-fluid"
                                style="max-width: 100px;">
                        </div>
                        <div class="mt-3">
                            <h4 class="text-center">Academy Song</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card">
                    <a href="{{ route('user.videogallery')}}"
                        class="bg-white text-center shadow-sm text-wrap rounded-4 w-100">
                        <div class="p-3">
                            <img src="{{ asset('assets/images/video.png') }}" alt="Academy Song" class="img-fluid"
                                style="max-width: 100px;">
                        </div>
                        <div class="mt-3">
                            <h4 class="text-center">Video Gallery</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card">
                    <a href="{{ route('user.photogallery') }}"
                        class="bg-white text-center shadow-sm text-wrap rounded-4 w-100">
                        <div class="p-3">
                            <img src="{{ asset('assets/images/gallery (1).png') }}" alt="Photo Gallery"
                                class="img-fluid" style="max-width: 100px;">
                        </div>
                        <div class="mt-3">
                            <h4 class="text-center">Photos Gallery</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('user.includes.footer')