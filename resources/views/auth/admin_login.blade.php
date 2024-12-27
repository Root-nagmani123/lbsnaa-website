<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Your other links for stylesheets -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}">

    <title>LogIn | Lal Bahadur Shastri National Academy of Administration</title>

    <!-- reCAPTCHA v2 -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <div class="container-fluid" style="background-image: url({{ asset('admin_assets/images/background_img1.jpg') }}); background-repeat: no-repeat; background-size: cover;">
        <div class="main-content d-flex flex-column px-0">
            <div class="m-auto mw-510 py-5">
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="card bg-white border-0 rounded-10 mb-4" style="width: 500px;">
                        <div class="d-flex align-items-center gap-4 mb-3 justify-content-center border-bottom">
                            <a href="index.html">
                                <img src="{{ asset('admin_assets/images/logo.png')}}" alt="logo" width="300"
                                    style="padding: 20px; text-align: center;" class="img-fluid">
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group mb-4">
                                <label class="label">Email *</label>
                                <input type="email" name="email" class="form-control h-58" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="label">Password *</label>
                                <div class="password-wrapper position-relative">
                                    <input type="password" name="password" class="form-control h-58 text-dark" required>
                                </div>
                            </div>
                            
                            <!-- reCAPTCHA v2 checkbox -->
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITEKEY') }}"></div>
                            
                            <button type="submit" class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-100">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
