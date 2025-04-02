@include('user.includes.header')
<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-light rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">
                                @if ($_COOKIE['language'] == '2')
                                    होम
                                @else
                                    Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @if ($_COOKIE['language'] == '2')
                                संकाय
                            @else
                                Newsletter
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card bg-white border-0 rounded-10 mb-4" id="skip_to_main_content">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
                    <h3 class="fw-semibold fs-18 mb-0">
                        @if ($_COOKIE['language'] == '2')
                            इनहाउस फैकल्टी
                        @else
                            Newsletter
                        @endif
                    </h3>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="default-table-area members-list">
                    <div class="row">
                        @if ($newsletters)
                            @foreach ($newsletters as $val)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                                    <div class="card p-2 bg-light rounded-10 shadow-sm">
                                        <div class="content-with-images">
                                            <div class="images-container">
                                                <img src="{{ asset($val?->images) }}"
                                                    alt="Image" class="img-fluid rounded-10 mb-3"
                                                    style="width: 100vw; height: 17vw;" />
                                            </div>

                                            <p>{{ $val?->title }}</p>
                                            <div class="content d-flex justify-content-between">

                                                <a href="{{ asset($val?->pdf) }}"
                                                    class="btn btn-primary mt-3" target="_blank">
                                                    @if ($_COOKIE['language'] == '2')
                                                        डाउनलोड
                                                    @else
                                                        View PDF
                                                    @endif
                                                </a>

                                                <a href="{{ asset($val?->ebook) }}"
                                                    class="btn btn-primary mt-3 ms-auto" target="_blank">
                                                    @if ($_COOKIE['language'] == '2')
                                                        डाउनलोड
                                                    @else
                                                        View E-Book
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">No Newsletter Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@include('user.includes.footer')
