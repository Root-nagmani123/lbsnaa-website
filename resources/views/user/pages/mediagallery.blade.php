@include('user.includes.header')
<section class="py-5">
    <!-- container -->
    <div class="container">
        <div class="row">
            <!-- cols -->
            <div class="col-md-12 col-lg-5">
                <div class="mb-2">
                    <!-- title -->
                    <h3 class="mb-3 fw-bold">Media Gallery</h3>
                    <!-- text -->

                </div>
            </div>
        </div>
        <!-- form -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="container">
            <div class="position-relative d-flex overflow-x-hidden py-lg-4 pt-4">
                <div class="d-flex gap-3">
                    <a href="#" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border"
                        style="width: 200px !important">
                        <div class="p-3">
                            <img src="{{ asset('assets/images/audio-book.png') }}" alt="mentor 19"
                                class="avatar avatar-xl">
                        </div>
                        <div class="mt-3">
                            <h3 class="text-center">Academy Song</h3>
                        </div>
                    </a>
                    <a href="{{ route('user.photogallery')}}"
                        class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border"
                        style="width: 200px !important">
                        <div class="p-3">
                            <img src="{{ asset('assets/images/gallery (1).png') }}" alt="mentor 19"
                                class="avatar avatar-xl">
                        </div>
                        <div class="mt-3">
                            <h3 class="text-center">Photos Gallery</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('user.includes.footer')