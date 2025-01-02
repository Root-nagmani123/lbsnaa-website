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
        @foreach ($videos as $video)
        <div class="col-md-4 col-sm-12 d-flex align-items-stretch">
            <!-- Bootstrap Card -->
            <div class="card h-100 shadow-sm">
                <!-- Card Image -->
                 <!-- Video Player -->
                    <video controls>
                        <source src="{{ asset('storage/' . $video->video_upload) }}" type="video/mp4" style="object-fit: cover; height: 200px; width: 100%;">
                        Your browser does not support the video tag.
                    </video>
                <!-- Card Body -->
                <div class="card-body d-flex flex-column">
                    <!-- Video Category -->
                    <h5 class="card-title text-primary">{{ $video->category_name }}</h5>
                    <!-- Video Titles -->
                    <h6 class="text-muted">{{ $video->video_title_en }}</h6>
                    <p class="text-muted">{{ $video->video_title_hi }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
 
 
@include('user.pages.microsites.includes.footer')
