<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('public/admin_assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin_assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin_assets/css/sidebar-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin_assets/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin_assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin_assets/css/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin_assets/css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin_assets/css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin_assets/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin_assets/css/style.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('public/admin_assets/images/favicon.ico') }}">

    <title>LogIn | Lal Bahadur Shastri National Academy of Administration</title>
</head>

<body>

    <div class="preloader" id="preloader">
        <div class="preloader">
            <div class="waviy position-relative">
                <span class="d-inline-block">L</span>
                <span class="d-inline-block">B</span>
                <span class="d-inline-block">S</span>
                <span class="d-inline-block">N</span>
                <span class="d-inline-block">A</span>
                <span class="d-inline-block">A</span>
            </div>
        </div>
    </div>


    <div class="container-fluid"
        style="background-image: url({{ asset('public/admin_assets/images/background_img1') }}); background-repeat: no-repeat; background-size: cover;">
        <div class="main-content d-flex flex-column px-0">

            <div class="m-auto mw-510 py-5">
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <h4 class="fs-3 mb-3 text-center" style="color: #af2910;">LBSNAA Administration</h4>
                    <div class="card bg-white border-0 rounded-10 mb-4" style="width: 500px;">
                        <div class="d-flex align-items-center gap-4 mb-3">
                            <a href="index.html">
                                <img src="{{ asset('public/admin_assets/images/logo.png')}}" alt="logo" width="300"
                                    style="padding: 20px; text-align: center;" class="img-fluid">
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group mb-4">
                                <label class="label">Email</label>
                                <input type="email" name="email" class="form-control h-58"
                                    placeholder="envytheme@info.com" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label class="label">Password</label>
                                <div class="password-wrapper position-relative">
                                    <input type="password" name="password" class="form-control h-58 text-dark" required>
                                    <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;"
                                        class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute"
                                        aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="d-sm-flex justify-content-between mb-4 py-3">
                                <a href="forget-password.html"
                                    class="fs-16 text-primary text-decoration-none mt-2 mt-sm-0 d-block">
                                    Forgot your password?
                                </a>
                            </div>
                            <button type="submit"
                                class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-100">
                                Login
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>


    <script src="{{ asset('public/admin_assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/dragdrop.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/rangeslider.min.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/quill.min.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/data-table.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/prism.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/fslightbox.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/custom/custom.js') }}"></script>
</body>

</html>