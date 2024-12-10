@include('user.includes.header')

@if(isset($nav_page))

<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Home link -->
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Home</a>
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
    <div class="container">
        <div class="row gy-4 gy-xl-0">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Accordion Card</h5>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            <!-- Main Accordion Item -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        LBSNAA Newsletter
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Explore various sections of the LBSNAA Newsletter:</p>
                                        <!-- Nested Accordion -->
                                        <div class="accordion" id="nestedAccordion">
                                            <!-- Nested Item 1 -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="nestedHeadingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#nestedCollapseOne"
                                                        aria-expanded="false" aria-controls="nestedCollapseOne">
                                                        About LBSNAA
                                                    </button>
                                                </h2>
                                                <div id="nestedCollapseOne" class="accordion-collapse collapse"
                                                    aria-labelledby="nestedHeadingOne"
                                                    data-bs-parent="#nestedAccordion">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            <li><a href="#">Mission Statement</a></li>
                                                            <li><a href="#">Academy Song</a></li>
                                                            <li><a href="#">Campuses</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Nested Item 2 -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="nestedHeadingTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#nestedCollapseTwo"
                                                        aria-expanded="false" aria-controls="nestedCollapseTwo">
                                                        Life at Academy
                                                    </button>
                                                </h2>
                                                <div id="nestedCollapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="nestedHeadingTwo"
                                                    data-bs-parent="#nestedAccordion">
                                                    <div class="accordion-body">
                                                        <p>Discover what life at the academy is like.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of Nested Accordion -->
                                    </div>
                                </div>
                            </div>
                            <!-- Other Main Accordion Items -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Digital Learning Framework
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Explore the various initiatives under the Digital Learning Framework.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-6 col-12">
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
<h4>News does not exist</h4>
@endif


@include('user.includes.footer')