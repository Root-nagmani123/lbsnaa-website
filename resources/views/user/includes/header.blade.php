<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Codescandy">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/favicon.ico') }}">

  <!-- CSS public/Assets -->
  <link href="{{ asset('public/assets/fonts/feather/feather.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('public/assets/css/theme.min.css') }}">
  <link rel="canonical" href="LBSNAA">
  <link href="{{ asset('public/assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('public/assets/libs/glightbox/dist/css/glightbox.min.css') }}">

  <title>Home | Lal Bahadur Shastri National Academy of Administration</title>
</head>
<header>
  <nav class="navbar navbar-expand-lg">
    <div class="container px-0">
      <a class="navbar-brand" href="#">
        <div class="row">
          <div class="col-3">
            <img src="{{ asset('public/assets/images/lbsnaa-logo.png') }}" alt="" width="65px">
          </div>
          <div class="col-9">
            <p style="color: #af2910; font-size: 11px; margin-top: 1rem;"><b>लाल बहादुर शास्त्री राष्ट्रीय प्रशासन
                अकादमी<br>Lal Bahadur
                Shastri National Academy<br> of Administration</b>
            </p>
          </div>
        </div>
      </a>
      <!-- Button -->

      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="navbar-default">
        <ul class="navbar-nav mx-auto">
          @php
          $menus = DB::table('menus')->where('menu_status',1)->where('is_deleted',0)->where('txtpostion',1)->where('parent_id', 0)->get();
          @endphp

          @foreach($menus as $menu)
          @php
          $submenus = DB::table('menus')->where('menu_status',1)->where('is_deleted',0)->where('txtpostion',1)->where('parent_id', $menu->id)->get();
          @endphp
          <li class="nav-item dropdown">
            @if(count($submenus) > 0 )
            <a class="nav-link {{count($submenus) > 0 ? 'dropdown-toggle' : ''}}" href="{{$menu->menutitle == 'Research Center' ? '#' :route('user.navigationpagesbyslug', $menu->menu_slug)}}" id="navbarListing"
              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$menu->menutitle}}</a>
              <ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end" aria-labelledby="navbarPages">
                @foreach($submenus as $submenu)
                @include('user.components.menu-item', ['menu' => $submenu])
                @endforeach
              </ul>
            @else
            <a class="nav-link {{count($submenus) > 0 ? 'dropdown-toggle' : ''}}" href="{{$menu->menutitle == 'Research Center' ? '#' :route('user.navigationpagesbyslug', $menu->menu_slug)}}" id="navbarListing">
              {{$menu->menutitle}}</a>
            @endif
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </nav>
</header>