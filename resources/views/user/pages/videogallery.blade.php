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
                            <a href="#" style="color: #af2910;">Video Gallery Details</a>
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
                    <h1 class="display-4 mb-3 fw-bold">Video Gallery</h1>
                    <!-- text -->
                  
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
        @if(count($media_data) > 0)
            @foreach($media_data as $media)
              
                        <div class="col-md-4 mb-4"> <!-- Added 'mb-4' for spacing between rows -->
                            <div class="galleryimges">
                           
                           
<a href="{{ $media->video_upload }}" target="_blank">click here</a>
                                <div class="form-field mt-2">
                                    <p>{{ $media->audio_title_en }}</p>
                                </div>
                            </div>
                        </div>
               
            @endforeach
        @endif
    </div>
</div>


    </div>
</section>
@include('user.includes.footer')