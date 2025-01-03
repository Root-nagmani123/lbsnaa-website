@include('user.pages.microsites.includes.header')

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Academy News</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-6">
    <div class="container-fluid">
    <div class="row">
        <div class="col-9"></div>
        <div class="col-3">
            <a href="" class="btn btn-outline-primary fw-semibold btn-sm" style="float: right">Archieve</a>
        </div>
    </div>
        <div class="row">
            @foreach($newsItems as $news)
            <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-3 d-flex align-items-stretch">
                <!-- Card -->
                <div class="card mb-4 shadow-lg card-lift">
                    <div class="card-header" style="border:none;padding:0;">
                        <a href="#">
                            <!-- Img  -->
                            <img src="{{ asset($news->main_image) }}" class="card-img-top" alt="blogpost ">
                        </a>
                    </div>
                    <!-- Card body -->
                    <div class="card-body d-flex flex-column">
                        <a href="#" class="fs-5 mb-2 fw-semibold d-block text-success">Posted On :-
                            {{ $news->created_at }}</a>
                        <h3><a href="blog-single.html" class="text-inherit">{{ $news->title }}</a></h3>
                        <p>{{ $news->meta_title }}</p>
                        <!-- Media content -->
                    </div>
                    <!-- <div class="card-footer" style="border-top:none;"> 
                        <a href="{{ route('news.details', $news->id) }}" class="text-inherit text-primary">Read More</a>
                    </div> -->
                    <div class="card-footer" style="border-top:none;">
                        <a href="{{ route('news.details', ['id' => $news->id, 'slug' => $news->research_centre_slug]) }}" class="text-inherit text-primary">Read More</a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
</section>

@include('user.pages.microsites.includes.footer')