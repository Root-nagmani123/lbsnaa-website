@include('user.pages.microsites.includes.header')

@if(isset($photoGalleries))
<section class="py-4">
    <div class="container">
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
                        <li class="breadcrumb-item active" aria-current="page">Photo Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="container"> 
    <!-- Filter Form -->
    <div style="margin: 20px 0;">
    <form action="{{ route('photoGalleries.filterGallery') }}" method="GET" id="filterForm"
        style="display: flex; gap: 10px; align-items: center;">
        <!-- Keyword Search -->
        <label for="keyword" class="fw-semibold label">Search:</label>
        <input type="text" name="keyword" id="keyword" placeholder="Keyword Search" value="{{ request('keyword') }}"
            class="form-control ps-5 h-58 w-25">

        <!-- Category Dropdown -->
        <select name="category" class="form-control ps-5 h-58 w-25">
            <option value="">All Categories</option>
            @foreach ($courses as $course)
            <option value="{{ $course->id }}" {{ request('category') == $course->id ? 'selected' : '' }}>
                {{ $course->course_name }}
            </option>
            @endforeach
        </select>

        <!-- Year Dropdown -->
        <select name="year" class="form-control ps-5 h-58 w-25">
            <option value="">All Years</option>
            @for($year = date('Y'); $year >= 2000; $year--)
            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
            @endfor
        </select>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-outline-primary fw-semibold">Submit</button>

        <!-- Clear Button -->
        <button type="button" onclick="clearFilters()" class="fw-semibold btn btn-outline-secondary">Clear</button>
    </form>
</div>
<!-- Gallery Display -->
@if($photoGalleries->isNotEmpty())
<div class="row g-4">
    @foreach ($photoGalleries as $gallery)
        @php
            $imageFiles = json_decode($gallery->image_files, true);
        @endphp

        @if(is_array($imageFiles) && !empty($imageFiles))
            @foreach ($imageFiles as $imageFile)
            <div class="col-md-4 col-sm-6">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Image -->
                    <img src="{{ asset('storage/' . $imageFile) }}" class="card-img-top rounded-3 img-fluid" alt="{{ $gallery->image_title_english }}" style="object-fit: cover; height: 200px;">
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <h5 class="card-title">{{ $gallery->image_title_english }}</h5>
                        <p class="card-text">{{ $gallery->image_title_hindi }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <div class="col-12">
            <p style="text-align: center; color: #999;">No valid images available for this gallery.</p>
        </div>
        @endif
    @endforeach
</div>
@else
<p style="text-align: center; color: #999; font-size: 18px;">No photos available.</p>
@endif
@endif
@include('user.pages.microsites.includes.footer')

<script>
    function clearFilters() {
        // Reset the form
        document.getElementById('filterForm').reset();

        // Optionally, clear the query parameters from the URL
        window.location.href = "{{ route('photoGalleries.filterGallery') }}";
    }
</script>