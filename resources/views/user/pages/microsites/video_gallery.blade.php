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
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
        @if($videos->isEmpty())
        <div class="col text-center">
            <p>No YouTube links available</p>
        </div>
        @else
        @foreach ($videos as $video)
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <a href="{{ $video->video_upload }}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg"
                            height="48px" viewBox="0 -960 960 960" width="48px" fill="#af2910">
                            <path
                                d="m383-310 267-170-267-170v340Zm97 230q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-156t86-127Q252-817 325-848.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 82-31.5 155T763-197.5q-54 54.5-127 86T480-80Zm0-60q142 0 241-99.5T820-480q0-142-99-241t-241-99q-141 0-240.5 99T140-480q0 141 99.5 240.5T480-140Zm0-340Z" />
                        </svg></a>
                </div>
                <div class="card-footer" style="border:none;">
                    <div class="form-field mt-2">
                        <p>{{ $video->video_title_en }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>




@include('user.pages.microsites.includes.footer')