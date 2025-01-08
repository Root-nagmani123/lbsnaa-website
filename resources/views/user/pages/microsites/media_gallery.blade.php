@include('user.pages.microsites.includes.header')

@if(isset($photoGalleries))
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
                        <li class="breadcrumb-item active" aria-current="page">Photo Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid">
    <!-- Filter Form -->
    <div style="margin: 20px 0;">
        <form action="{{ route('photoGalleries.filterGallery') }}" method="GET" id="filterForm"
            style="display: flex; gap: 10px; align-items: center;">
            <!-- Keyword Search -->
            <label for="keyword" class="fw-semibold label">Search:</label>
            <input type="text" name="keyword" id="keyword" placeholder="Keyword Search" value="{{ request('keyword') }}"
                class="form-control  h-58 w-25">

            <!-- Category Dropdown -->
            <select name="category" class="form-control  h-58 w-25">
                <option value="">All Categories</option>
                @foreach ($courses as $course)
                <option value="{{ $course->id }}" {{ request('category') == $course->id ? 'selected' : '' }}>
                    {{ $course->course_name }}
                </option>
                @endforeach
            </select>

            <!-- Year Dropdown -->
            <select name="year" class="form-control  h-58 w-25">
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
    <div class="row">
        @foreach ($photoGalleries as $gallery)
        @php
        $imageFiles = json_decode($gallery->image_files, true);
        @endphp

        @if(is_array($imageFiles) && !empty($imageFiles))
        @foreach ($imageFiles as $imageFile)
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body" style="padding:0;">
                    <img src="{{ asset('storage/' . $imageFile) }}" class="img-fluid rounded"
                        alt="{{ $gallery->image_title_english }}"
                        style="width: 100%; height: 250px; object-fit: cover;">
                </div>
                <div class="card-footer" style="border:none;">
                    <div class="form-field mt-2">
                        <h5 class="card-title">{{ $gallery->image_title_english }}</h5>
                        <p class="card-text">{{ $gallery->image_title_hindi }}</p>
                    </div>
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
</section>
@include('user.pages.microsites.includes.footer')

<script>
function clearFilters() {
    // Reset the form
    document.getElementById('filterForm').reset();

    // Optionally, clear the query parameters from the URL
    window.location.href = "{{ route('photoGalleries.filterGallery') }}";
}
</script>

