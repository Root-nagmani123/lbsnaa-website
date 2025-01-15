@include('user.includes.header')
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.mediagallery')}}" style="color: #af2910;">Media Gallery</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Audio Gallery Details</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container-fluid">
        <div class="row">
            @if(count($media_data) > 0)
                @foreach($media_data as $media)
                    <div class="col-md-3 mb-4">
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
                <p>No Audio Found</p>
            @endif
        </div>
    </div>
</section>
@include('user.includes.footer')