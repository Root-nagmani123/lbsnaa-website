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
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <title>Research Center | Lal Bahadur Shastri National Academy of Administration</title>
    <style>
    .slider-caption {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1000;
        width: 100%;
        height: 100%;
        /* Cover the full height of the carousel */
        background: rgba(0, 0, 0, 0.5);
        /* Semi-transparent black */
        color: #fff;
        font-weight: 600;
        font-size: 100%;
        line-height: 135%;
        padding: 10px;
        display: flex;
        /* Use flexbox for centering */
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    </style>

</head>

<body class="d-flex flex-column min-vh-100 bg-white">
    <header class="d-lg-block sticky-top">
        <nav class="navbar">
            <div class="container-fluid px-0">
                <a class="navbar-brand" href="{{ route('home') }}"><img
                        src="{{ asset('assets/images/microsites/logo.png') }}" alt="logo" width="350"></a>
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
                <h2 class="text-dark">{{ $centre_name->research_centre_name }}<br><span class="text-center"
                        style="font-size:14px;">
                        @if (!empty($centre_name->sub_heading))
                        ( {{ $centre_name->sub_heading }} )
                        @endif
                    </span></h2>

                @else

                @endif

                <!-- Navbar Toggle Button (For mobile view) -->
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg">
            <div>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar top-bar mt-0"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </button>
            </div>
            <!-- Collapse -->

            <div class="collapse navbar-collapse" id="navbar-default">
                @php
                // Check if 'slug' is in the query string, otherwise get it from the route
                $slug = request()->query('slug') ?: request()->route('slug');
                @endphp
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="{{ url('/lbsnaa-sub/' . $slug) }}" class="nav-link">Home</a>
                    </li>
                    @php
                    // Get the slug from the request to identify the current research center
                    $slug = request()->query('slug') ?: request()->route('slug');

                    // Fetch the current research center's ID based on the slug
                    $currentResearchCenter = DB::table('research_centres')
                    ->where('research_centre_slug', $slug)
                    ->first();

                    if ($currentResearchCenter) {
                    $researchCenterId = $currentResearchCenter->id;

                    // Fetch menus specific to the current research center
                    $allMenus = DB::table('micromenus')
                    ->join('research_centres', 'micromenus.research_centreid', '=', 'research_centres.id')
                    ->where('micromenus.menu_status', 1)
                    ->where('micromenus.is_deleted', 0)
                    ->where('micromenus.research_centreid', $researchCenterId)
                    ->select('micromenus.*', 'research_centres.research_centre_slug')
                    ->get();

                    // Organize menus by parent_id
                    $menusByParent = $allMenus->groupBy('parent_id');

                    // Recursive function to display the menu
                    function displayMenu($parentId, $menusByParent, $slug, $isRoot = false) {
                    if (!isset($menusByParent[$parentId])) {
                    return;
                    }

                    foreach ($menusByParent[$parentId] as $menu) {
                    $hasChildren = isset($menusByParent[$menu->id]);
                    $menuLink = '#'; // Default link
                    $target = '_self'; // Default target

                    // Determine the redirect link or behavior based on content, pdf_file, and website_url
                    if (!empty($menu->content)) {
                    // If content exists, open the same page
                    $menuLink = route('user.navigationmenubyslug', $menu->menu_slug) . '?slug=' . urlencode($slug);
                    } elseif (!empty($menu->pdf_file)) {
                    // If pdf_file exists, redirect to the file and open in a new tab
                    $menuLink = url($menu->pdf_file); // Generate the correct URL
                    $target = '_blank'; // Open in a new tab
                    } elseif (!empty($menu->website_url)) {
                    // If website_url exists, redirect to the URL and open in a new tab
                    $menuLink = $menu->website_url;
                    $target = '_blank'; // Open in a new tab
                    }

                    echo "<li
                        class='nav-item " . ($hasChildren ? "dropdown-submenu dropend" : "") . ($isRoot ? "" : " border-bottom") . " dropdown'>
                        <a href='{$menuLink}'
                            class='" . ($hasChildren ? "dropdown-item dropdown-toggle" : "dropdown-item") . "'
                            target='{$target}'>";
                            echo $menu->menutitle;
                            echo "</a>";

                        if ($hasChildren) {
                        echo "<ul class='dropdown-menu'>";
                            displayMenu($menu->id, $menusByParent, $slug, false);
                            echo "</ul>";
                        }

                        echo "
                    </li>";
                    }
                    }

                    // Call the function to display the menu
                    displayMenu(0, $menusByParent, $slug, true);
                    } else {
                    echo "<li class='nav-item'><span>No menu available for this.</span></li>";
                    }
                    @endphp
                </ul>








            </div>
        </nav>
    </header>

    <!-- JavaScript to handle parent menu click -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownLinks = document.querySelectorAll('.dropdown-toggle');

        dropdownLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                // Ensure page reloads with correct href
                if (href && href !== '#') {
                    window.location.href = href; // Redirect to the correct page
                }
            });
        });
    });
    </script>