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
    <div style="margin: 20px 0;">
    <form action="{{ route('photoGalleries.filterGallery') }}" method="GET" id="filterForm"
        style="display: flex; gap: 10px; align-items: center;">
        <label for="keyword" class="fw-semibold label">Search:</label>
        <input type="text" name="keyword" id="keyword" placeholder="Keyword Search" value="{{ request('keyword') }}"
            class="form-control ps-5 h-58 w-25">

        <select name="category" class="form-control ps-5 h-58 w-25">
            <option value="">All Categories</option>
            @if (isset($categorys) && $categorys->isNotEmpty())
                @foreach ($categorys as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            @else
                <option value="">No categories available</option>
            @endif
        </select>
        <select name="year" class="form-control ps-5 h-58 w-25">
            <option value="">All Years</option>
            @for($year = date('Y'); $year >= 2000; $year--)
            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
            @endfor
        </select>
        <button type="submit" class="btn btn-outline-primary fw-semibold">Submit</button>
        <button type="button" onclick="clearFilters()" class="fw-semibold btn btn-outline-secondary">Clear</button>
    </form>
</div>


<!-- Gallery Display -->
@if($categorys->isNotEmpty())
<div class="row gap-4">
    @foreach ($categorys as $gallery)
        <div class="col-md-4 col-sm-6">
            <div class="card h-100">
                <!-- Add link to the image and details page -->
                <a href="{{ route('category.details', ['id' => $gallery->id, 'slug' => $slug]) }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ asset('storage/uploads/category_images/' . $gallery->category_image) }}" 
                         alt="{{ $gallery->category_image }}" 
                         style="height: 200px; background-size: cover; background-position: center;">                   
                    <div class="card-body">
                        <h5 class="card-title">{{ $gallery->name }}</h5>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>
@else
<p style="text-align: center; color: #999; font-size: 18px;">No categories available.</p>
@endif
@endif



@include('user.pages.microsites.includes.footer')

