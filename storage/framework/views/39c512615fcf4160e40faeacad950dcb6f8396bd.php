<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Codescandy">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/favicon.ico')); ?>">

    <!-- CSS Assets -->
    <link href="<?php echo e(asset('assets/fonts/feather/feather.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/libs/simplebar/dist/simplebar.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/theme.min.css')); ?>">
    <link rel="canonical" href="LBSNAA">
    <link href="<?php echo e(asset('assets/libs/tiny-slider/dist/tiny-slider.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/glightbox/dist/css/glightbox.min.css')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('admin_assets/images/favicon.ico')); ?>">

    <title>Home | Lal Bahadur Shastri National Academy of Administration</title>
</head>

<body class="d-flex flex-column min-vh-100">
<header class="d-none d-lg-block sticky-top">
    <nav class="navbar navbar-expand-lg">
        <div class="container px-0">
            <a href="<?php echo e(route('home')); ?>" class="d-block text-decoration-none">
                <img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" alt="logo-icon" style="width: 300px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-default">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-default">
                <ul class="navbar-nav mx-auto">
                    <?php
                    $menus = DB::table('menus')
                        ->where('menu_status', 1)
                        ->where('is_deleted', 0)
                        ->where('txtpostion', 1)
                        ->where('parent_id', 0)
                        ->get();

                    function renderMenuItems($parentId)
                    {
                        $submenus = DB::table('menus')
                            ->where('menu_status', 1)
                            ->where('is_deleted', 0)
                            ->where('parent_id', $parentId)
                            ->get();

                        if ($submenus->isEmpty()) {
                            return '';
                        }

                        $output = '<ul class="dropdown-menu dropdown-menu-arrow">';
                        foreach ($submenus as $submenu) {
                            $hasChildren = DB::table('menus')
                                ->where('menu_status', 1)
                                ->where('is_deleted', 0)
                                ->where('parent_id', $submenu->id)
                                ->exists();

                            $output .= '<li class="dropdown-submenu dropend">';
                            $output .= '<a class="dropdown-item ' . ($hasChildren ? 'dropdown-toggle' : '') . '" href="' .
                                ($submenu->menutitle == 'RTI' ? '#' : route('user.navigationpagesbyslug', $submenu->menu_slug)) .
                                '" ' . ($hasChildren ? 'data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '') . '>' .
                                $submenu->menutitle . '</a>';

                            if ($hasChildren) {
                                $output .= renderMenuItems($submenu->id);
                            }

                            $output .= '</li>';
                        }
                        $output .= '</ul>';
                        return $output;
                    }
                    ?>

                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $hasChildren = DB::table('menus')->where('parent_id', $menu->id)->exists();
                    ?>
                    <li class="nav-item <?php echo e($hasChildren ? 'dropdown' : ''); ?>">
                        <a class="nav-link <?php echo e($hasChildren ? 'dropdown-toggle' : ''); ?>" 
                           href="<?php echo e($menu->menutitle == 'RTI' ? '#' : route('user.navigationpagesbyslug', $menu->menu_slug)); ?>" 
                           <?php echo e($hasChildren ? 'data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ''); ?>>
                            <?php echo e($menu->menutitle); ?>

                        </a>
                        <?php echo $hasChildren ? renderMenuItems($menu->id) : ''; ?>

                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </nav>
</header>


<?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/includes/header.blade.php ENDPATH**/ ?>