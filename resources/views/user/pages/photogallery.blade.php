@include('user.includes.header')
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.mediagallery')}}" style="color: #af2910;">Media Gallery</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Photo Gallery</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-2">
    <!-- container -->
    <div class="container">
        <!-- form -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row mb-4">
            <div class="contsearch">
                <form id="form2" action="{{ route('user.photogallery') }}" method="GET">
                    <fieldset>
                        <label class="txt">Search:</label>
                        <label for="keywords">
                            <input type="text" id="Keywords" name="keywords" value="" placeholder="Keyword Search"
                                class="txt input form-control">
                        </label>

                        <label for="category">
                            <select name="txtcategory" id="txtcategory" autocomplete="off"
                                class="txt input form-control">
                                <option value="">Select</option>
                                @foreach($media_cat as $media)
                                <option value="{{ $media->id }}">{{ $media->media_gallery }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label for="year">
                            <select name="year" id="year" class="txt input form-control">
                                @for($i = date('Y'); $i >= 2011; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </label>

                        <label for="btn2">
                            <input id="btn2" type="submit" value="Submit" class="btn btn-outline-primary fw-bold">
                            <input type="hidden" name="action" value="submit">
                        </label>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="row">
            @if(count($media_cat) > 0)
            @foreach($media_cat as $media)
            <div class="col-md-4">
                <div class="galleryimges">

                    <a href="{{ url('view_all_photogallery') }}?glrid={{ $media->id }}">
                        <img src="https://www.lbsnaa.gov.in/upload/photogallery/media/65a53a922cd00A03A7707.JPG"
                            width="250" height="220" alt="Inaugural Function of 30th Joint Civil Military Program"
                            border="0" class="img-fluid rounded-10"></a>
                    <div class="form-field">
                        <h3>{{ $media->name }}</h3>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
@include('user.includes.footer')