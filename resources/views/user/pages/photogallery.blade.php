@include('user.includes.header')
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="col-12">
                <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-2">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.mediagallery') }}" style="color: #af2910;">Media Gallery</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Photo Gallery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-2">
    <div class="container">
        <!-- Success Message -->
        @if(session('success'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif

        <!-- Search Form -->
        <div class="row mb-4">
            <div class="col-12">
                <form id="form2" action="{{ route('user.photogallery') }}" method="GET" class="row g-2">
                    <div class="col-md-3">
                        <label for="Keywords" class="form-label">Search:</label>
                        <input type="text" id="Keywords" name="keywords" value="" placeholder="Keyword Search"
                            class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="txtcategory" class="form-label">Category:</label>
                        <select name="txtcategory" id="txtcategory" class="form-select">
                            <option value="">Select</option>
                            @foreach($media_cat as $media)
                            <option value="{{ $media->id }}">{{ $media->media_gallery }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="year" class="form-label">Year:</label>
                        <select name="year" id="year" class="form-select">
                            @for($i = date('Y'); $i >= 2011; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                    <button id="btn2" type="reset" class="btn btn-outline-warning fw-bold w-100" onclick="pageLoad()">Reset</button>
                    <input type="hidden" name="action" value="reset">
                        <button id="btn2" type="submit" class="btn btn-outline-primary fw-bold w-100">Submit</button>
                        <input type="hidden" name="action" value="submit">
                    </div>
                </form>
            </div>
        </div>

        <!-- Gallery Images -->
        <div class="row g-3">
            @if(count($media_cat) > 0)
            @foreach($media_cat as $media)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <a href="{{ url('view_all_photogallery') }}?glrid={{ $media->id }}">
                        <img src="https://www.lbsnaa.gov.in/upload/photogallery/media/65a53a922cd00A03A7707.JPG"
                            alt="{{ $media->name }}" class="card-img-top img-fluid rounded-top" style="height:150px; object-fit: cover;">
                    </a>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">{{ $media->name }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12">
                <h5 class="text-center">No media categories available.</h5>
            </div>
            @endif
        </div>
    </div>
</section>

@include('user.includes.footer')