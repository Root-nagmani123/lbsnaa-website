@include('user.includes.header')

@if(isset($news))

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
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="mb-6 mb-lg-8">
                    <h2 class="h1 fw-bold text-primary">
                        {{$news->title}}
                    </h2>
                    <p class="mb-0 lead">Posted On: {{date('d M, Y',strtotime($news->start_date))}}</p>
                </div>
            </div>
        </div>
        @if(count($news_images)> 0)
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12 gap-3">
                @foreach($news_images as $val)
                <img src="{{ asset($val) }}" style="height: 200px; object-fit: cover">

                @endforeach
            </div>
        </div>
        @endif
        <p><?= $news->description;?></p>
    </div>
</section>


@else
<h4>News does not exist</h4>
@endif


@include('user.includes.footer')