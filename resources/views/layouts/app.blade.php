<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('admin.menus.index') }}">Admin Panel</a>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="nav-link" href="{{ route('admin.slider_list') }}">Home Slider</a>
                    </nav>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="nav-link" href="{{ route('admin.quick_links.index') }}">Quick Link</a>
                    </nav>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="nav-link" href="{{ route('admin.footer_images.index') }}">Footer Image</a>
                    </nav>
        <div class="content mt-3">
            @yield('content')
        </div>
    </div>
</body>
</html>
