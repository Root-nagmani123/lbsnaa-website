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
    <link rel="icon" type="image/png" href="{{ asset('admin_assets/images/favicon.ico') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>{{$Title}}</title>

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

    /* Position the play/pause button on the right */
    #playPauseBtn {
        position: absolute;
        bottom: 1%;
        right: 30px;
        transform: translateY(-5%);
        z-index: 10;
        opacity: 0.8;
        transition: opacity 0.3s ease-in-out;
    }

    /* Hide next/prev arrows by default */
    .carousel-control-prev,
    .carousel-control-next {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    /* Show next/prev arrows on hover */
    #carouselExampleCaptions:hover .carousel-control-prev,
    #carouselExampleCaptions:hover .carousel-control-next {
        opacity: 1;
    }

    /* Ensure the buttons are clearly visible when focused */
    .carousel-indicators button:focus {
        outline: 2px solid #af2910 !important;
        /* Red outline to indicate focus */
        background-color: rgba(255, 255, 255, 0.5);
        /* Light red background */
        border-radius: 5px;
    }

    /* Optional: Increase the size for better accessibility */
    .carousel-indicators button {
        border-radius: 10px;
        margin: 5px;
        background-color: #af2910;
        border: none;
    }

    /* Active indicator styling */
    .carousel-indicators .active {
        background-color: #af2910;
        /* Blue color for active indicator */
    }

    /* Hover effect for better UI feedback */
    .carousel-indicators button:hover {
        background-color: #af2910;
    }

    .btn-scroll-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background-color: #fff;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: opacity 0.3s, transform 0.3s;
        opacity: 0;
        transform: translateY(100px);
        outline: none;
    }

    .btn-scroll-top:focus {
        outline: 3px solid #af2910;
        /* Improve focus visibility */
    }

    .btn-scroll-top.show {
        opacity: 1;
        transform: translateY(0);
    }

    #wrap {
        width: 100%;
        margin: 0 auto;
    }

    #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        text-align: left;
    }

    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
    }

    .external-event {
        /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366cc;
        color: #fff;
        font-size: 0.85em;
        cursor: pointer;
    }

    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
    }

    #external-events p input {
        margin: 0;
        vertical-align: middle;
    }

    #calendar {
        /* 		float: right; */
        margin: 0 auto;
        width: 900px;
        background-color: #ffffff;
        border-radius: 6px;
        box-shadow: 0 1px 2px #c3c3c3;
    }
    </style>

</head>

<body class="d-flex flex-column min-vh-100 bg-white">
    <section class="bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center" style="font-size: 16px;font-weight:400;color:#af2910;">
                    <img class="img-fluid" src="{{ asset('assets/images/icons/ashok.jpg') }}" alt="Logo of Ashok Stambh"
                        aria-label="Logo of Ashoka Stambh" style="font-size: 510px;height: 50px;margin-right:5px;">
                    भारत सरकार | Government of India
                </div>
                <div class="col-md-8">
                    <ul class="nav justify-content-end align-items-right">
                        <!-- Tooltip Items -->
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="#skip_to_main_content" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Skip to main content"
                                aria-label="Skip to main content">
                                <!-- <i class="material-icons menu-icon">event_repeat</i> -->
                                <img src="{{ asset('assets/images/skip_to_main_content.png') }}"
                                    alt="skip to main content" style="height: 30px;">

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <header class="d-lg-block">
        <nav class="navbar">
            <div class="container-fluid px-0">
                <a class="navbar-brand" href="{{ route('home') }}"
                    aria-label="Logo of Lal Bahadur Shastri National Academy of Administration"><img
                        src="{{ asset('assets/images/microsites/logo.png') }}"
                        alt="Logo of Lal Bahadur Shastri National Academy of Administration" width="350"></a>
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
                <h1 class="text-dark"><a href="#" class="text-dark">{{ $centre_name->research_centre_name }}<br><span
                            class="text-center" style="font-size:14px;">
                            @if (!empty($centre_name->sub_heading))
                            ( {{ $centre_name->sub_heading }} )
                            @endif
                        </span></a></h1>

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
                <ul class="navbar-nav me-auto navmenu">
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
                    ->orderBy('micromenus.position', 'ASC')
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
                    $menuLink = asset($menu->pdf_file);
                    $target = '_blank'; // Open in a new tab
                    } elseif (!empty($menu->website_url)) {
                    // If website_url exists, redirect to the URL and open in a new tab
                    $menuLink = $menu->website_url;
                    $target = '_blank'; // Open in a new tab
                    }

                    echo "<li
                        class='nav-item " . ($hasChildren ? "dropdown" . (!$isRoot ? " dropend" : "") : "") . ($isRoot ? "" : " border-bottom dropdown-item") . "'>

                        <a href='{$menuLink}' class='" . ($hasChildren ? "nav-link dropdown-toggle" : "nav-link") . "'
                            target='{$target}' " . ($hasChildren ? " aria-label='Expandable, {$menu->menutitle}'
                            aria-expanded='false' aria-haspopup='true'" : "") . ">
                            {$menu->menutitle}
                        </a>";

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
    <script>
    $(document).ready(function() {
        // Open dropdown on hover
        $(".dropdown, .dropdown-submenu").hover(
            function() {
                $(this).addClass("show");
                $(this).children(".dropdown-menu").addClass("show");
            },
            function() {
                $(this).removeClass("show");
                $(this).children(".dropdown-menu").removeClass("show");
            }
        );

        // Open dropdown when focused on
        $(".nav-link, .dropdown-item").on("focus", function() {
            let parent = $(this).closest(".dropdown, .dropdown-submenu");
            if (parent.length) {
                parent.addClass("show");
                parent.children(".dropdown-menu").addClass("show");
            }
        });

        // Close the dropdown when Escape key is pressed
        $(document).on("keydown", function(e) {
            if (e.key === "Escape" || e.keyCode === 27) {
                e.preventDefault(); // Prevent default action

                let focusedElement = $(document.activeElement);
                let parentDropdown = focusedElement.closest(".dropdown");

                if (parentDropdown.length) {
                    // Close the dropdown
                    parentDropdown.removeClass("show");
                    parentDropdown.children(".dropdown-menu").removeClass("show");
                    parentDropdown.find(".dropdown-menu")
                        .hide(); // Hide the dropdown to prevent it from showing up again
                }
            }
        });

        // Allow arrow keys to navigate within the dropdown
        $(".dropdown-menu").on("keydown", function(e) {
            let items = $(this).find(".dropdown-item");
            let index = items.index(document.activeElement);

            if (e.key === "ArrowDown") {
                e.preventDefault();
                let nextIndex = (index + 1) % items.length;
                items.eq(nextIndex).focus();
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                let prevIndex = (index - 1 + items.length) % items.length;
                items.eq(prevIndex).focus();
            }
        });
    });
    </script>