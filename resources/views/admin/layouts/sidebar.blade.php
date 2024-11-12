<div class="sidebar-area" id="sidebar-area">
        <div class="logo position-relative">
            <a href="index.html" class="d-block text-decoration-none">
                <img src="{{ asset('admin_assets/images/logo.png') }}" alt="logo-icon">
            </a>
            <button
                class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
                id="sidebar-burger-menu">
                <i data-feather="x"></i>
            </button>
        </div>
        
        <aside id="layout-menu" class="layout-menu menu-vertical menu" data-simplebar="">
            <ul class="menu-inner">
                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">Main Website</span>
                </li>
                <li class="menu-item open">
                    <a href="{{ route('admin.index') }}" class="menu-link">
                    <i class="material-icons menu-icon">dashboard</i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item open">
                    <a href="{{ route('view-profile.index') }}" class="menu-link">
                    <i class="material-icons menu-icon">badge</i>
                        <span class="title">View Profile</span>
                    </a>
                </li> 
               
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="material-icons menu-icon">wysiwyg</i>
                        <span class="title">CMS Page</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('admin.menus.index') }}" class="menu-link">
                                Manage Menu
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle"><i class="material-icons menu-icon">corporate_fare
                    </i>
                        <span class="title">Manage Organization Module</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('organisation_chart.index')}}" class="menu-link">
                                Manage Organization Chart
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.faculty.index') }}" class="menu-link">
                                Manage Faculty
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.staff.index') }}" class="menu-link">
                                Manage Staff
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('sections.index') }}" class="menu-link">
                                Manage Sections
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="material-icons menu-icon">model_training</i> 
                        <span class="title">Training Master Management</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('organisers.index') }}" class="menu-link">
                                Manage Organiser
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('coordinators.index') }}" class="menu-link">
                                Manage Coordinator
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('venues.index') }}" class="menu-link">
                                Manage Venue
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('founders.index') }}" class="menu-link">
                                Manage Founder
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('cadres.index') }}" class="menu-link">
                                Manage Cadre
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('category.index') }}" class="menu-link">
                                Manage Category
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('country.index') }}" class="menu-link">
                                Manage Country
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('state.index') }}" class="menu-link">
                                Manage State
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('district.index') }}" class="menu-link">
                                Manage Districts
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('exam.index') }}" class="menu-link">
                                Manage Exam
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="menu-item">
                    <a href="#" class="menu-link">
                    <i class="material-icons menu-icon">article</i>
                        <span class="title">Manage Middle Section</span>
                    </a>
                </li> -->
                <!-- <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="material-icons menu-icon">campaign</i>
                        <span class="title">Manage Latest Updates</span>
                    </a>
                </li> -->
                <li class="menu-item">
                    <a href="{{ route('admin.news.index') }}" class="menu-link">
                    <i class="material-icons menu-icon">newspaper</i>
                        <span class="title">Manage News</span>
                    </a>
                </li>
                <!-- <li class="menu-item">
                    <a href="{{ route('manage_events.index') }}" class="menu-link">
                    <i class="material-icons menu-icon">event</i>
                        <span class="title">Manage Events</span>
                    </a>
                </li> -->
                <li class="menu-item">
                    <a href="{{ route('manage_tender.index') }}" class="menu-link">
                    <i class="material-icons menu-icon">content_paste</i>
                        <span class="title">Manage Tender</span>
                    </a>
                </li>
               
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="material-icons menu-icon">description</i>
                        <span class="title">Manage Souvenir Module</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('souvenir.index') }}" class="menu-link {{ Request::routeIs('souvenir.index') ? 'active' : '' }}">
                                Manage Master Categories
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('academy_souvenirs.index') }}" class="menu-link {{ Request::routeIs('academy_souvenirs.index') ? 'active' : '' }}">
                                Manage Academy Souvenir
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="material-icons menu-icon">task</i>
                        <span class="title">Manage Course Module</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('subcategory.index')}}" class="menu-link">
                                Manage Course Category/Subcategory
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.courses.index')}}" class="menu-link">
                                Manage Course
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="{{ route('survey.index') }}" class="menu-link">
                    <i class="material-icons menu-icon">inventory</i>
                        <span class="title">Manage Survey List</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('manage_vacancy.index') }}" class="menu-link">
                    <i class="material-icons menu-icon">assignment_ind</i>
                        <span class="title">Manage Vacancy</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                    <i class="material-icons menu-icon">person</i>
                        <span class="title">Manage RTI</span>
                    </a>
                </li>
               
                <li class="menu-item">
                    <a href="{{ route('socialmedia.index') }}" class="menu-link">
                    <i class=" material-icons menu-icon">subscriptions</i>
                        <span class="title">Manage Social Media</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.footer_images.index') }}" class="menu-link">
                    <i class="material-icons menu-icon">person</i>
                        <span class="title">Manage Logo</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="material-icons menu-icon">mediation</i>
                        <span class="title">Manage Media Center</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('admin.slider_list') }}" class="menu-link">
                                Home Banner
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('media-center.index') }}" class="menu-link">
                                Audio Gallery
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('photo-gallery.index') }}" class="menu-link">
                                Photo Gallery
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('video_gallery.index') }}" class="menu-link">
                                Video Gallery
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                Photo Gallery/ Video Gallery
                            </a>
                            <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('media-categories.index') }}" class="menu-link">
                                Add Category
                            </a>
                        </li>
                    </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="{{ route('manage_audit.index') }}" class="menu-link">
                    <i class="material-icons menu-icon">list</i>
                        <span class="title">Manage Audit</span>
                    </a>
                </li>
                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">Micro-Website</span>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="material-icons menu-icon">wysiwyg</i>
                        <span class="title">CMS Page</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Manage Menu
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                    <i class="material-icons menu-icon">add_linka</i>
                        <span class="title">Manage What's New / Quick Links</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                    <i class="material-icons menu-icon">newspaper</i>
                        <span class="title">Manage News</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('training-programs.index') }}" class="menu-link">
                    <i class="material-icons menu-icon">model_training</i>
                        <span class="title">Manage Training Programs</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                    <i class="material-icons menu-icon">corporate_fare</i>
                        <span class="title">Manage Organization Setup</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                    <i class="material-icons menu-icon">assignment_ind</i>
                        <span class="title">Manage Vacancy</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="material-icons menu-icon">mediation</i>
                        <span class="title">Manage Media Center</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Home Banner
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Photo Gallery
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Video Gallery
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                Photo Gallery/ Gallery
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="{{ route('manage_audit.index') }}" class="menu-link">
                        <i data-feather="message-square" class="menu-icon tf-icons"></i>
                        <span class="title">Manage Audit</span>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- <div class="bg-white z-1 admin">
            <div class="d-flex align-items-center admin-info border-top">
                <div class="flex-shrink-0">
                    <a href="profile.html" class="d-block">
                        <img src="{{ asset('admin_assets/images/avatar-14.jpg') }}" class="rounded-circle wh-54" alt="admin">
                    </a>
                </div>
                <div class="flex-grow-1 ms-3 info">
                    <a href="profile.html" class="d-block name">Adison Jeck</a>
                    <a href="logout.html">Log Out</a>
                </div>
            </div>
        </div> -->
        
    </div>