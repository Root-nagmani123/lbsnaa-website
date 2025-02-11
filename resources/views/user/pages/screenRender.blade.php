@include('user.includes.header')

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;"> @if(Cookie::get('language') ==
                                '2')घर
                                @else
                                Home
                                @endif</a>
                        </li>
                        <li class="breadcrumb-item active">
                            @if(Cookie::get('language') ==
                            '2')स्क्रीन रीडर एक्सेस
                            @else
                            Screen Reader Access
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-2" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
            <h3 class="fw-semibold fs-18 mb-0"> @if(Cookie::get('language') ==
                '2')स्क्रीन रीडर एक्सेस
                @else
                Screen Reader Access
                @endif</h3>
        </div>
        <div class="row">
            <!-- Dynamic Content -->
            <div class="col-md-12">
                <p>{{ $screenRender->heading ?? '' }}</p>
                <p>{{ $screenRender->title ?? '' }}</p>
                <p><?= $screenRender->description ?></p>
            </div>
        </div>
    </div>
</section>
@include('user.includes.footer')