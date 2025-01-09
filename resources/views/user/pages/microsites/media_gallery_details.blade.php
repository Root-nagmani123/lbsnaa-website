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
                            <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Media Gallery </a>
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
        <div class="col-md-3 mb-4">
            <div class="card">

            <div class="card-body" style="padding:0;">
                @php
                    // Decode the JSON array of image files
                    $imageFiles = json_decode($gallery->image_files, true);
                @endphp
                
                @if(!empty($imageFiles) && is_array($imageFiles))
                    <!-- Loop through each image in the array -->
                    @foreach ($imageFiles as $image)
                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" 
                        alt="Gallery Image" style="width: 100%; height: 250px; object-fit: cover; margin-bottom: 10px;">
                        <div class="card-footer" style="border:none;">
                            
                        <div class="form-field mt-2">
                            <p class="card-text">{{ $gallery->research_centre_name }}</p>
                        </div>
            </div>
                    @endforeach
                @else
                    <!-- If no images, display a placeholder -->
                    <img src="{{ asset('storage/uploads/default-placeholder.png') }}" class="img-fluid rounded" 
                    alt="No Image Available" style="width: 100%; height: 250px; object-fit: cover;">
                @endif
            </div>

            

            </div>
        </div>
        @endforeach
    </div>
    @else
    <p style="text-align: center; color: #999; font-size: 18px;">No photos available.</p>
    @endif
</section>
@endif

@include('user.pages.microsites.includes.footer')


