@include('user.includes.header')
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">
                                @if($_COOKIE['language'] == '2')
                                होम
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.mediagallery')}}" style="color: #af2910;">
                                @if($_COOKIE['language'] == '2')
                                मीडिया गैलरी
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.photogallery')}}" style="color: #af2910;">
                                @if($_COOKIE['language'] == '2')
                                फोटो गैलरी
                                @else
                                Photo Gallery
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            @if($_COOKIE['language'] == '2')
                            फोटो गैलरी विवरण
                            @else
                            Photo Gallery Details
                            @endif </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-5" id="skip_to_main_content">
    <!-- container -->
    <div class="container-fluid">
        <div class="row">
            @if(count($media_d) > 0)
            @if($type == 'gallery')
            @foreach($media_d as $media)
            @php
            // Decoding the JSON data to get the images
            $multiple_img = json_decode($media->image_files, true);
            @endphp
            @if(is_array($multiple_img))
            @foreach($multiple_img as $img)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body" style="padding:0;">
                        <a href="{{ asset('storage/' . $img) }}" data-fancybox="gallery"
                            data-caption="{{ $media->image_title_english }}">
                            <img src="{{ asset('storage/' . $img) }}" class="img-fluid rounded" alt="{{ $media->name }}"
                                style="width: 100%; height: 250px; object-fit: cover;">
                        </a>
                    </div>
                    <div class="card-footer" style="border:none;">
                        <div class="form-field mt-2">
                            <p>{{ ($_COOKIE['language'] ?? '1') == '2' ? $media->image_title_hindi : $media->image_title_english }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            @endforeach
            @elseif($type == 'news')
            @foreach($media_d as $media)
            @php
            // Decoding the JSON data to get the images
            $multiple_img = json_decode($media->multiple_images, true);
            @endphp
            @if(is_array($multiple_img))
            @foreach($multiple_img as $img)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body" style="padding:0;">
                        <a href="{{ asset($img) }}" data-fancybox="news" data-caption="{{ $media->title }}">
                            <img src="{{ asset($img) }}" class="img-fluid rounded" alt="{{ $media->title }}"
                                style="width: 100%; height: 250px; object-fit: cover;">
                        </a>
                    </div>
                    <div class="card-footer" style="border:none;">
                        <div class="form-field mt-2">
                            <p>{{ ($_COOKIE['language'] ?? '1') == '2' ? $media->title_hindi : $media->title }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            @endforeach
            @endif
            @else
            <p>

                @if($_COOKIE['language'] == '2')
                कोई छवि उपलब्ध नहीं है
                @else
                No images available
                @endif
            </p>
            @endif
        </div>
    </div>

</section>
<!-- Include Fancybox CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    Fancybox.bind("[data-fancybox]", {
        Toolbar: {
            display: ["zoom", "close"], // Display zoom and close buttons
        },
        closeButton: "inside", // Close button inside the lightbox
    });
});
</script>

@include('user.includes.footer')