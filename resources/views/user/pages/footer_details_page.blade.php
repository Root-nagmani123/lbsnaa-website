@include('user.includes.header')

@if(isset($nav_page))

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">@if(Cookie::get('language') ==
                                '2')घर
                                @else
                                Home
                                @endif</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$nav_page->menutitle}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="mb-2">
                    <h2 class="h1 fw-bold text-primary">
                        {{$nav_page->menutitle}}
                    </h2>
                </div>
            </div>
        </div>

        <p><?= $nav_page->content ?></p>
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