<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Codescandy">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">

    <!-- CSS Assets -->
    <link href="{{ asset('assets/fonts/feather/feather.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link rel="canonical" href="LBSNAA">
    <link href="{{ asset('assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/dist/css/glightbox.min.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('admin_assets/images/favicon.ico') }}">

    <title>Home | Lal Bahadur Shastri National Academy of Administration</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header class="d-none d-lg-block sticky-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container px-0">
                <a href="{{ route('home') }}" class="d-block text-decoration-none">
                    <img src="{{ asset('admin_assets/images/logo.png') }}" alt="logo-icon" style="width: 300px;">
                </a>
                <!-- Button -->

    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="navbar-default">
        <ul class="navbar-nav mx-auto">
        @php
    $menus = DB::table('menus')
        ->where('menu_status', 1)
        ->where('is_deleted', 0)
        ->where('txtpostion', 1)
        ->where('parent_id', 0)
        ->get();

    function renderMenuItems($parentId, $isTraining = false) {
        // Fetch child menus
        $submenus = DB::table('menus')
            ->where('menu_status', 1)
            ->where('is_deleted', 0)
            ->where('parent_id', $parentId)
            ->get();

        if ($submenus->isEmpty() && !$isTraining) {
            return '';
        }

        $output = '<ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end">';

        foreach ($submenus as $submenu) {
            $hasChildren = DB::table('menus')
                ->where('menu_status', 1)
                ->where('is_deleted', 0)
                ->where('parent_id', $submenu->id)
                ->exists();

            $output .= '<li class="nav-item ' . ($hasChildren ? 'dropdown' : '') . '">';
            $output .= '<a class="nav-link ' . ($hasChildren ? 'dropdown-toggle' : '') . '" 
                href="' . 
                ($submenu->menutitle == 'RTI' ? '#' : route('user.navigationpagesbyslug', $submenu->menu_slug)) . '" ' . 
                ($hasChildren ? 'data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '') . '>' 
                . $submenu->menutitle . '</a>';

            if ($hasChildren) {
                $output .= renderMenuItems($submenu->id);
            }

            $output .= '</li>';
        }

        if ($isTraining) {
            // Replace Course Tree with a direct list of courses and subcourses
            $subcategories = DB::table('courses_sub_categories as sub')
                ->leftJoin('courses_sub_categories as parent', 'sub.parent_id', '=', 'parent.id')
                ->select('sub.*', 'parent.category_name as parent_category_name')
                ->get();

            $categoryTree = buildCategoryTree($subcategories);

            foreach ($categoryTree as $category) {
                $output .= '<li class="nav-item dropdown">';
                $output .= '<a class="nav-link dropdown-toggle" href="' .route('user.courseslug', $category['category']->slug)  . '" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $category['category']->category_name . '</a>';
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
$output .= '<a class="dropdown-item" href="' .route('user.courseslug', $node['category']->slug) . '">' . htmlspecialchars($node['category']->category_name) . '</a>';
if (!empty($node['children'])) {
    $output .= renderCourseTree($node['children']);
}
$output .= '</li>';

        }
        $output .= '</ul>';

        return $output;
    }
@endphp

<ul class="navbar-nav mx-auto">
@foreach($menus as $menu)
    <li class="nav-item {{ DB::table('menus')->where('parent_id', $menu->id)->exists() && $menu->menutitle != 'RTI' ? 'dropdown' : '' }} ">
        <a class="nav-link {{ $menu->menutitle == 'RTI' ? '' : 'dropdown-toggle' }} 
           {{ DB::table('menus')->where('parent_id', $menu->id)->exists() && $menu->menutitle != 'RTI' ? 'dropdown-toggle' : '' }}"
           href="{{ $menu->menutitle == 'RTI' ? route('user.navigationpagesbyslug', $menu->menu_slug) : route('user.navigationpagesbyslug', $menu->menu_slug) }}"
           id="navbarListing"
           {{ DB::table('menus')->where('parent_id', $menu->id)->exists() && $menu->menutitle != 'RTI' ? 'data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '' }}>
            {{ $menu->menutitle }}
        </a>

        {!! renderMenuItems($menu->id, $menu->menutitle === 'Training') !!}
    </li>
@endforeach

</ul>

    </div>
</div>


        </nav>
    </header>