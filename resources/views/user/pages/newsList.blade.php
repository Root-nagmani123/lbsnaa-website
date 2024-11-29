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
                        <li class="breadcrumb-item active" aria-current="page">dd</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-1">
    <div class="container">
       
                    <div class="row">
                        @foreach($news as $slider)
                        <div class="col-4">
                            <!-- card -->
                            <div class="card mb-4 card-hover">
                                <!-- img -->
                                <div>
                                <a href="#">
                                                    <img
                                                        src="{{ isset($slider->main_image) || !empty($slider->main_image) ? asset($slider->main_image) : asset('assets/images/4.jpg') }}"
                                                        alt=""
                                                        class="img-fluid rounded-3 w-100"
                                                    >
                                                </a>
                                </div>
                                <!-- card body -->
                                <div class="card-body pt-2">
                                                    <h3><a class="text-inherit" href="#">{{ $slider->title }}</a></h3>
                                                    <p>{{ $slider->short_description }}</p>
                                                    <small>Posted On: {{ \Carbon\Carbon::parse($slider->created_at)->format('d F, Y') }}</small>
                                                    <br><br>
                                                    <a href="{{ route('user.newsbyslug', $slider->title_slug) }}"
                                                        class="icon-link icon-link-hover link-primary fw-semibold">
                                                        <span>View Details</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            fill="currentColor" class="bi bi-arrow-right"
                                                            viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                            </div>
                        </div>
                        @endforeach
                   
        <p></p>
    </div>
</section>


@else
<h4>News does not exist</h4>
@endif


@include('user.includes.footer')