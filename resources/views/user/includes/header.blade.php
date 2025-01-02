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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="{{ asset('assets/js/orgchart.js') }}"></script>
    <!-- OrgChart.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.0.0/css/jquery.orgchart.min.css">

    <!-- jQuery (required for OrgChart.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- OrgChart.js JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.0.0/js/jquery.orgchart.min.js"></script>
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
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="navbar-brand me-auto logo d-flex align-items-center">
                <img src="{{ asset('admin_assets/images/logo.png') }}" alt="logo-icon" class="img-fluid" width="250">
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

        function renderMenuItems($parentId) {
            $submenus = DB::table('menus')
                ->where('menu_status', 1)
                ->where('is_deleted', 0)
                ->where('parent_id', $parentId)
                ->get();

            if ($submenus->isEmpty()) {
                return '';
            }

            $output = '<ul class="dropdown-menu custom-dropdown">';

            foreach ($submenus as $submenu) {
                $hasChildren = DB::table('menus')
                    ->where('menu_status', 1)
                    ->where('is_deleted', 0)
                    ->where('parent_id', $submenu->id)
                    ->exists();

                $output .= '<li class="dropdown-submenu">';
                    $output .= '<a class="dropdown-item ' . ($hasChildren ? 'dropdown-toggle' : '') . '"
                            href="' . route('user.navigationpagesbyslug', $submenu->menu_slug) . '">' .
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

        @foreach($menus as $menu)
        <li class="nav-item {{ DB::table('menus')->where('parent_id', $menu->id)->exists() ? 'dropdown' : '' }}">
            <a class="nav-link {{ DB::table('menus')->where('parent_id', $menu->id)->exists() ? 'dropdown-toggle' : '' }}"
                href="{{ route('user.navigationpagesbyslug', $menu->menu_slug) }}"
                {{ DB::table('menus')->where('parent_id', $menu->id)->exists() ? 'data-bs-toggle="dropdown"' : '' }}>
                {{ $menu->menutitle }}
            </a>
            {!! renderMenuItems($menu->id) !!}
        </li>
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
    <style>
    /* Default dropdown to open to the right */
    .navbar-nav .dropdown-menu {
        position: absolute;
        left: 0;
        right: auto;
        z-index: 1050;
        /* Ensure the dropdown appears on top */
    }

    /* Media Query for smaller screens (mobile/tablets) */
    @media (max-width: 768px) {
        .navbar-nav .dropdown-menu {
            position: absolute;
            left: auto;
            right: 0;
            /* Move the dropdown to the left side */
        }

        /* Handle nested dropdowns on smaller screens */
        .navbar-nav .dropdown-submenu {
            position: relative;
        }

        .navbar-nav .dropdown-submenu .dropdown-menu {
            left: 100%;
            /* Align the submenu to the left */
            right: auto;
        }
    }

    .navmenu .dropdown-submenu {
        position: relative;
    }

    .navmenu .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-left: 0;
        border-radius: 0;
        display: none;
    }

    .navmenu .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .navmenu .dropdown-toggle::after {
        content: ' ▶';
        float: right;
    }
    </style>
    <!-- Add this to your custom CSS file -->
<style>
/* Ensure the dropdown submenu opens to the left */
.dropdown-submenu .dropdown-menu {
    left: -100%; /* Move to the left side of the parent menu */
    right: auto; /* Prevent the submenu from opening to the right */
    top: 0;
    position: absolute; /* Set submenu position to absolute */
}

/* Style the arrow icon on the parent menu */
.dropdown-toggle::after {
    content: " ▼"; /* Use a downward arrow for the parent item */
    font-size: 12px;
    margin-left: 5px;
}

/* Optional: Make the submenu arrow point to the right */
.dropdown-submenu .dropdown-toggle::after {
    content: " ▶"; /* Use a rightward arrow for the submenu */
    font-size: 12px;
    margin-left: 5px;
}
</style>