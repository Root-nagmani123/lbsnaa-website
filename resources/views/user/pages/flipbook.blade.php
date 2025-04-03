@include('user.includes.header')
<link href="{{ asset('assets/libs/3dflipbooks/css/dflip.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/3dflipbooks/css/themify-icons.min.css')}}" rel="stylesheet" type="text/css"/>
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
                                @if (isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                    होम
                                @else
                                    Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @if (isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                            ई-पुस्तक
                            @else
                                Ebook
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
                        @if (isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                        ई-पुस्तक
                        @else
                        Ebook
                        @endif
                    </h3>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="default-table-area members-list">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="_df_book" height="600" webgl="true" backgroundcolor="#af2910" source="{{ asset($newsletter->pdf) }}" id="df_manual_book">
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   --}}
<script src="{{ asset('assets/libs/3dflipbooks/js/libs/three.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/libs/3dflipbooks/js/libs/compatibility.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/libs/3dflipbooks/js/libs/mockup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/libs/3dflipbooks/js/libs/pdf.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/libs/3dflipbooks/js/libs/pdf.worker.min.js') }}" type="text/javascript"></script>
<!-- Flipbook main Js file -->
<script src="{{ asset('assets/libs/3dflipbooks/js/dflip.min.js') }}" type="text/javascript"></script>


@include('user.includes.footer')
