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
    <title>Home | Lal Bahadur Shastri National Academy of Administration</title>
    <style>
         .slider-caption {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1000;
    width: 100%;
    height: 100%; /* Cover the full height of the carousel */
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
    color: #fff;
    font-weight: 600;
    font-size: 100%;
    line-height: 135%;
    padding: 10px;
    display: flex; /* Use flexbox for centering */
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-white">
    <div class="container-fluid bg-light">
        <ul class="nav justify-content-end py-1">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#news"><i
                        class="material-icons menu-icon">restart_alt</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.screen-reader')}}"><i class="material-icons menu-icon">volume_up</i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons menu-icon">accessible</i></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:void(0);" title="Increase font size"
                            onclick="set_font_size('increase')">A<sup>+</sup></a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" title="Reset font size" onclick="set_font_size('')">A</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" title="Decrease font size"
                            onclick="set_font_size('decrease')">A<sup>-</sup></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons menu-icon">group</i></a>
                @php
                        $social_media_links = DB::table('social_media_links')->get();
                        @endphp
                <ul class="dropdown-menu">
                    <li> <a href="{{ $social_media_links[0]->facebook_url; }}" class="me-2 dropdown-item" target="_blank">
                            <i class="bi bi-facebook fa-2x" style="color: #af2910;"></i>
                        </a></li>
                    <li> <a href="{{ $social_media_links[0]->twitter_url; }}" class="me-2 dropdown-item" target="_blank">
                            <i class="bi bi-twitter-x" style="color: #af2910;"></i>
                        </a></li>
                    <li><a href="{{ $social_media_links[0]->youtube_url; }}" class="me-2 dropdown-item" target="_blank">
                            <i class="bi bi-youtube" style="color:#af2910;"></i>
                        </a></li>
                        <li><a href="{{ $social_media_links[0]->linkedin_url; }}" class="me-2 dropdown-item" target="_blank">
                            <i class="bi bi-linkedin" style="color:#af2910;"></i>
                        </a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.sitemap') }}"><i class="material-icons menu-icon">route</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.search') }}"><i class="material-icons menu-icon">search</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-disabled="true"><i class="material-icons menu-icon">language</i></a>
            </li>
        </ul>
    </div>
    <nav class="navbar navbar-expand-lg shadow-none sticky-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="navbar-brand me-auto logo d-flex align-items-center">
                <img src="{{ asset('admin_assets/images/logo.png') }}" alt="logo-icon" class="img-fluid" width="350">
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
                <ul class="navbar-nav ms-auto navmenu">
                    @php
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

                    $output = '<ul class="dropdown-menu">
                        ';

                        foreach ($submenus as $submenu) {
                        if ($submenu->menutitle === 'RTI' || $submenu->menutitle === 'research-centers') {
                        continue;
                        }

                        $hasChildren = DB::table('menus')
                        ->where('menu_status', 1)
                        ->where('is_deleted', 0)
                        ->where('parent_id', $submenu->id)
                        ->exists();

                        $output .= '<li class="dropdown-submenu dropstart">';
                            $output .= '<a class="dropdown-item ' . ($hasChildren ? 'dropdown-toggle' : '') . '"
                                href="' . route('user.navigationpagesbyslug', $submenu->menu_slug) . '"> ' .
                                $submenu->menutitle . '</a>';

                            if ($hasChildren) {
                            $output .= renderMenuItems($submenu->id);
                            }

                            $output .= '</li>';
                        }

                        $output .= '</ul>';
                    return $output;
                    }
                    @endphp

                    <!-- Navbar Menu Items -->
                    @foreach($menus as $menu)
                    @if($menu->menutitle === 'RTI')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.get_rti_page', $menu->menu_slug) }}">
                            {{ $menu->menutitle }}
                        </a>
                    </li>
                    @elseif($menu->menutitle === 'Research Centers')
                    <li
                        class="nav-item dropdown {{ DB::table('menus')->where('parent_id', $menu->id)->exists() ? 'dropdown' : '' }}">
                        <a class="nav-link {{ DB::table('menus')->where('parent_id', $menu->id)->exists() ? 'dropdown-toggle' : '' }}"
                            href="{{ route('user.navigationpagesbyslug', $menu->menu_slug) }}"
                            {{ DB::table('menus')->where('parent_id', $menu->id)->exists() ? 'data-bs-toggle="dropdown"' : '' }}>
                            {{ $menu->menutitle }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-arrow clickable" data-href="#">
                            @foreach($Research_Center_list as $reserch_c)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ url('lbsnaa-sub') }}/{{ $reserch_c->research_centre_slug }}">
                                    {{ $reserch_c->research_centre_name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li
                        class="nav-item {{ DB::table('menus')->where('parent_id', $menu->id)->exists() || $menu->menutitle === 'Training' ? 'dropdown' : '' }}">
                        <a class="nav-link {{ DB::table('menus')->where('parent_id', $menu->id)->exists() || $menu->menutitle === 'Training' ? 'dropdown-toggle' : '' }}"
                            href="{{ route('user.navigationpagesbyslug', $menu->menu_slug) }}"
                            {{ DB::table('menus')->where('parent_id', $menu->id)->exists() || $menu->menutitle === 'Training' ? 'data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '' }}>
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
        const dropdowns = document.querySelectorAll('.dropdown-submenu');

        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('mouseenter', function() {
                const submenu = this.querySelector('.dropdown-menu');
                if (submenu) submenu.style.display = 'block';
            });

            dropdown.addEventListener('mouseleave', function() {
                const submenu = this.querySelector('.dropdown-menu');
                if (submenu) submenu.style.display = 'none';
            });
        });
    });
    </script>