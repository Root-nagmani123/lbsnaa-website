<!-- resources/views/user/pages/microsites/video_gallery.blade.php -->

@include('user.pages.microsites.includes.header')
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Media Gallery</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Video Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid my-4">
    <div class="row g-4">
        @if($videos->isEmpty())
            <div class="col-12 text-center">
                <p>No YouTube links available</p>
            </div>
        @else
            @foreach ($videos as $video) 
            <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                <!-- Bootstrap Card -->
                <div class="card h-100 shadow-sm w-100">
                    <div class="card-body d-flex flex-column">
                        <!-- Video Category -->
                        <h5 class="card-title text-primary mb-2">{{ $video->video_upload }}</h5>
                        <!-- Video Titles -->
                        <!-- <h6 class="text-muted">{{ $video->video_title_en }}</h6>
                        <p class="text-muted">{{ $video->video_title_hi }}</p> -->
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>


 
 
@include('user.pages.microsites.includes.footer')
