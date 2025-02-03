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
    <title>

        @if(Cookie::get('language') == '2')
        होम | लाल बहादुर शास्त्री राष्ट्रीय प्रशासन अकादमी
        @else
        @if(isset($title))
        {{ $title }} | Lal Bahadur Shastri National Academy of Administration
        @else
        Home | Lal Bahadur Shastri National Academy of Administration
        @endif
       
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
        top: 0;
        left: 0;
        z-index: 1000;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
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


    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-white" style="overflow-x: hidden">
    <div class="container-fluid bg-light bar">
        <div class="row py-1 align-items-center">
            <div class="col-md-4 d-flex align-items-center" style="font-size: 13px;font-weight:400;">
                <a href="https://www.india.gov.in/" target="_blank" style="font-size: 16px; color: #af2910;"><img
                        class="img-fluid" src="{{ asset('assets/images/icons/ashok.jpg') }}" alt="indian_flag"
                        style="font-size: 510px;height: 50px;">
                    भारत सरकार | Government of India</a>
            </div>
            <div class="col-md-8">
                <ul class="nav justify-content-end align-items-center">
                    <!-- Tooltip Items -->
                    <li class="nav-item">
                        <a class="nav-link" href="#skip_to_main_content" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Skip to main content">
                            <i class="material-icons menu-icon">restart_alt</i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.screen-reader') }}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Screen Reader">
                            <i class="material-icons menu-icon">volume_up</i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Accessibility">
                            <i class="material-icons menu-icon">accessible</i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);"
                                    onclick="set_font_size('increase')">A<sup>+</sup></a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="set_font_size('')">A</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);"
                                    onclick="set_font_size('decrease')">A<sup>-</sup></a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Social Media Links">
                            <i class="material-icons menu-icon">group</i>
                        </a>
                        @php
                        $social_media_links = DB::table('social_media_links')->get();
                        @endphp
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ $social_media_links[0]->facebook_url }}" class="dropdown-item"
                                    target="_blank" data-bs-toggle="tooltip" title="Facebook">
                                    <i class="bi bi-facebook fa-2x" style="color: #af2910;"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $social_media_links[0]->twitter_url }}" class="dropdown-item"
                                    target="_blank" data-bs-toggle="tooltip" title="Twitter">
                                    <i class="bi bi-twitter-x" style="color: #af2910;"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $social_media_links[0]->youtube_url }}" class="dropdown-item"
                                    target="_blank" data-bs-toggle="tooltip" title="YouTube">
                                    <i class="bi bi-youtube" style="color:#af2910;"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $social_media_links[0]->linkedin_url }}" class="dropdown-item"
                                    target="_blank" data-bs-toggle="tooltip" title="LinkedIn">
                                    <i class="bi bi-linkedin" style="color:#af2910;"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.sitemap') }}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Sitemap">
                            <i class="material-icons menu-icon">account_tree</i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.search') }}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Search">
                            <i class="material-icons menu-icon">search</i>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                            data-bs-offset="10,20">
                            <i class="material-icons menu-icon">language</i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="{{ route('set.language', 1) }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ route('set.language', 2) }}">Hindi</a></li>
                        </ul>
                    </li> -->

                </ul>
            </div>
        </div>

    </div>
    <nav class="navbar navbar-expand-lg shadow-none sticky-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="navbar-brand me-auto logo d-flex align-items-center">
                <img src="{{ asset('admin_assets/images/logo.png') }}" alt="logo-icon" class="img-fluid logo">
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
            <div class="collapse navbar-collapse" id="navbar-default">
                <ul class="navbar-nav ms-auto navmenu">
                    @php
                    $language = Cookie::get('language');
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
                    ->get();

                    function renderMenuItems($parentId, $isCourseOrTraining = false) {
                    $language = Cookie::get('language');
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
                                class="dropdown-item ' . ($hasChildren ? 'dropdown-toggle d-flex align-items-center' : '') . '"
                                href="' . $url . '"
                                target="' . ($submenu->web_site_target == 2 ? '_blank' : '_self') . '">' .
                                $submenu->menutitle . '</a>';

                            if ($hasChildren) {
                            $output .= renderMenuItems($submenu->id);
                            }

                            $output .= '</li>';


                        }else if($submenu->texttype == 2){
                        $output .= '<li class="dropdown-submenu dynamic-direction w-100 border-bottom">';
                            $output .= '<a class="dropdown-item" href="' . asset($submenu->pdf_file) . '"
                                target="_blank">' . $submenu->menutitle . '</a>';

                            if ($hasChildren) {
                            $output .= renderMenuItems($submenu->id);
                            }

                            $output .= '</li>';
                        }else{
                        $output .= '<li class="dropdown-submenu dynamic-direction w-100 border-bottom">';
                            $output .= '<a
                                class="dropdown-item ' . ($hasChildren ? 'dropdown-toggle d-flex align-items-center' : '') . '"
                                href="' . route('user.navigationpagesbyslug', $submenu->menu_slug) . '">' .
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

                        ->get();

                        $categoryTree = buildCategoryTree($subcategories);

                        foreach ($categoryTree as $category) {
                        $output .= '<li class="dropdown-submenu dynamic-direction w-100 border-bottom">';
                            $output .= '<a
                                class="dropdown-item ' . (isset($category['children']) && count($category['children']) > 0 ? 'dropdown-toggle' : '') . '"
                                href="' . route('user.courseslug', $category['category']->slug) . '" ' . (isset($category['
                                children']) && count($category['children'])> 0 ? 'data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"' : '') . '>' .
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
                                href="' . route('user.courseslug', $node['category']->slug) . '" ' . $dataAttributes . '>';
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
                        <a class="nav-link" href="{{ route('user.get_rti_page', $menu->menu_slug) }}">
                            {{ $menu->menutitle }}
                        </a>
                    </li>
                    @elseif($menu->menutitle === 'Research Centers')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            href="{{ route('user.navigationpagesbyslug', $menu->menu_slug) }}"
                            data-bs-toggle="dropdown">
                            {{ $menu->menutitle }}
                        </a>
                        <!-- <ul class="dropdown-menu">
                            @foreach($Research_Center_list as $reserch_c)
                            <li class="border-bottom">
                                <a class="dropdown-item"
                                    href="{{ url('lbsnaa-sub') }}/{{ $reserch_c->research_centre_slug }}">
                                    {{ $reserch_c->research_centre_name }}
                                </a>
                            </li>
                            @endforeach
                        </ul> -->
                        <ul class="dropdown-menu">
                            @foreach($Research_Center_list as $reserch_c)
                            <li class="border-bottom">
                                @if($reserch_c->pdf)
                                <!-- Redirect to PDF -->
                                <a class="dropdown-item" href="{{ asset('storage/' . $reserch_c->pdf) }}"
                                    target="_blank">
                                    {{ $reserch_c->research_centre_name }}
                                </a>
                                @elseif($reserch_c->url)
                                <!-- Redirect to URL -->
                                <a class="dropdown-item" href="{{ $reserch_c->url }}" target="_blank">
                                    {{ $reserch_c->research_centre_name }}
                                </a>
                                @else
                                <!-- Redirect to another page -->
                                <a class="dropdown-item"
                                    href="{{ url('lbsnaa-sub/' . $reserch_c->research_centre_slug) }}">
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
                            href="{{ $url }}" target="{{ $target }}">
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const submenus = document.querySelectorAll('.dynamic-direction');

        submenus.forEach(function(submenu) {
            submenu.addEventListener('mouseenter', function() {
                const dropdownMenu = submenu.querySelector('.dropdown-menu');
                if (!dropdownMenu) return;

                // Reset classes
                submenu.classList.remove('dropend', 'dropstart');

                // Get submenu and dropdown positions
                const submenuRect = submenu.getBoundingClientRect();
                const dropdownRect = dropdownMenu.getBoundingClientRect();
                const viewportWidth = window.innerWidth;

                // Check if the dropdown will overflow to the right
                if (submenuRect.right + dropdownRect.width > viewportWidth) {
                    submenu.classList.add('dropstart');
                } else {
                    submenu.classList.add('dropend');
                }
            });
        });
    });
    </script>
    <script>
        document.querySelectorAll('.dropdown-toggle').forEach(item => {
    item.addEventListener('keydown', function(event) {
        if (event.key === 'Tab') {
            let dropdown = this.nextElementSibling;
            if (dropdown && dropdown.classList.contains('dropdown-menu')) {
                dropdown.querySelector('.dropdown-item').focus();
            }
        }
    });
});

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.dropdown-toggle').forEach((dropdown) => {
        dropdown.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                this.click();
            }
        });
    });
});

    </script>
 <div  id="skip_to_main_content">
