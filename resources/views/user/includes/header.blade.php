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
    <link rel="icon" type="image/png" href="{{ asset('admin_assets/images/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="{{ asset('assets/js/orgchart.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>
        @if(isset($title))
        {{ $title }} | Lal Bahadur Shastri National Academy of Administration
        @endif
    </title>
    <style>
    *:focus {
        outline: 2px solid #af2910;
        /* High-contrast green */
        outline-offset: 2px;
    }

    .slider-caption {
        position: absolute;
        z-index: 1000;
        width: 100%;
        height: 100%;
        background: rgba(175, 11, 16, 0.5);
        color: #fff;
        font-weight: 600;
        font-size: 100%;
        line-height: 135%;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .logo {
        width: 350px;
    }


    @media (max-width: 768px) {
        .bar {
            display: none;
        }

        .logo {
            width: 250px;
        }
    }

    .dropdown-menu {
        white-space: normal;
        /* Allow text to wrap */
        word-wrap: break-word;
        /* Break long words onto the next line */
        max-width: 450px;
        /* Optional: Set a maximum width for better readability */
    }

    .dropdown-item {
        white-space: normal;
        /* Allow text wrapping inside menu items */
        word-wrap: break-word;
        /* Ensure long words wrap properly */
    }

    .navbar-nav .nav-link:focus,
    .navbar-nav .dropdown-item:focus {
        outline: 2px solid #af2910 !important;
        /* High-contrast green */
        outline-offset: 2px;
        box-shadow: 0 0 5px rgba(211, 4, 49, 0.75);
        /* Optional for extra visibility */
    }

    .dropdown-toggle:focus,
    .dropdown-item:focus {
        outline: 2px solid #af2910 !important;
        outline-offset: 2px;
    }

    .navbar {
        overflow: visible !important;
    }

    .btn-scroll-top:focus {
        outline: 2px solid #af2910 !important;
        outline-offset: 2px;
        box-shadow: 0 0 5px rgba(211, 4, 49, 0.75);
        /* Optional for extra visibility */
    }

    /* Ensure dropdown opens on hover */
    .navbar-nav .dropdown:hover>.dropdown-menu,
    .navbar-nav .dropdown:focus-within>.dropdown-menu {
        display: block;
        visibility: visible;
        opacity: 1;
    }

    /* Ensure nested dropdowns also open on hover and keyboard focus */
    .dropdown-submenu:hover>.dropdown-menu,
    .dropdown-submenu:focus-within>.dropdown-menu {
        display: block;
        visibility: visible;
        opacity: 1;
        left: 30%;
        top: 0;
        margin-top: -1px;
    }

    #playPauseBtn {
        position: absolute;
        bottom: 1%;
        right: 15px;
        transform: translateY(-5%);
        z-index: 10;
        opacity: 0.8;
    }

    /* Hide navigation arrows by default */
    .carousel-control-prev,
    .carousel-control-next {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    /* Show navigation arrows only on hover */
    #carouselExampleCaptions:hover .carousel-control-prev,
    #carouselExampleCaptions:hover .carousel-control-next {
        opacity: 1;
    }

    #marqueeWrapper {
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }

    #marqueeContainer {
        display: inline-flex;
        white-space: nowrap;
        will-change: transform;
    }

    #marqueeWrapper {
        overflow: hidden;
        position: relative;
    }

    #marqueeContainer {
        display: flex;
        gap: 3px;
        flex-nowrap: nowrap;
        align-items: center;
        animation: marquee 50s linear infinite;
        will-change: transform;
        /* Helps with smoother animations */
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .paused {
        animation-play-state: paused;
    }

    .custom-dropdown {
        left: 0 !important;
        right: auto !important;
        transform: translateX(-85%) !important;
        /* Ensures dropdown always opens to the left */
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-white" style="overflow-x: hidden">
    <div class="container-fluid bg-light bar">
        <div class="row py-1 align-items-center">
            <div class="col-md-6 d-flex align-items-center" style="font-size: 16px;font-weight:400;color:#af2910;">
                <img class="img-fluid" src="{{ asset('assets/images/icons/ashok.jpg') }}" alt="Logo of Ashok Stambh"
                    aria-label="Logo of Ashoka Stambh" style="font-size: 510px;height: 50px;margin-right:5px;">
                भारत सरकार | Government of India
            </div>
            <div class="col-md-6">
                <ul class="nav justify-content-end align-items-center">
                    <!-- Tooltip Items -->
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#skip_to_main_content" data-bs-toggle="tooltip"
                            data-bs-placement="bottom"title="@if($_COOKIE['language'] == '2')मुख्य सामग्री पर जाएं @else Skip to main content @endif"
                            aria-label="@if($_COOKIE['language'] == '2')मुख्य सामग्री पर जाएं @else Skip to main content @endif">
                            <img src="{{ asset('assets/images/skip_to_main_content.png') }}" alt="skip to main content"
                                style="height: 30px;">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.screen-reader') }}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="@if($_COOKIE['language'] == '2')स्क्रीन रीडर @else Screen Reader @endif"
                            aria-label="@if($_COOKIE['language'] == '2')स्क्रीन रीडर @else Screen Reader @endif">
                            <img src="{{ asset('assets/images/screenreadeer.png') }}" alt="screen reader"
                                style="height: 30px;">
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"
                        title="@if($_COOKIE['language'] == '2')सुलभता @else Accessibility @endif"
                        aria-label="@if($_COOKIE['language'] == '2')विस्तारित सुलभता मेनू @else Expanded accessibility menu @endif">
                        <img src="{{ asset('assets/images/Accessibility (2).png') }}" 
                            alt="@if($_COOKIE['language'] == '2')सुलभता @else Accessibility @endif"
                            style="height: 30px;">
                    </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="set_font_size('increase')"
                                    title="Increase font size" aria-label="Increase font size">A<sup>+</sup></a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="set_font_size('')"
                                    title="Reset font size" aria-label="Reset font size">A</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="set_font_size('decrease')"
                                    title="Decrease font size" aria-label="Decrease font size">A<sup>-</sup></a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="@if($_COOKIE['language'] == '2')सोशल मीडिया लिंक @else Social Media Links @endif"
                            aria-label="@if($_COOKIE['language'] == '2')विस्तारित सोशल मीडिया लिंक @else Expanded Social Media Links @endif">
                            <img src="{{ asset('assets/images/social_group.png') }}" 
                                alt="@if($_COOKIE['language'] == '2')सोशल मीडिया लिंक @else Social Media Links @endif"
                                style="height: 30px;">
                        </a>

                        @php
                        $social_media_links = DB::table('social_media_links')->get();
                        @endphp
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ $social_media_links[0]->facebook_url }}" class="dropdown-item"
                                    target="_blank" title="Facebook" aria-label="Facebook">
                                    <i class="bi bi-facebook fa-2x" style="color: #af2910;"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $social_media_links[0]->twitter_url }}" class="dropdown-item"
                                    target="_blank" title="Twitter" aria-label="Twitter">
                                    <i class="bi bi-twitter-x" style="color: #af2910;"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $social_media_links[0]->youtube_url }}" class="dropdown-item"
                                    target="_blank" title="YouTube" aria-label="YouTube">
                                    <i class="bi bi-youtube" style="color:#af2910;"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $social_media_links[0]->linkedin_url }}" class="dropdown-item"
                                    target="_blank" title="LinkedIn" aria-label="LinkedIn">
                                    <i class="bi bi-linkedin" style="color:#af2910;"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.sitemap') }}" data-bs-toggle="tooltip"
                        data-bs-placement="bottom"
                        title="@if($_COOKIE['language'] == '2')साइटमैप @else Sitemap @endif"
                        aria-label="@if($_COOKIE['language'] == '2')साइटमैप @else Sitemap @endif">
                        <img src="{{ asset('assets/images/sitemap.png') }}" 
                            alt="@if($_COOKIE['language'] == '2')साइटमैप @else Sitemap @endif"
                            style="height: 30px;">
                    </a>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false"
                            data-bs-display="static">
                            <img src="{{ asset('assets/images/search.png') }}" alt="search" style="height: 30px;">
                        </a>
                        <div class="dropdown-menu p-2 custom-dropdown" style="width: 250px;">
                        <form action="https://www.google.com/search" method="GET" target="_blank">
                        <input type="text" name="q" class="form-control mb-2" 
                            placeholder="{{ $_COOKIE['language'] == '2' ? 'खोजें...' : 'Search...' }}" required>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="searchType" value="web" id="searchWeb">
                            <label class="form-check-label" for="searchWeb">
                                {{ $_COOKIE['language'] == '2' ? 'वेब' : 'The Web' }}
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm w-100 mt-2">
                            {{ $_COOKIE['language'] == '2' ? 'खोजें' : 'Search' }}
                        </button>
                    </form>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                            data-bs-offset="10,20" aria-label="Language">
                            <img src="{{ asset('assets/images/language.png') }}" alt="language" style="height: 30px;">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item set-language" data-lang="1" href="{{ route('set.language', 1) }}" aria-label="English">English</a></li>
                            <li><a class="dropdown-item set-language" data-lang="2" href="{{ route('set.language', 2) }}" aria-label="Hindi">Hindi</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <nav class="navbar navbar-expand-lg shadow-none">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <h1><a href="{{ route('home') }}" class="navbar-brand me-auto logo d-flex align-items-center">
                    <img src="{{ asset('admin_assets/images/logo.png') }}" alt="logo-icon" class="img-fluid logo"
                        aria-label="Logo of Lal Bahadur Shastri National Academy of Administration">
                </a></h1>

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
            <div class="collapse navbar-collapse" id="navbar-default">
                <ul class="navbar-nav ms-auto navmenu">
                    @php
                    $language = $_COOKIE['language'];
                    $menus = DB::table('menus')
                    ->where('menu_status', 1)
                    ->where('is_deleted', 0)
                    ->where('txtpostion', 1)
                    ->where('parent_id', 0)
                    ->when($language == 2, function ($query) use ($language) {
                    return $query->where('language', '2');
                    })
                    ->when($language == 1, function ($query) use ($language) {
                    return $query->where('language', '1');
                    })

                    ->get();

                    $Research_Center_list = DB::table('research_centres')
                    ->where('status', 1)
                    ->when($language == 2 || $language == 1, function ($query) use ($language) {
                        return $query->where('language', $language);
                    })
                    ->get();

                    function renderMenuItems($parentId, $isCourseOrTraining = false) {
                    $language = $_COOKIE['language'];
                    $submenus = DB::table('menus')
                    ->where('menu_status', 1)
                    ->where('is_deleted', 0)
                    ->where('parent_id', $parentId)
                    ->when($language == 2, function ($query) use ($language) {
                    return $query->where('language', '2');
                    })
                    ->when($language == 1, function ($query) use ($language) {
                    return $query->where('language', '1');
                    })
                    ->get();

                    if ($submenus->isEmpty() && !$isCourseOrTraining) {
                    return '';
                    }

                    $output = '<ul class="dropdown-menu">';

                        foreach ($submenus as $submenu) {
                        if ($submenu->menutitle === 'RTI' || $submenu->menutitle === 'research-centers') {
                        continue;
                        }

                        $hasChildren = DB::table('menus')
                        ->where('menu_status', 1)
                        ->where('is_deleted', 0)
                        ->where('parent_id', $submenu->id)
                        ->when($language == 2, function ($query) use ($language) {
                        return $query->where('language', '2');
                        })
                        ->when($language == 1, function ($query) use ($language) {
                        return $query->where('language', '1');
                        })
                        ->exists();

                        // Add 'w-100' class to ensure full width for the list item
                        if($submenu->texttype == 3){
                        $output .= '<li class="check dropdown-submenu dynamic-direction w-100 border-bottom">';

                            $url = '';
                            if ($submenu->web_site_target == 1) {
                            // Internal link
                            $url = url($submenu->website_url);
                            } elseif ($submenu->web_site_target == 2) {
                            $url = str_starts_with($submenu->website_url, 'http') ? $submenu->website_url : 'http://' .
                            $submenu->website_url;
                            }
                            $output .= '<a
                                class="dropdown-item ' . ($hasChildren ? 'd-flex align-items-center dropdown-toggle' : '') . '"
                                href="' . $url . '"
                                target="' . ($submenu->web_site_target == 2 ? '_blank' : '_self') . '"
                                aria-expanded="false" aria-label="Expanded' . $submenu->menutitle . '">' .
                                $submenu->menutitle .
                                '</a>';

                            if ($hasChildren) {
                            $output .= renderMenuItems($submenu->id);
                            }

                            $output .= '</li>';


                        }else if($submenu->texttype == 2){
                        $output .= '<li class="dropdown-submenu dynamic-direction w-100 border-bottom">';
                            $output .= '<a class="dropdown-item" href="' . asset($submenu->pdf_file) . '"
                                target="_blank" aria-expanded="false">' . $submenu->menutitle . '</a>';

                            if ($hasChildren) {
                            $output .= renderMenuItems($submenu->id);
                            }

                            $output .= '</li>';
                        }else{
                        $output .= '<li class="dropdown-submenu dynamic-direction w-100 border-bottom">';
                            $output .= '<a
                                class="dropdown-item ' . ($hasChildren ? 'dropdown-toggle d-flex align-items-center' : '') . '"
                                href="' . route('user.navigationpagesbyslug', $submenu->menu_slug) . '"
                                aria-expanded="false">' .
                                $submenu->menutitle . '</a>';

                            if ($hasChildren) {
                            $output .= renderMenuItems($submenu->id);
                            }

                            $output .= '</li>';
                        }
                        }
                        if ($isCourseOrTraining) {
                        $subcategories = DB::table('courses_sub_categories as sub')
                        ->leftJoin('courses_sub_categories as parent', 'sub.parent_id', '=', 'parent.id')
                        ->select('sub.*', 'parent.category_name as parent_category_name')
                        ->where('sub.status', 1)
                        ->orderBy('parent.category_name', 'asc')
                        ->orderBy('sub.category_name', 'asc')
                        ->get();

                        $categoryTree = buildCategoryTree($subcategories);

                        foreach ($categoryTree as $category) {
                        $output .= '<li class="dropdown-submenu dynamic-direction w-100 border-bottom">';
                            $output .= '<a
                                class="dropdown-item ' . (isset($category['children']) && count($category['children']) > 0 ? 'dropdown-toggle' : '') . '"
                                href="' . route('user.courseslug', $category['category']->slug) . '" ' . (isset($category['
                                children']) && count($category['children'])> 0 ? 'data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"' : '') . ' aria-expanded="false">' .
                                $category['category']->category_name . '</a>';
                            if (isset($category['children']) && count($category['children']) > 0) {
                            $output .= renderCourseTree($category['children']);
                            }
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
                        $hasChildren = !empty($node['children']);
                        $dropdownClass = $hasChildren ? 'dropdown-toggle' : '';
                        $dataAttributes = $hasChildren ? 'data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"' : '';

                        // Make the <li> clickable by wrapping everything in <a>
                                $output .= '
                        <li class="dropdown-submenu dynamic-direction w-100 border-bottom">';
                            $output .= '<a class="dropdown-item ' . $dropdownClass . '"
                                href="' . route('user.courseslug', $node['category']->slug) . '" ' . $dataAttributes . '
                                aria-expanded="false">';
                                $output .= htmlspecialchars($node['category']->category_name);
                                $output .= '</a>';

                            if ($hasChildren) {
                            $output .= renderCourseTree($node['children']);
                            }

                            $output .= '</li>';
                        }
                        $output .= '
                    </ul>';

                    return $output;
                    }

                    @endphp

                    @foreach($menus as $menu)
                    @if($menu->menutitle === 'RTI')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.get_rti_page', $menu->menu_slug) }}"
                            aria-expanded="false">
                            {{ $menu->menutitle }}
                        </a>
                    </li>
                   
                    @elseif($menu->menutitle === 'Research Centers' || $menu->menu_slug === 'research-centers-hi')

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            href="{{ route('user.navigationpagesbyslug', $menu->menu_slug) }}" data-bs-toggle="dropdown"
                            aria-expanded="false" aria-label="Expanded {{ $menu->menutitle }}">
                            {{ $menu->menutitle }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($Research_Center_list as $reserch_c)
                            <li class="border-bottom">
                                @if($reserch_c->pdf)
                                <!-- Redirect to PDF -->
                                <a class="dropdown-item" href="{{ asset('storage/' . $reserch_c->pdf) }}"
                                    target="_blank" aria-expanded="false">
                                    {{ $reserch_c->research_centre_name }}
                                </a>
                                @elseif($reserch_c->url)
                                <!-- Redirect to URL -->
                                <a class="dropdown-item" href="{{ $reserch_c->url }}" target="_blank"
                                    aria-expanded="false">
                                    {{ $reserch_c->research_centre_name }}
                                </a>
                                @else
                                <!-- Redirect to another page -->
                                <a class="dropdown-item"
                                    href="{{ url('lbsnaa-sub/' . $reserch_c->research_centre_slug) }}"
                                    aria-expanded="false">
                                    {{ $reserch_c->research_centre_name }}
                                </a>
                                @endif
                            </li>
                            @endforeach
                        </ul>

                    </li>
                    @else

                    <li
                        class="nav-item {{ renderMenuItems($menu->id, $menu->menutitle === 'Training') ? 'dropdown' : '' }}">
                        @php
                        // Initialize URL and target for the menu link
                        $url = '';
                        $target = '_self'; // Default target

                        // Determine the link URL and target based on conditions
                        if ($menu->texttype == 3) {
                        // Case: texttype == 3 (External/Internal Links)
                        if ($menu->web_site_target == 1) {
                        // Internal link
                        $url = url($menu->website_url);
                        } elseif ($menu->web_site_target == 2) {
                        // External link
                        $url = str_starts_with($menu->website_url, 'http')
                        ? $menu->website_url
                        : 'http://' . $menu->website_url;
                        $target = '_blank'; // Open external links in a new tab
                        }
                        } elseif ($menu->texttype == 2) {
                        // Case: texttype == 2 (PDF Link)
                        $url = asset($menu->pdf_file);
                        $target = '_blank'; // PDF files open in a new tab
                        } else {
                        // Default Case: Internal Navigation
                        $url = route('user.navigationpagesbyslug', $menu->menu_slug);
                        }
                        @endphp

                        <!-- Render the menu link -->
                        <a class="nav-link {{ renderMenuItems($menu->id, $menu->menutitle === 'Training') ? 'dropdown-toggle' : '' }}"
                            href="{{ $url }}" target="{{ $target }}" aria-expanded="false"
                            aria-label="Expanded {{ $menu->menutitle }}">
                            {{ $menu->menutitle }}
                        </a>


                        {!! renderMenuItems($menu->id, $menu->menutitle === 'Training') !!}
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>