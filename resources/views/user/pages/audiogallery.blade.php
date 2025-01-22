@include('user.includes.header')
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">
                                @if(Cookie::get('language') == '2')
                                घर
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.mediagallery')}}" style="color: #af2910;">
                                @if(Cookie::get('language') == '2')
                                मीडिया गैलरी
                                @else
                                Media Gallery
                                @endif
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">
                                @if(Cookie::get('language') == '2')
                                ऑडियो गैलरी विवरण
                                @else
                                Audio Gallery Details
                                @endif
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-2">
    <div class="container-fluid">
        <h2 class="text-primary mb-2">
            @if(Cookie::get('language') == '2')
            ऑडियो गैलरी
            @else
            Audio Gallery
            @endif</h2>
        <div class="row">
            @if(count($media_data) > 0)
            @foreach($media_data as $media)
            <div class="col-md-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <audio controls class="w-100">
                            <source src="{{ asset('uploads/audios/' . $media->audio_upload) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                    <div class="card-footer" style="border:none;">
                        <div class="form-field mt-2">
                            <p>{{ $media->audio_title_en }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p>
                @if(Cookie::get('language') == '2')
                कोई ऑडियो नहीं मिला
                @else
                No Audio Found
                @endif
            </p>
            @endif
        </div>
    </div>
</section>
@include('user.includes.footer')