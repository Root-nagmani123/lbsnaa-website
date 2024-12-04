<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Codescandy">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">

  <!-- darkmode js -->
  <script src="{{ asset('assets/js/vendors/darkMode.js') }}"></script>

  <!-- Libs CSS -->
  <link href="{{ asset('assets/fonts/feather/feather.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">

  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">

  <link rel="canonical" href="LBSNAA">
  <link href="{{ asset('assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="assets/libs/glightbox/dist/css/glightbox.min.css') }}">
  <title>Research Center | Lal Bahadur Shastri National Academy of Administration</title>

</head>

<body class="bg-white">
    <nav class="navbar">
        <div class="container px-0">
            <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/microsites/logo.png') }}"
                    alt="logo" width="300"></a>
            <!-- Button -->
            <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/microsites/crs.jpg') }}"
                    alt="logo" width="500"></a>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg">

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbar-default">
            <ul class="navbar-nav mx-auto">
                @php

                    $menus = DB::table('micromenus')
                        ->where('menu_status', 1)
                        ->where('is_deleted', 0)
                        ->where('parent_id', 0)
                        ->get();

                    function renderMenuItems($parentId)
                    {
                        $submenus = DB::table('micromenus')
                            ->where('menu_status', 1)
                            ->where('is_deleted', 0)
                            ->where('parent_id', $parentId)
                            ->get();

                        if ($submenus->isEmpty()) {
                            return '';
                        }

                        $output = '<ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end">';
                        foreach ($submenus as $submenu) {
                            $hasChildren = DB::table('micromenus')
                                ->where('menu_status', 1)
                                ->where('is_deleted', 0)
                                ->where('parent_id', $submenu->id)
                                ->exists();

                            $output .= '<li class="nav-item ' . ($hasChildren ? 'dropdown' : '') . '">';
                            $output .=
                                '<a class="nav-link ' .
                                ($hasChildren ? 'dropdown-toggle' : '') .
                                '"
                        href="' .
                                ($submenu->menutitle == 'Research Center'
                                    ? '#'
                                    : route('user.navigationmenubyslug', $submenu->menu_slug)) .
                                '" ' .
                                ($hasChildren
                                    ? ' data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"'
                                    : '') .
                                '>' .
                                $submenu->menutitle .
                                '</a>';

                            // Recursive call for child menus
                            if ($hasChildren) {
                                $output .= renderMenuItems($submenu->id);
                            }

                            $output .= '</li>';
                        }
                        $output .= '</ul>';

                        return $output;
                    }
                @endphp

                @foreach ($menus as $menu)
                    @php
                        $arrow = DB::table('micromenus')
                            ->where('menu_status', 1)
                            ->where('is_deleted', 0)
                            ->where('parent_id', $menu->id)
                            ->exists();
                        $class = $arrow ? 'nav-link dropdown-toggle' : 'nav-link';
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="{{ $class }}"
                            href="{{ $menu->menutitle == 'Research Center' ? '#' : route('user.navigationmenubyslug', $menu->menu_slug) }}"
                            {{ $arrow ? 'data-bs-toggle=dropdown aria-haspopup=true aria-expanded=false' : '' }}>
                            {{ $menu->menutitle }}
                        </a>
                        {!! renderMenuItems($menu->id) !!}
                    </li>
                @endforeach

            </ul>

        </div>
    </nav>
