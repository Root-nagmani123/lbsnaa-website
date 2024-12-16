@include('user.includes.header')
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
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.mediagallery')}}" style="color: #af2910;">Media Gallery</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.photogallery')}}" style="color: #af2910;">Photo Gallery</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Photo Gallery Details</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-5">
    <!-- container -->
    <div class="container">
        <div class="row">
            <!-- cols -->
            <div class="col-md-12 col-lg-5">
                <div class="mb-2">
                    <!-- title -->
                    <h1 class="display-4 mb-3 fw-bold">Photo Gallery</h1>
                    <!-- text -->
                    <p>@if(count($media_d) > 0 ){{ $media_d[0]->name}}@endif</p>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <!-- form -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <div class="container">
    <div class="row">
        @if(count($media_d) > 0)
            @foreach($media_d as $media)
                @php
                    // Decoding the JSON data to get the images
                    $multiple_img = json_decode($media->image_files, true);
                @endphp
                @if(is_array($multiple_img))
                    @foreach($multiple_img as $img)
                        <div class="col-md-4 mb-4"> <!-- Added 'mb-4' for spacing between rows -->
                            <div class="galleryimges">
                            <a href="#">

                                    <img src="{{ asset('storage/' . $img) }}" class="img-fluid rounded" 
                                         alt="{{ $media->name }}" style="width: 100%; height: auto;">
                                </a>
                                <div class="form-field mt-2">
                                    <p>{{ $media->image_title_english }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @endif
    </div>
</div>


    </div>
</section>
@include('user.includes.footer')