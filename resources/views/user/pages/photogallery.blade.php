@include('user.includes.header')
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="col-12">
                <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-2">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" style="color: #af2910;">
                                    @if(Cookie::get('language') ==
                                    '2')घर
                                    @else
                                    Home
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.mediagallery') }}" style="color: #af2910;">
                                    @if(Cookie::get('language') ==
                                    '2')मीडिया गैलरी
                                    @else
                                    Media Gallery
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @if(Cookie::get('language') ==
                                '2')फोटो गैलरी
                                @else
                                Photo Gallery
                                @endif
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-2" id="skip_to_main_content">
    <div class="container-fluid">
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
        <h2 class="text-primary mb-2">@if(Cookie::get('language') ==
            '2')फोटो गैलरी
            @else
            Photo Gallery
            @endif</h2>
        <!-- Search Form -->
        <div class="row mb-4">
            <div class="col-12">
                <form id="form2" action="{{ route('user.photogallery') }}" method="GET" class="row g-2">
                    <div class="col-md-3">
                        <label for="Keywords" class="form-label">
                            @if(Cookie::get('language') ==
                            '2')खोज:
                            @else
                            Search:
                            @endif</label>
                        <input type="text" id="Keywords" name="keywords" value="{{ request('keywords') }}"
                            placeholder="Keyword Search" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="txtcategory" class="form-label">
                            @if(Cookie::get('language') ==
                            '2')वर्ग:
                            @else
                            Category:
                            @endif
                        </label>
                        <select name="txtcategory" id="txtcategory" class="form-select">
                            <option value="">Select</option>
                            @foreach($media_cat as $media)
                            <option value="{{ $media->id }}"
                                {{ request('txtcategory') == $media->id ? 'selected' : '' }}>
                                {{ $media->name }}
                            </option>
                            @endforeach
                            @foreach($news as $media)
                            <option value="{{ $media->title_slug }}"
                                {{ request('txtcategory') == $media->title_slug ? 'selected' : '' }}>
                                {{ $media->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="year" class="form-label">
                            @if(Cookie::get('language') ==
                            '2')वर्ष:
                            @else
                            Year:
                            @endif
                        </label>
                        <select name="year" id="year" class="form-select">
                            <option value="">Select</option>
                            @for($i = date('Y'); $i >= 2011; $i--)
                            <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-outline-primary fw-bold w-100">
                            @if(Cookie::get('language') ==
                            '2')जमा करना
                            @else
                            Submit
                            @endif
                        </button>
                        <a href="{{ route('user.photogallery') }}" class="btn btn-outline-warning fw-bold w-100">
                            @if(Cookie::get('language') ==
                            '2')रीसेट करें
                            @else
                            Reset
                            @endif
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <?php //print_r($news);die; ?>
        <!-- Gallery Images -->
        <div class="row g-3">
            @if((count($media_cat) > 0) || (count($news) > 0))
            @foreach($media_cat as $media)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('user.view_all_photogallery') }}?type=gallery&glrid={{ $media->id }}">
                        <img src="{{ $media->category_image ? url('uploads/category_images/' . $media->category_image) : url('path/to/default-image.jpg') }}"
                            alt="{{ $media->name }}" class="card-img-top img-fluid rounded-top"
                            style="height:300px; object-fit: cover;">
                    </a>

                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">{{ $media->name }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
            @foreach($news as $media)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('user.view_all_photogallery') }}?type=news&glrid={{ $media->id }}">
                        <img src="{{asset( $media->main_image)}}" alt="{{ $media->title }}"
                            class="card-img-top img-fluid rounded-top" style="height:300px; object-fit: cover;">
                    </a>

                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">{{ $media->title }}</h5>
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