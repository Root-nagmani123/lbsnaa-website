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
                            <a href="{{ route('user.micrositebyslug', ['slug' => $slug]) }}" style="color: #af2910;">Home</a>
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
    <!-- <div style="margin: 20px 0;">
        <form action="{{ route('photoGalleries.filterGallery') }}" method="GET" id="filterForm"
            style="display: flex; gap: 10px; align-items: center;">
            <label for="keyword" class="fw-semibold label">Search:</label>
            <input type="text" name="keyword" id="keyword" placeholder="Keyword Search" value="{{ request('keyword') }}"
                class="form-control  h-58 w-25">

            <select name="category" class="form-control  h-58 w-25">
                <option value="">All Categories</option>
                @foreach ($photoGalleries as $gallery)
                <option value="{{ $gallery->category_id }}" {{ request('category') == $gallery->category_id ? 'selected' : '' }}>
                    {{ $gallery->media_category_name }}
                </option>
                @endforeach
            </select>

            <select name="year" class="form-control  h-58 w-25">
                <option value="">All Years</option>
                @for($year = date('Y'); $year >= 2000; $year--)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>

            <button type="submit" class="btn btn-outline-primary fw-semibold">Submit</button>

            <button type="button" onclick="clearFilters()" class="fw-semibold btn btn-outline-secondary">Clear</button>
        </form>
    </div> -->

    <!-- Gallery Display -->
    @if($photoGalleries->isNotEmpty())
    <div class="row">
        @foreach ($photoGalleries as $gallery)
        <div class="col-md-3 mb-4">
            <div class="card">

                <div class="card-body" style="padding:0;">
                    <a href="{{ route('media_gallery_details', ['id' => $gallery->category_id, 'slug' => $slug]) }}"> <!-- Use route helper -->
                        <img src="{{ asset('storage/uploads/category_images/' . $gallery->category_image) }}" class="img-fluid rounded" 
                        alt="{{ $gallery->category_image }}" style="width: 100%; height: 250px; object-fit: cover;">
                    </a>
                </div>




                <div class="card-footer" style="border:none;">
                    <div class="form-field mt-2">
                        <p class="card-text">{{ $gallery->media_category_name }}</p>
                    </div>
                </div>

            </div>
        </div>
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

