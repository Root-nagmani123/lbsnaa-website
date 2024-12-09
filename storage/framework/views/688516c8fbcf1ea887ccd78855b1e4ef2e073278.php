<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Codescandy">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/favicon.ico')); ?>">

  <!-- darkmode js -->
  <script src="<?php echo e(asset('assets/js/vendors/darkMode.js')); ?>"></script>

  <!-- Libs CSS -->
  <link href="<?php echo e(asset('assets/fonts/feather/feather.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/libs/simplebar/dist/simplebar.min.css')); ?>" rel="stylesheet">

  <!-- Theme CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/theme.min.css')); ?>">

  <link rel="canonical" href="LBSNAA">
  <link href="<?php echo e(asset('assets/libs/tiny-slider/dist/tiny-slider.css')); ?>" rel="stylesheet">
  <link rel="stylesheet" href="assets/libs/glightbox/dist/css/glightbox.min.css') }}">
  <link rel="icon" type="image/png" href="<?php echo e(asset('admin_assets/images/favicon.ico')); ?>">

  <title>Research Center | Lal Bahadur Shastri National Academy of Administration</title>

</head>

<body class="d-flex flex-column min-vh-100">
<header class="d-none d-lg-block sticky-top">
    <nav class="navbar">
        <div class="container px-0">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('assets/images/microsites/logo.png')); ?>"
                    alt="logo" width="300"></a>
            <!-- Button -->
            <a class="navbar-brand" href="#"><img src="<?php echo e(asset('assets/images/microsites/crs.jpg')); ?>"
                    alt="logo" width="500"></a>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg">

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbar-default">
            <ul class="navbar-nav mx-auto">
                <?php
                    $menus = DB::table('micromenus')
                        ->where('menu_status', 1)
                        ->where('is_deleted', 0)
                        ->where('parent_id', 0)
                        ->get();
                ?>

                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $arrow = DB::table('micromenus')
                            ->where('menu_status', 1)
                            ->where('is_deleted', 0)
                            ->where('parent_id', $menu->id)
                            ->exists();
                        $class = $arrow ? 'nav-link dropdown-toggle' : 'nav-link';
                    ?>
                    <li class="nav-item dropdown">
                        <a class="<?php echo e($class); ?>"
                            href="<?php echo e($menu->menutitle == 'Research Center' ? '#' : route('user.navigationmenubyslug', $menu->menu_slug)); ?>"
                            <?php echo e($arrow ? 'data-bs-toggle=dropdown aria-haspopup=true aria-expanded=false' : ''); ?>>
                            <?php echo e($menu->menutitle); ?>

                        </a>
                        <?php echo renderMicroMenuItems($menu->id); ?>

                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>

    </nav>
</header>
<?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/microsites/includes/header.blade.php ENDPATH**/ ?>