@include('user.pages.microsites.includes.header')

@if(isset($gallery_details))
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.micrositebyslug', ['slug' => $slug]) }}"
                                style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/lbsnaa-sub_m/mediagallery?slug={{ $slug }}" style="color: #af2910;">Media
                                Gallery</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Photo Gallery Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid">
    <!-- Gallery Display -->
    @if($gallery_details->isNotEmpty())
    <div class="row">
        @foreach ($gallery_details as $gallery)
        @php
        // Decode the JSON array of image files
        $imageFiles = json_decode($gallery->image_files, true);
        @endphp

        @if(!empty($imageFiles) && is_array($imageFiles))
        <!-- Loop through all images -->
        @foreach ($imageFiles as $imageFile)
        <div class="col-md-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-body p-0">

                    @if(!empty($imageFiles) && is_array($imageFiles))
                    <!-- Display the first image in the array -->
                    <img src="{{ asset('storage/' . $imageFiles[0]) }}" class="img-fluid rounded-top" alt="Gallery Image"
                        style="width: 100%; height: 250px; object-fit: cover;">
                    @else
                    <!-- Fallback image if no image is found -->
                    <img src="{{ asset('storage/uploads/default-placeholder.png') }}" class="img-fluid rounded-top"
                        alt="No Image Available" style="width: 100%; height: 250px; object-fit: cover;">
                    @endif
                </div>
                <div class="card-footer text-center">
                    <p class="card-text mb-0">{{ $gallery->name }}</p>
                </div>
            </div>
        </div>
        @endforeach

        @else
        <!-- Fallback image if no image is found -->
        <img src="{{ asset('storage/uploads/default-placeholder.png') }}" class="img-fluid rounded-top"
            alt="No Image Available" style="width: 100%; height: 250px; object-fit: cover;">
        @endif
        @endforeach
    </div>
    @else
    <p style="text-align: center; color: #999; font-size: 18px;">No photos available.</p>
    @endif
</section>

@endif

@include('user.pages.microsites.includes.footer')