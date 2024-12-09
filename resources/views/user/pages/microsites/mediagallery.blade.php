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
                            <a href="{{ route('home')}}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Media Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="position-relative d-flex overflow-x-hidden py-lg-4 pt-4">
                <div class="d-flex gap-3">
                    <a href="{{ route('user.media_gallery') }}"
                        class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border"
                        style="width: 200px !important">
                        <!--img-->
                        <div class="p-3">
                            <img src="{{ asset('assets/images/images.png') }}" alt="mentor 19" class="avatar avatar-xl">
                            <!--content-->
                            <div class="mt-3">
                                <h3 class="mb-0 h4">Photos Gallery</h3>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('videoGallery') }}"
                        class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border"
                        style="width: 200px !important">
                        <!--img-->
                        <div class="p-3">
                            <img src="{{ asset('assets/images/gallery.png') }}" alt="mentor 19"
                                class="avatar avatar-xl">
                            <!--content-->
                            <div class="mt-3">
                                <h3 class="mb-0 h4">Video Gallery</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color: #af2910;">
                        <h3 class="text-white">Quick Links</h3>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        
                    </div>
                </div>

            </div>
    </div>
</div>

@include('user.pages.microsites.includes.footer')