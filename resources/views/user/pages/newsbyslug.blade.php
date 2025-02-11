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
                            <a href="{{ route('home')}}" style="color: #af2910;">
                                @if(Cookie::get('language') ==
                                '2')घर
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">
                                @if(Cookie::get('language') ==
                                '2')अकादमी समाचार
                                @else
                                Academy News
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$news->title}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-1" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="mb-6 mb-lg-8">
                    <h4 class="fw-bold text-primary">
                        {{$news->title}}
                    </h4>
                    <small class="fs-5 mb-2 fw-semibold d-block" style="color:#007A33;">Posted On: {{date('d M, Y',strtotime($news->start_date))}}</small>
                </div>
            </div>
        </div>
        @if(count($news_images)> 0)
        <div class="row">

            @foreach($news_images as $val)
            <div class="col-md-3 col-12 gap-3 mb-4">
                <a href="{{ asset($val) }}" data-fancybox="gallery" data-caption="&times;"
                    data-caption-position="top-right" data-caption-class="fancybox-caption-close">
                    <img src="{{ asset($val) }}" style="height: 200px; object-fit: cover; width: 100%;"
                        class="img-fluid rounded-4" alt="{{$news->title}}">
                </a>
            </div>
            @endforeach


        </div>
        @endif
        <p class="lead mb-2"><?= $news->description;?></p>
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
<link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>

<script>
$(document).ready(function() {
    Fancybox.bind('[data-fancybox="gallery"]', {
        Toolbar: {
            display: ["close"], // Add close button in the toolbar
        },
        closeButton: "outside", // Optional: Position the close button outside the image
    });
});
</script>
@include('user.includes.footer')