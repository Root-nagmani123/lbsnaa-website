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
                            <a href="{{ route('home') }}" class="text-primary">@if($_COOKIE['language'] ==
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
                            <a href="{{ route('user.get_rti_page_details', $crumb['slug']) }}" class="text-primary">{{ $crumb['title'] }}</a>
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
<section class="py-2" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="row gy-4 gy-xl-0">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card ">
                <div class="accordion" id="accordionExample">
                       <ul class="mt-3 mb-3" style="list-style-type: none;">
                       {!! renderRTIMenuItems($menuItems,$web_slug) !!}
                       </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-6 col-12">
                <div class="mb-4">
                    <h1 class="h1 fw-bold text-primary">
                        {{$nav_mainpage->menutitle}}
                    </h2>
                </div>
                <p>{!! $nav_mainpage->content !!}</p>
            </div>
        </div>
    </div>
</section>


@else
<h4>News does not exist</h4>
@endif


<style>
.accordion-button.no-arrow::after {
    display: none;
}
/* Remove bullets from the first list item */
.nav-pills .nav-item:first-child {
    list-style: none;
}

/* If you want to remove bullets from all list items */
.nav-pills, .nav-pills .nav-item {
    list-style: none; /* Removes the default bullet points */
}

.nav-pills .nav-link {
    text-decoration: none; /* Ensures no default underline */
}


</style>
@include('user.includes.footer')