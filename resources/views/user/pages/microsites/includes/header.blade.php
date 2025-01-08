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
<header class="d-none d-lg-block sticky-top">
    <nav class="navbar">
        <div class="container-fluid px-0">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/microsites/logo.png') }}"
                    alt="logo" width="350"></a>
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

            @if ($centre_name)
            <h2 class="text-dark">{{ $centre_name->research_centre_name }}<br><span class="text-center" style="font-size:14px;">
                @if (!empty($centre_name->sub_heading))
                    ( {{ $centre_name->sub_heading }} )
                @endif
            </span></h2>
            
            @else
                <h4>Default Centre Name</h4> <!-- Default name if no match is found -->
            @endif



                    
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg">
        <!-- Collapse -->
        <!-- <div class="collapse navbar-collapse" id="navbar-default">
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
        </div> -->

        <div class="collapse navbar-collapse" id="navbar-default">




        <ul class="navbar-nav mx-auto">
            @php
                // Fetch slug from the query string, falling back to the route slug if not present
                $slug = request()->query('slug') ?: request()->route('slug'); 

                // Function to fetch and display menus recursively
                function displayMenu($parentId, $slug, $isRoot = false) {
                    // Query to fetch menus
                    $query = DB::table('micromenus')
                        ->join('research_centres', 'micromenus.research_centreid', '=', 'research_centres.id')
                        ->where('micromenus.menu_status', 1)
                        ->where('micromenus.is_deleted', 0)
                        ->where('micromenus.parent_id', $parentId);

                    // Apply slug filter only at the root level
                    if ($isRoot && $slug) {
                        $query->where('research_centres.research_centre_slug', $slug);
                    }

                    $menus = $query->select('micromenus.*')->get();

                    // If no menus are found, display a message
                    if ($menus->isEmpty()) {
                        echo "<li>No menus found for the selected slug: {$slug}</li>";
                        return;
                    }

                    foreach ($menus as $menu) {
                        // Check if the current menu has child menus
                        $childMenus = DB::table('micromenus')
                            ->where('menu_status', 1)
                            ->where('is_deleted', 0)
                            ->where('parent_id', $menu->id)
                            ->get();

                        // Determine if the menu has a dropdown
                        $arrow = $childMenus->isNotEmpty();
                        $class = $arrow ? 'nav-link dropdown-toggle' : 'nav-link';

                        // Preserve the current slug in the menu link
                        $menuLink = route('user.navigationmenubyslug', $menu->menu_slug) . '?slug=' . urlencode($slug);

                        // Output the menu item
                        echo "<li class='nav-item dropdown'>";
                        echo "<a class='{$class}' href='{$menuLink}'" . ($arrow ? " data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'" : '') . ">";
                        echo $menu->menutitle;
                        echo "</a>";

                        // Recursively display child menus if available
                        if ($arrow) {
                            echo "<ul class='dropdown-menu'>";
                            displayMenu($menu->id, $slug, false); // Recursive call
                            echo "</ul>";
                        }

                        echo "</li>";
                    }
                }
            @endphp

            @php
                // Display the top-level menus (parent menus with parent_id = 0) filtered by slug
                displayMenu(0, $slug, true);
            @endphp
        </ul>



        </div>
    </nav>
</header>
