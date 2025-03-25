<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon icon-->
    <link rel="icon" type="image/png" href="{{ asset('admin_assets/images/favicon.ico') }}">

    <!-- darkmode js -->
    <script src="../assets/js/vendors/darkMode.js"></script>

    <!-- Libs CSS -->
    <link href="{{ asset('assets/fonts/feather/feather.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet" />


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">

    <link rel="canonical" href="https://geeksui.codescandy.com/geeks/pages/404-error.html" />
    <title>419 Error | Lal Bahadur Shastri National Academy of Administration</title>
</head>

<body class="bg-white">
    <!-- Page Content -->
    <main>
        <section class="container d-flex flex-column vh-100">
            <div class="row">
                <div class="col-xl-10 col-md-12 col-12">
                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <a href="{{ route('home') }}"><img src="{{ asset('admin_assets/images/logo.png') }}" alt="logo"
                                class="logo-inverse img-fluid"
                                aria-label="Logo of Lal Bahadur Shastri National Academy of Administration"
                                width="350px" /></a>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center g-0 h-lg-100 py-10">
                <!-- Docs -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center text-lg-start">
                    <div class="d-flex flex-column gap-5">
                        <div class="d-flex flex-column gap-3">
                            <h1 class="display-1 mb-0">Sorry! Error 419 - Page Expired</h1>

                            <p class="mb-0 lead px-4 px-md-0">
                            Your session / token has expired. Please refresh the page and try again.
                            </p>
                            <ul>
                                <li>Go to our <a href="{{ route('home') }}" class="btn-link">Home page</a> and browse
                                    through our topics for the information you want.</li>
                                <li>Go to our <a href="{{ url()->previous() }}" class="btn-link">previous page</a> and browse through our topics for the information you want.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center py-4">
                <!-- Desc -->
                <div class="col-lg-9 col-md-9 col-12">
                    <span>
                        ©
                        <span id="copyright4">
                            <script>
                            document.getElementById("copyright4").appendChild(document.createTextNode(new Date()
                                .getFullYear()));
                            </script>
                        </span>
                        <span>
                            @if(Cookie::get('language') == '2')
                            लाल बहादुर शास्त्री राष्ट्रीय प्रशासन अकादमी मसूरी, भारत सरकार। सर्वाधिकार सुरक्षित
                            @else
                            Lal Bahadur Shastri National Academy of Administration Mussoorie,Govt of India. All Right
                            Reserved
                            @endif

                        </span>
                </div>

                <!-- Links -->
                <div class="col-lg-3 col-md-12 col-12 d-lg-flex justify-content-end">
                    <div>
                        @php
                        $social_media_links = DB::table('social_media_links')->get();
                        @endphp
                        <!--Facebook-->
                        <a href="{{ $social_media_links[0]->facebook_url; }}" class="me-2" target="_blank"
                            aria-label="Facebook">
                            <i class="bi bi-facebook fa-2x" style="color: #af2910;"></i>
                        </a>
                        <!--Twitter-->
                        <a href="{{ $social_media_links[0]->twitter_url; }}" class="me-2" target="_blank"
                            aria-label="Twitter">
                            <i class="bi bi-twitter-x" style="color: #af2910;"></i>
                        </a>

                        <!--GitHub-->
                        <a href="{{ $social_media_links[0]->youtube_url; }}" class="me-2" target="_blank"
                            aria-label="Youtube">
                            <i class="bi bi-youtube" style="color:#af2910;"></i>
                        </a>
                        <a href="{{ $social_media_links[0]->linkedin_url; }}" class="me-2" target="_blank"
                            aria-label="Linkedin">
                            <i class="bi bi-linkedin" style="color:#af2910;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Scripts -->
    <!-- Libs JS -->
    <script src="../assets/libs/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

</body>

</html>