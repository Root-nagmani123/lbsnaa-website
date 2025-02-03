<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Your other links for stylesheets -->
    <link rel="stylesheet" href="<?php echo e(asset('admin_assets/css/style.css')); ?>">

    <title>LogIn | Lal Bahadur Shastri National Academy of Administration</title>

    <!-- reCAPTCHA v2 -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <div class="container-fluid" style="background-image: url(<?php echo e(asset('admin_assets/images/background_img1.jpg')); ?>); background-repeat: no-repeat; background-size: cover;">
        <div class="main-content d-flex flex-column px-0">
            <div class="m-auto mw-510 py-5">
                <form action="<?php echo e(route('admin.login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card bg-white border-0 rounded-10 mb-4" style="width: 500px;">
                        <div class="d-flex align-items-center gap-4 mb-3 justify-content-center border-bottom">
                            <a href="#!">
                                <img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" alt="logo" width="300"
                                    style="padding: 20px; text-align: center;" class="img-fluid">
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group mb-4">
                                <label class="label">Email *</label>
                                <input type="email" name="email" class="form-control h-58" required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group mb-4">
                                <label class="label">Password *</label>
                                <div class="password-wrapper position-relative">
                                    <input type="password" name="password" class="form-control h-58 text-dark" required>
                                </div>
                            </div>
                            
                            <!-- reCAPTCHA v2 checkbox -->
                           <div class="form-group mb-4">
                           <div class="g-recaptcha" data-sitekey="<?php echo e(env('RECAPTCHA_SITEKEY')); ?>"></div>
                           </div>
                            
                            <button type="submit" class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-100">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="<?php echo e(asset('admin_assets/js/bootstrap.bundle.min.js')); ?>"></script>
</body>

</html>
<?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/auth/admin_login.blade.php ENDPATH**/ ?>