@include('user.includes.header')
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">@if($_COOKIE['language'] ==
                                '2')घर
                                @else
                                Home
                                @endif</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.mediagallery')}}" style="color: #af2910;">
                                @if($_COOKIE['language'] ==
                                '2')मीडिया गैलरी
                                @else
                                Media Gallery
                                @endif
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            @if($_COOKIE['language'] ==
                            '2')वीडियो गैलरी विवरण
                            @else
                            Video Gallery Details
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-2" id="skip_to_main_content">
    <!-- container -->
    <div class="container-fluid">
        <!-- form -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h2 class="text-primary mb-2">@if($_COOKIE['language'] ==
            '2')वीडियो गैलरी
            @else
            Video Gallery
            @endif</h2>
        <div class="row">
            @if(count($media_data) > 0)
            @foreach($media_data as $media)

            <div class="col-md-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ $media->video_upload }}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg"
                                height="48px" viewBox="0 -960 960 960" width="48px" fill="#af2910">
                                <path
                                    d="m383-310 267-170-267-170v340Zm97 230q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-156t86-127Q252-817 325-848.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 82-31.5 155T763-197.5q-54 54.5-127 86T480-80Zm0-60q142 0 241-99.5T820-480q0-142-99-241t-241-99q-141 0-240.5 99T140-480q0 141 99.5 240.5T480-140Zm0-340Z" />
                            </svg></a>
                    </div>
                    <div class="card-footer" style="border:none;">
                        <div class="form-field mt-2">
                            <p>{{ $media->audio_title_en }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
            @endif
        </div>


    </div>
</section>
@include('user.includes.footer')