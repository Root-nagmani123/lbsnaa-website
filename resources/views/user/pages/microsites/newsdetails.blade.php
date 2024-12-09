@include('user.pages.microsites.includes.header')
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
                        <li class="breadcrumb-item active" aria-current="page">{{$news->title}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="mb-6 mb-lg-8">
                    <!-- Display all images -->
                    <div class="row">
                        @if(!empty($news->multiple_images))
                        @foreach ($news->multiple_images as $image)
                        <div class="col-md-3 mb-2">
                            <img src="{{ asset($image) }}" style="object-fit: cover;" class="img-fluid">
                        </div>
                        @endforeach
                        @else
                        <p>No images available.</p>
                        @endif
                    </div>
                    <div class="py-4">
                    <p class="text-success fw-bold"><em>Posted On:</em> {{date('d M, Y',strtotime($news->start_date))}}</p>
                    <h2 class="h1 fw-bold text-primary">
                        {{$news->title}}
                    </h2>
        <p><?= $news->description ?></p>
        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<h4>News does not exist</h4>
@endif
@include('user.pages.microsites.includes.footer')