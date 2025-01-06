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
  <link rel="icon" type="image/png" href="{{ asset('admin_assets/images/favicon.ico') }}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

  <title>Research Center | Lal Bahadur Shastri National Academy of Administration</title>

</head>

<body class="d-flex flex-column min-vh-100 bg-white">
<header class="d-none d-lg-block sticky-top">
    <nav class="navbar">
        <div class="container-fluid px-0">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/microsites/logo.png') }}"
                    alt="logo" width="400"></a>
            <!-- Button -->

            @php
                // Get the slug from the query parameter or the last segment of the URL
                $slug = request()->query('slug') ?: request()->segment(count(request()->segments()));

                // Query to get the research centre data based on the slug
                $centre_name = null;
                if ($slug) {
                    $centre_name = DB::table('research_centres')
                        ->where('status', 1)
                        ->where('research_centre_slug', $slug) // Match the slug
                        ->first(); // Get the first matching result
                }
            @endphp

            @if($centre_name)
                    <h2 class="text-dark">{{ $centre_name->research_centre_name }}<br>
                    <small>({{ $centre_name->research_centre_slug }})</small></h2>
                    
                @else
                    <h4>Default Centre Name</h4> <!-- Default name if no match is found -->
                @endif



            <!-- <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/microsites/crs.jpg') }}"
                    alt="logo" width="500"></a> -->


                    
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
                        {!! renderMicroMenuItems($menu->id) !!}
                    </li>
                @endforeach
            </ul>
        </div>

    </nav>
</header>
