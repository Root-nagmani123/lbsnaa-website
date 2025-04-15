@include('user.includes.header')

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="col-12 mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-danger">
                                @if($_COOKIE['language'] == '2')
                                होम
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-danger">
                                @if($_COOKIE['language'] == '2')
                                अकादमी समाचार
                                @else
                                Academy News
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @if($_COOKIE['language'] == '2')
                            पुरालेख अकादमी समाचार
                            @else
                            Archive Academy News
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Search Form -->
<section class="py-3">
    <div class="container-fluid">
        <div class="contsearch">
            <form id="form2" method="GET" action="{{ route('user.news_old_listing') }}" class="row">
                <div class="col-lg-4">
                    <label for="Keywords" class="form-label">
                        @if($_COOKIE['language'] == '2')
                        दिन/माह/वर्ष के अनुसार खोजें:
                        @else
                        Search by Day/Month/Year:
                        @endif
                    </label>
                    <input type="text" id="Keywords" name="keywords" value="{{ request('keywords') }}" placeholder="@if($_COOKIE['language'] == '2')
                        समाचार खोजें
                        @else
                        Search News
                        @endif" class="form-control ps-5 text-dark h-58">
                </div>
                <div class="col-lg-4">
                    <label for="year" class="form-label">
                        @if($_COOKIE['language'] == '2')
                        साल
                        @else
                        Years
                        @endif
                    </label>
                    <select name="year" id="year" fdprocessedid="wgb9i" class="form-select ps-5 text-dark h-58">
                        @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-outline-primary fw-bold w-100">
                        @if($_COOKIE['language'] == '2')
                        जमा करना
                        @else
                        Submit
                        @endif
                    </button>
                    <a href="{{ route('user.news_old_listing') }}" class="btn btn-outline-warning fw-bold w-100">
                        @if($_COOKIE['language'] == '2')
                        रीसेट करें
                        @else
                        Reset
                        @endif
                    </a>

                </div>
            </form>
        </div>
    </div>
</section>


<!-- News Section -->
<section class="py-6" id="skip_to_main_content">
    <div class="container-fluid">
        @if($news->isNotEmpty())
        <div class="row g-4">
            @foreach($news as $slider)
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <!-- Card -->
                <div class="card shadow-lg card-lift h-100">
                    <div class="card-header p-0">
                        <a href="#">
                            <img src="{{ $slider->main_image ? asset($slider->main_image) : asset('assets/images/4.jpg') }}"
                                class="card-img-top" alt=" {{ $slider->title }}"
                                style="height: 200px; object-fit: cover;">
                        </a>
                    </div>
                    <!-- Card body -->
                    <div class="card-body d-flex flex-column">
                        <p class="fs-5 mb-2 fw-semibold d-block" style="color:#007A33;">
                            @if (isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                            प्रकाशित किया गया:
                            @else
                            Posted On:
                            @endif
                            {{ \Carbon\Carbon::parse($slider->start_date)->format('d F, Y') }}
                        </p>

                        <a href="{{ route('user.newsbyslug', $slider->title_slug) }}" class="fs-5">
                            <h3 class="fs-5">
                                {{ (isset($_COOKIE['language']) && $_COOKIE['language'] == '2') ? ($slider->title_hindi ?? $slider->title) : $slider->title }}
                            </h3>
                        </a>

                        <p class="text-truncate" style="max-height: 3rem;">
                            @if (isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                            <!-- $string = {!! $slider->description_hindi ?? $slider->short_description !!} -->
                            {!! substr($slider->description_hindi, 0, 600). '...' !!}
                            @else
                            {!! substr($slider->short_description, 0, 600). '...' !!}
                            @endif
                        </p>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer bg-white border-0 text-end">
                        <a href="{{ route('user.newsbyslug', $slider->title_slug) }}" class="text-primary">
                            @if($_COOKIE['language'] == '2')
                            और पढ़ें
                            @else
                            Read More
                            @endif
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <h4>
            @if($_COOKIE['language'] == '2')
            कोई समाचार नहीं मिला
            @else
            No News Found
            @endif
        </h4>
        @endif
    </div>
</section>

@include('user.includes.footer')