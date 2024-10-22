<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.menus.index') }}">Menus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.slider_list') }}">Home Slider</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.quick_links.index') }}">Quick Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.footer_images.index') }}">Footer Image</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.news.index') }}">Blog News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.faculty.index') }}">Manage Faculty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.staff.index') }}">Manage staff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sections.index') }}">Manage sections</a>
                    </li>
                    <!-- Add more links for other admin pages here -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
