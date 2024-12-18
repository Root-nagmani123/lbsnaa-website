@include('user.includes.header')

@if(isset($news))

<!-- Page Content -->
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
                            <a href="#" style="color: #af2910;">Academy News</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Academy News</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="container">
<div class="row">
    <div class="col-9"></div>
    <div class="col-3">
        <a href="" class="btn btn-outline-primary fw-semibold btn-sm" style="float: right">Archieve</a>
    </div>
</div>
</section>
<section class="py-6">
    <div class="container">

        <div class="row">
            @foreach($news as $slider)
            <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-3 d-flex align-items-stretch">
                <!-- Card -->
                <div class="card mb-4 shadow-lg card-lift" style="height:450px;width:400px;">
                    <div class="card-header" style="border:none;padding:0;">
                    <a href="#">
                        <!-- Img  -->
                        <img src="{{ isset($slider->main_image) || !empty($slider->main_image) ? asset($slider->main_image) : asset('assets/images/4.jpg') }}"
                            class="card-img-top" alt="blogpost " style="height:200px; object-fit: cover">
                    </a>
                    </div>
                    <!-- Card body -->
                    <div class="card-body d-flex flex-column" style=" height:200px; overflow-y:hidden;">
                        <a href="#"
                            class="fs-5 mb-2 fw-semibold d-block text-success">Posted On :- {{ \Carbon\Carbon::parse($slider->created_at)->format('d F, Y') }}</a>
                        <h3><a href="{{ route('user.newsbyslug', $slider->title_slug) }}" class="text-inherit">{{ $slider->title }}</a></h3>
                        <p>{{ $slider->short_description }}</p>
                        <!-- Media content -->
                    </div>
                    <div class="card-footer" style="border-top:none;height:50px;">
                    <a href="{{ route('user.newsbyslug', $slider->title_slug) }}" class="text-inherit text-primary" >Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center mt-4">
                <a href="#" class="btn btn-primary">
                    <div class="spinner-border spinner-border-sm me-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    Load More
                </a>
            </div> -->
        </div>
</section>


@else
<h4>News does not exist</h4>
@endif


@include('user.includes.footer')