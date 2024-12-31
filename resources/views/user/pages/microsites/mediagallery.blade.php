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
        <!-- <div class="col-4">
            <div class="card card-hover border">
                <div class="card-header" style="background-color: #af2910;">
                    <h3 class="text-white">Quick Links</h3>
                </div>
                <div class="card-body" style="padding: 0;">
                        
                </div>
            </div>
        </div> -->
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

@include('user.pages.microsites.includes.footer')