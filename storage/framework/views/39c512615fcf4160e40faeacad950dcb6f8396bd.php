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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Home | Lal Bahadur Shastri National Academy of Administration</title>
</head>

<body class="d-flex flex-column min-vh-100 bg-white">
<div class="container-fluid">
            <ul class="nav justify-content-end py-1">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#news"><i
                            class="material-icons menu-icon">restart_alt</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="material-icons menu-icon">volume_up</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="material-icons menu-icon">accessible</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true"><i class="material-icons menu-icon">group</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true"><i class="material-icons menu-icon">search</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true"><i class="material-icons menu-icon">language</i></a>
                </li>
            </ul>
        </div>
        <nav class="navbar navbar-expand-lg shadow-none sticky-top">
            <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
                <!-- Logo -->
                <a href="<?php echo e(route('home')); ?>" class="navbar-brand me-auto logo d-flex align-items-center">
                    <img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" alt="logo-icon" class="img-fluid"
                        width="250">
                </a>

                <!-- Navbar Toggle Button (For mobile view) -->
                <div>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="icon-bar top-bar mt-0"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                    </button>
                </div>

                <!-- Navbar Menu -->
                <div class="collapse navbar-collapse ms-auto" id="navbar-default">
                    <ul class="navbar-nav mx-auto navmenu">
                        <?php
                        $menus = DB::table('menus')
                        ->where('menu_status', 1)
                        ->where('is_deleted', 0)
                        ->where('txtpostion', 1)
                        ->where('parent_id', 0)
                        ->get();

                        $Research_Center_list = DB::table('research_centres')
                        ->where('status', 1)
                        ->get();

                        function renderMenuItems($parentId, $isCourseOrTraining = false) {
                        $submenus = DB::table('menus')
                        ->where('menu_status', 1)
                        ->where('is_deleted', 0)
                        ->where('parent_id', $parentId)
                        ->get();

                        if ($submenus->isEmpty() && !$isCourseOrTraining) {
                        return '';
                        }

                        $output = '<ul class="dropdown-menu dropdown-menu-arrow">';

                            foreach ($submenus as $submenu) {
                            if ($submenu->menutitle === 'RTI') {
                            continue;
                            }
                            elseif($submenu->menutitle === 'research-centers'){
                            continue;
                            }

                            $hasChildren = DB::table('menus')
                            ->where('menu_status', 1)
                            ->where('is_deleted', 0)
                            ->where('parent_id', $submenu->id)
                            ->exists();

                            $output .= '<li class="dropdown-submenu dropend">';
                                $output .= '<a class="dropdown-item ' . ($hasChildren ? 'dropdown-toggle' : '') . '"
                                    href="' . route('user.navigationpagesbyslug', $submenu->menu_slug) . '" ' . 
                        ($hasChildren ? ' data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"' : '') . '>' .
                                    $submenu->menutitle . '</a>';

                                if ($hasChildren) {
                                $output .= renderMenuItems($submenu->id);
                                }

                                $output .= '</li>';
                            }

                            if ($isCourseOrTraining) {
                            $subcategories = DB::table('courses_sub_categories as sub')
                            ->leftJoin('courses_sub_categories as parent', 'sub.parent_id', '=', 'parent.id')
                            ->select('sub.*', 'parent.category_name as parent_category_name')
                            ->get();

                            $categoryTree = buildCategoryTree($subcategories);

                            foreach ($categoryTree as $category) {
                            $output .= '<li class="dropdown-submenu dropend">';
                                $output .= '<a class="dropdown-item dropdown-toggle"
                                    href="' . route('user.courseslug', $category['category']->slug) . '"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
                                    $category['category']->category_name . '</a>';
                                $output .= renderCourseTree($category['children']);
                                $output .= '</li>';
                            }
                            }

                            $output .= '</ul>';
                        return $output;
                        }

                        function buildCategoryTree($categories, $parentId = 0) {
                        $tree = [];
                        foreach ($categories as $category) {
                        if ($category->parent_id == $parentId) {
                        $children = buildCategoryTree($categories, $category->id);
                        $tree[] = ['category' => $category, 'children' => $children];
                        }
                        }
                        return $tree;
                        }

                        function renderCourseTree($tree) {
                        if (empty($tree)) {
                        return '';
                        }

                        $output = '<ul class="dropdown-menu dropdown-menu-arrow">';
                            foreach ($tree as $node) {
                            $output .= '<li>';
                                $output .= '<a class="dropdown-item"
                                    href="' . route('user.courseslug', $node['category']->slug) . '">' .
                                    htmlspecialchars($node['category']->category_name) . '</a>';
                                if (!empty($node['children'])) {
                                $output .= renderCourseTree($node['children']);
                                }
                                $output .= '</li>';
                            }
                            $output .= '</ul>';

                        return $output;
                        }
                        ?>

                        <!-- Navbar Menu Items -->
                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($menu->menutitle === 'RTI'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('user.get_rti_page', $menu->menu_slug)); ?>">
                                <?php echo e($menu->menutitle); ?>

                            </a>
                        </li>
                        <?php elseif($menu->menutitle === 'Research Centers'): ?>
                        <li
                            class="nav-item <?php echo e(DB::table('menus')->where('parent_id', $menu->id)->exists() || $menu->menutitle === 'Training' ? 'dropdown' : ''); ?>">
                            <a class="nav-link <?php echo e(DB::table('menus')->where('parent_id', $menu->id)->exists() || $menu->menutitle === 'Training' ? 'dropdown-toggle' : ''); ?>"
                                href="<?php echo e($menu->menutitle === 'Training' ? '#' : route('user.navigationpagesbyslug', $menu->menu_slug)); ?>"
                                <?php echo e(DB::table('menus')->where('parent_id', $menu->id)->exists() || $menu->menutitle === 'Training' ? 'data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ''); ?>>
                                <?php echo e($menu->menutitle); ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-arrow">
                                <?php $__currentLoopData = $Research_Center_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserch_c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="dropdown-item"
                                        href="<?php echo e(url('lbsnaa-sub')); ?>?slug=<?php echo e($reserch_c->research_centre_slug); ?>">
                                        <?php echo e($reserch_c->research_centre_name); ?>

                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li
                            class="nav-item <?php echo e(DB::table('menus')->where('parent_id', $menu->id)->exists() || $menu->menutitle === 'Training' ? 'dropdown' : ''); ?>">
                            <a class="nav-link <?php echo e(DB::table('menus')->where('parent_id', $menu->id)->exists() || $menu->menutitle === 'Training' ? 'dropdown-toggle' : ''); ?>"
                                href="<?php echo e($menu->menutitle === 'Training' ? '#' : route('user.navigationpagesbyslug', $menu->menu_slug)); ?>"
                                <?php echo e(DB::table('menus')->where('parent_id', $menu->id)->exists() || $menu->menutitle === 'Training' ? 'data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ''); ?>>
                                <?php echo e($menu->menutitle); ?>

                            </a>
                            <?php echo renderMenuItems($menu->id, $menu->menutitle === 'Training'); ?>

                        </li>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </nav>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdowns = document.querySelectorAll('.dropdown-submenu');

        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('mouseover', function() {
                const menu = this.querySelector('.dropdown-menu');
                if (menu) {
                    const rect = menu.getBoundingClientRect();
                    if (rect.right > window.innerWidth) {
                        menu.classList.add('drop-left'); // Add class to open left
                    } else {
                        menu.classList.remove('drop-left'); // Remove if not overflowing
                    }
                }
            });
        });
    });
    </script><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/includes/header.blade.php ENDPATH**/ ?>