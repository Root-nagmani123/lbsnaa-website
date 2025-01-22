@include('user.includes.header')

@if(isset($nav_page))

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Home link -->
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                @if(Cookie::get('language') ==
                                '2')घर
                                @else
                                Home
                                @endif
                            </a>
                        </li>

                        <!-- Dynamic breadcrumbs -->
                        @foreach ($breadcrumb as $crumb)
                        @if (!$loop->last)
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('user.navigationpagesbyslug', $crumb['slug']) }}">{{ $crumb['title'] }}</a>
                        </li>
                        @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $crumb['title'] }}</li>
                        @endif
                        @endforeach
                    </ol>
                </nav>


            </div>
        </div>
    </div>
</section>

<section class="py-8 bg-light">
    <div class="container-fluid">
        <div class="row gy-4 gy-xl-0">

            <div class="col-12">
                <!-- Additional content for the second column -->
                <div class="mb-6 mb-lg-8">
                    <h2 class="h1 fw-bold text-primary">
                        {{$nav_page->menutitle}}
                    </h2>
                </div>
                @if ($director_img != '')
                <div class="row">
                    <img src="{{ asset($director_img->image) }}" alt="mentor" class="avatar avatar-xl rounded-circle">

                </div>
                @endif

                <p><?= $nav_page->content ?></p>
            </div>
        </div>
    </div>
</section>


@else
<h4>
    @if(Cookie::get('language') ==
    '2')समाचार मौजूद नहीं है
    @else
    News does not exist
    @endif
</h4>
@endif


@include('user.includes.footer')