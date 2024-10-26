<h1>This is News pages</h1>
<h3></h3>
<p>{{$news->description}}</p>
<!-- 
@if(isset($news))
    <section class="py-4">
        <div class="container">
            <div class="row align-items-center pb-lg-2">
                    <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb p-2">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #af2910;">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #af2910;">Academy News</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">18th round of Mid-Career Training Programme for IAS Officers, Phase-IV</li>
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
                        <h2 class="h1 fw-bold text-primary">
                        {{$news->title}}
                        </h2>
                        <p class="mb-0 lead">Posted On: {{$news->start_date}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach($news->multiple_images as $image)
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="card mb-4 card-hover border">
                        <a href="#!">
                            <img src="{{ asset('assets/images/user/newsbyslug/' . $image) }}" alt="writing" class="img-fluid w-100 rounded-top-3">
                        </a>
                    </div>
                </div>
            @endforeach
            </div>
            <p>{{$news->description}}</p>
        </div>
    </section>

@else
    <h4>News does not exist</h4>
@endif -->
