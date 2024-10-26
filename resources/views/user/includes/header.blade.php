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
  <link href="{{ asset('assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/dist/css/glightbox.min.css') }}">

  <title>Home | Lal Bahadur Shastri National Academy of Administration</title>
</head>
<header>
  <nav class="navbar navbar-expand-lg">
    <div class="container px-0">
      <a class="navbar-brand" href="#">
        <div class="row">
          <div class="col-3">
            <img src="assets/images/lbsnaa-logo.png" alt="" width="65px">
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
          $menus = DB::table('menus')->where('menu_status',1)->where('txtpostion',1)->where('parent_id', null)->get();
          @endphp

          @foreach($menus as $menu)
          @php
          $submenus = DB::table('menus')->where('menu_status',1)->where('txtpostion',1)->where('parent_id', $menu->id)->get();
          @endphp
          <li class="nav-item dropdown">
            <a class="nav-link {{count($submenus) > 0 ? 'dropdown-toggle' : ''}}" href="#" id="navbarListing"
              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$menu->menutitle}}</a>
            @if(count($submenus) > 0)
              <ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end" aria-labelledby="navbarPages">
                @foreach($submenus as $submenu)
                @include('user.components.menu-item', ['menu' => $submenu])
                @endforeach
              </ul>
            @endif

          </li>

          @endforeach

          <!-- 
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarListing" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">The Academy</a>
            <ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end" aria-labelledby="navbarPages">
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="jobs/company-list.html">About LBSNAA</a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="jobs/company-about.html">Mission Statement</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-reviews.html">Academy Song</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-jobs.html">Campuses</a>
                  </li>
                  <li class="dropdown-submenu dropend">
                    <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="jobs/company-benefits.html">Life at Academy</a>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="jobs/company-about.html">The Academy Experience</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="jobs/company-reviews.html">A day in the life of a Trainee</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-photos.html">History</a>
                  </li>
                </ul>
              </li>
              <li>
                <a class="dropdown-item" href="#">Directors Message</a>
              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">Organization</a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="jobs/company-about.html">Mission Statement</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-reviews.html">Academy Song</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-jobs.html">Campuses</a>
                  </li>
                  <li class="dropdown-submenu dropend">
                    <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="jobs/company-benefits.html">Life at Academy</a>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="jobs/company-about.html">The Academy Experience</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="jobs/company-reviews.html">A day in the life of a Trainee</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-photos.html">History</a>
                  </li>
                </ul>
              </li>
              <li>
                <a class="dropdown-item" href="#">Facilities at the Academy</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Collaborations</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">About Mussoorie</a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarPages" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">Training</a>
            <ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end" aria-labelledby="navbarPages">
              <li>
                <a class="dropdown-item" href="jobs/company-list.html">Company List</a>
              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">Company Single</a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="jobs/company-about.html">About</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-reviews.html">Reviews</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-jobs.html">Jobs</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-benefits.html">Benifits</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-photos.html">Photos</a>
                  </li>
                </ul>
              </li>
              <li>
                <a class="dropdown-item" href="jobs/post-job.html">Post A Job</a>
              </li>
              <li>
                <a class="dropdown-item" href="jobs/upload-resume.html">Upload Resume</a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarListing" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Research Centers</a>
            <ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end" aria-labelledby="navbarPages">
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="jobs/company-list.html">About LBSNAA</a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="jobs/company-about.html">Mission Statement</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-reviews.html">Academy Song</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-jobs.html">Campuses</a>
                  </li>
                  <li class="dropdown-submenu dropend">
                    <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="jobs/company-benefits.html">Life at Academy</a>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="jobs/company-about.html">The Academy Experience</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="jobs/company-reviews.html">A day in the life of a Trainee</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-photos.html">History</a>
                  </li>
                </ul>
              </li>
              <li>
                <a class="dropdown-item" href="#">Directors Message</a>
              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">Organization</a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="jobs/company-about.html">Mission Statement</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-reviews.html">Academy Song</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-jobs.html">Campuses</a>
                  </li>
                  <li class="dropdown-submenu dropend">
                    <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="jobs/company-benefits.html">Life at Academy</a>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="jobs/company-about.html">The Academy Experience</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="jobs/company-reviews.html">A day in the life of a Trainee</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-photos.html">History</a>
                  </li>
                </ul>
              </li>
              <li>
                <a class="dropdown-item" href="#">Facilities at the Academy</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Collaborations</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">About Mussoorie</a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarPages" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">Knowledge Centers</a>
            <ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end" aria-labelledby="navbarPages">
              <li>
                <a class="dropdown-item" href="jobs/company-list.html">Company List</a>
              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">Company Single</a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="jobs/company-about.html">About</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-reviews.html">Reviews</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-jobs.html">Jobs</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-benefits.html">Benifits</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="jobs/company-photos.html">Photos</a>
                  </li>
                </ul>
              </li>
              <li>
                <a class="dropdown-item" href="jobs/post-job.html">Post A Job</a>
              </li>
              <li>
                <a class="dropdown-item" href="jobs/upload-resume.html">Upload Resume</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="navbarListing" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">RTI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="navbarListing" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Visit Us</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>
</header>