<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="#!" class="d-block text-decoration-none">
            <img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" alt="logo-icon" width="220">
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
                <span class="menu-title-text">Main Website
                    <?php $permisson = permisson_navigation(); //print_r($permisson); ?></span>
            </li>
            <li class="menu-item open">
                <a href="<?php echo e(route('admin.index')); ?>"
                    class="menu-link <?php echo e(Request::routeIs('admin.index') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">dashboard</i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <?php
            $isManageUserAllowed = in_array('User Management', array_column($permisson->toArray(), 'parent')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li
                class="menu-item <?php echo e(Request::url() == url('/admin/users') || Request::url() == url('/admin/module') ? 'open' : ''); ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('/admin/users') || Request::url() == url('/admin/module') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">supervisor_account</i>
                    <span class="title">User Management</span>
                </a>

                <ul class="menu-sub">
                    <?php
                    $isManageUserAllowed = in_array('Manage User', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open
">
                        <a href="<?php echo e(route('users.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/users') ? 'active' : ''); ?>">
                            Manage User
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageModuleAllowed = in_array('Manage Module', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageModuleAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('UserManagement.module')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/module') ? 'active' : ''); ?>">
                            Manage Module
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>

            <?php endif; ?>

            <li class="menu-item open">
                <a href="<?php echo e(route('view-profile.index')); ?>"
                    class="menu-link <?php echo e(Request::routeIs('view-profile.index') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">badge</i>
                    <span class="title">View Profile</span>
                </a>
            </li>
            <?php
            $isManageUserAllowed = in_array('Manage CMS', array_column($permisson->toArray(), 'parent')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item <?php echo e(Request::url() == url('/admin/menu') ? 'open' : ''); ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('admin/menu') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">wysiwyg</i>
                    <span class="title">CMS Page</span>
                </a>
                <?php
                $isManageUserAllowed = in_array('Manage Menu', array_column($permisson->toArray(), 'child')) ||
                (Auth::check() && Auth::user()->user_type == 1);
                ?>

                <?php if($isManageUserAllowed): ?>
                <ul class="menu-sub">
                    <li class="menu-item open">
                        <a href="<?php echo e(route('admin.menus.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/menu') ? 'active' : ''); ?>">
                            Manage Menu
                        </a>
                    </li>
                </ul>
                <?php endif; ?>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Manage Organization Module', array_column($permisson->toArray(), 'parent'))
            ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item <?php echo e(Request::url() == url('/admin/organisation_chart') || Request::url() == url('/admin/faculty') || Request::url() == url('/admin/staff') || Request::url() == url('/admin/sections') ? 'open' : ''); ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('/admin/organisation_chart') || Request::url() == url('/admin/faculty') || Request::url() == url('/admin/staff') || Request::url() == url('/admin/sections') ? 'active' : ''); ?>"><i
                        class="material-icons menu-icon">corporate_fare
                    </i>
                    <span class="title">Manage Organization Module</span>
                </a>
                <ul class="menu-sub">
                    <?php
                    $isManageUserAllowed = in_array('Manage Organization Chart', array_column($permisson->toArray(),
                    'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('organisation_chart.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/organisation_chart') ? 'active' : ''); ?>">
                            Manage Organization Chart
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Faculty', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('admin.faculty.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/faculty') ? 'active' : ''); ?>">
                            Manage Faculty
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Staff', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('admin.staff.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/staff') ? 'active' : ''); ?>">
                            Manage Staff
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Sections', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('sections.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/sections') ? 'active' : ''); ?>">
                            Manage Sections
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Training Master Management', array_column($permisson->toArray(), 'parent'))
            ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>

            <li class="menu-item <?php echo e(Request::url() == url('/admin/organisers') || Request::url() == url('/admin/coordinators') || Request::url() == url('/admin/venues') || Request::url() == url('/admin/founders') || Request::url() == url('/admin/cadres') || Request::url() == url('/admin/category') || Request::url() == url('/admin/country') || Request::url() == url('/admin/state') || Request::url() == url('/admin/district') || Request::url() == url('/admin/exam') ? 'open' : ''); ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('/admin/organisers') || Request::url() == url('/admin/coordinators') || Request::url() == url('/admin/venues') || Request::url() == url('/admin/founders') || Request::url() == url('/admin/cadres') || Request::url() == url('/admin/category') || Request::url() == url('/admin/country') || Request::url() == url('/admin/state') || Request::url() == url('/admin/district') || Request::url() == url('/admin/exam') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">model_training</i>
                    <span class="title">Training Master Management</span>
                </a>

                <ul class="menu-sub">


                    <?php
                    $isManageUserAllowed = in_array('Manage Organiser', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('organisers.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/organisers') ? 'active' : ''); ?>">
                            Manage Organiser
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Coordinator', array_column($permisson->toArray(), 'child'))
                    ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('coordinators.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/coordinators') ? 'active' : ''); ?>">
                            Manage Coordinator
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Venue', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('venues.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/venues') ? 'active' : ''); ?>">
                            Manage Venue
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Founder', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('founders.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/founders') ? 'active' : ''); ?>">
                            Manage Founder
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Cadre', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('cadres.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/cadres') ? 'active' : ''); ?>">
                            Manage Cadre
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Category', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('category.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/category') ? 'active' : ''); ?>">
                            Manage Category
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Country', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('country.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/country') ? 'active' : ''); ?>">
                            Manage Country
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage State', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('state.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/state') ? 'active' : ''); ?>">
                            Manage State
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Districts', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('district.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/district') ? 'active' : ''); ?>">
                            Manage Districts
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Exam', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('exam.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/exam') ? 'active' : ''); ?>">
                            Manage Exam
                        </a>
                    </li>
                    <?php endif; ?>

                </ul>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Manage News', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('admin.news.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/admin/news') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">newspaper</i>
                    <span class="title">Manage News</span>
                </a>
            </li>
            <?php endif; ?>

            <?php
            $isManageUserAllowed = in_array('Quick Links', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('admin.quick_links.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/quick-links') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">add_linka</i>
                    <span class="title">Quick Links</span>
                </a>
            </li> <?php endif; ?>

            <?php
            $isManageUserAllowed = in_array('Manage Tender', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('manage_tender.index')); ?>"
                    class="menu-link <?php echo e(Request::routeIs('manage_tender.index') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">content_paste</i>
                    <span class="title">Manage Tender</span>
                </a>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed_p = in_array('Manage Souvenir Module', array_column($permisson->toArray(), 'parent'))
            ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed_p): ?>
            <li class="menu-item <?php echo e(Request::url() == url('/admin/souvenir') || Request::url() == url('/admin/academy-souvenirs') ? 'open' : ''); ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('/admin/souvenir') || Request::url() == url('/admin/academy-souvenirs') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">description</i>
                    <span class="title">Manage Souvenir Module</span>
                </a>
                <ul class="menu-sub">

                    <?php
                    $isManageUserAllowed = in_array('Manage Master Categories', array_column($permisson->toArray(),
                    'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('souvenir.index')); ?>"
                            class="menu-link <?php echo e(Request::url() == url('admin/souvenir') ? 'active' : ''); ?>">
                            Manage Master Categories
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Academy Souvenir', array_column($permisson->toArray(),
                    'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('academy_souvenirs.index')); ?>"
                            class="menu-link <?php echo e(Request::url() == url('admin/academy-souvenirs') ? 'active' : ''); ?>">
                            Manage Academy Souvenir
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed_p = in_array('Manage Course Module', array_column($permisson->toArray(), 'parent')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed_p): ?>
            <li class="menu-item <?php echo e(Request::url() == url('/admin/subcategory') || Request::url() == url('/admin/courses') ? 'open' : ''); ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('/admin/subcategory') || Request::url() == url('/admin/courses') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">task</i>
                    <span class="title">Manage Course Module</span>
                </a>
                <ul class="menu-sub">

                    <?php
                    $isManageUserAllowed = in_array('Manage Course Category/Subcategory',
                    array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('subcategory.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/subcategory') ? 'active' : ''); ?>">
                            Manage Course Category/Subcategory
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Manage Course', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('admin.courses.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/courses') ? 'active' : ''); ?>">
                            Manage Course
                        </a>
                    </li>
                    <?php endif; ?>

                </ul>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Manage Survey List', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('survey.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/survey') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">inventory</i>
                    <span class="title">Manage Survey List</span>
                </a>
            </li>
            <?php endif; ?>

            <?php
            $isManageUserAllowed = in_array('Manage Vacancy', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('manage_vacancy.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/manage_vacancy') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">assignment_ind</i>
                    <span class="title">Manage Vacancy</span>
                </a>
            </li>

            <?php endif; ?>

            <?php
            $isManageUserAllowed = in_array('Manage Social Media', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>

            <li class="menu-item open">
                <a href="<?php echo e(route('socialmedia.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/socialmedia') ? 'active' : ''); ?>">
                    <i class=" material-icons menu-icon">subscriptions</i>
                    <span class="title">Manage Social Media</span>
                </a>
            </li>
            <?php endif; ?>

            <?php
            $isManageUserAllowed = in_array('Manage Logo', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('admin.footer_images.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/footer-images') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">person</i>
                    <span class="title">Manage Logo</span>
                </a>
            </li>
            <?php endif; ?>


            <?php
            $isManageUserAllowed = in_array('Screen Reader Access', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('admin.screen_reader')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/screen_reader_data') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">chrome_reader_mode</i>
                    <span class="title">Screen Reader Access</span>
                </a>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Feedback List', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('admin.feedback_list')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/feedback-list') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">chat</i>
                    <span class="title">Feedback List</span>
                </a>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed_p = in_array('Manage Media Center', array_column($permisson->toArray(), 'parent')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed_p): ?>
            <li class="menu-item <?php echo e(Request::url() == url('/admin/sliders') || Request::url() == url('/admin/media-center') || Request::url() == url('/admin/photo-gallery') || Request::url() == url('/admin/video_gallery') || Request::url() == url('/admin/media-categories') ? 'open' : ''); ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('/admin/sliders') || Request::url() == url('/admin/media-center') || Request::url() == url('/admin/photo-gallery') || Request::url() == url('/admin/video_gallery') || Request::url() == url('/admin/media-categories') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">mediation</i>
                    <span class="title">Manage Media Center</span>
                </a>
                <ul class="menu-sub">


                    <?php
                    $isManageUserAllowed = in_array('Home Banner', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('admin.slider_list')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/sliders') ? 'active' : ''); ?>">
                            Home Banner
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Audio Gallery', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('media-center.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/media-center') ? 'active' : ''); ?>">
                            Audio Gallery
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Photo Gallery', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('photo-gallery.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/photo-gallery') ? 'active' : ''); ?>">
                            Photo Gallery
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Video Gallery', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('video_gallery.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/video_gallery') ? 'active' : ''); ?>">
                            Video Gallery
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    $isManageUserAllowed = in_array('Add Category', array_column($permisson->toArray(), 'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item <?php echo e(Request::url() == url('/admin/media-categories') ? 'open' : ''); ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('/admin/media-categories') ? 'active' : ''); ?>">
                            Photo Gallery/ Video Gallery
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item open">
                                <a href="<?php echo e(route('media-categories.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/media-categories') ? 'active' : ''); ?>">
                                    Add Category
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Manage Audit', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('manage_audit.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/manage-audit') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">list</i>
                    <span class="title">Manage Audit</span>
                </a>
            </li>
            <?php endif; ?>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">Micro-Website</span>
            </li>
            <?php
            $isManageUserAllowed = in_array('Research Center', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('researchcentres.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/researchcentres') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">hub</i>
                    <span class="title">Research Center</span>
                </a>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Mirco Manage Menu', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item <?php echo e(Request::url() == url('/admin/micromenu') ? 'open' : ''); ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('/admin/micromenu') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">wysiwyg</i>
                    <span class="title">CMS Page</span>
                </a>

                <ul class="menu-sub open">
                    <li class="menu-item">
                        <a href="<?php echo e(route('micromenus.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/micromenu') ? 'active' : ''); ?>">
                            Mirco Manage Menu
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Micro Quick Links', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('microquicklinks.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/microquick-links') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">add_linka</i>
                    <span class="title">Micro Quick Links</span>
                </a>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Mirco Manage News', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('Managenews.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/Managenews') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">newspaper</i>
                    <span class="title">Mirco Manage News</span>
                </a>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Manage Training Programs', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('training-programs.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/training-programs') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">model_training</i>
                    <span class="title">Manage Training Programs</span>
                </a>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Manage Organization Setup', array_column($permisson->toArray(), 'child'))
            ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('non_org.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/non_org') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">corporate_fare</i>
                    <span class="title">Manage Organization Setup</span>
                </a>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Mirco Manage Vacancy', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('micro_manage_vacancy.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/micro_manage_vacancy') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">assignment_ind</i>
                    <span class="title">Mirco Manage Vacancy</span>
                </a>
            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed_p = in_array('Mirco Manage Media Center', array_column($permisson->toArray(),
            'parent'))
            ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed_p): ?>
            <li class="menu-item <?php echo e(Request::url() == url('/admin/slider') || Request::url() == url('/admin/micro-photo-gallery') || Request::url() == url('/admin/micro-video-gallery') || Request::url() == url('/admin/photovideogallery') ? 'open' : ''); ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('/admin/slider') || Request::url() == url('/admin/micro-photo-gallery') || Request::url() == url('/admin/micro-video-gallery') || Request::url() == url('/admin/photovideogallery') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">mediation</i>
                    <span class="title">Mirco Manage Media Center</span>
                </a>
                <ul class="menu-sub">
                    <?php
                    $isManageUserAllowed = in_array('Mirco Home Banner', array_column($permisson->toArray(), 'child'))
                    ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('slider.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/slider') ? 'active' : ''); ?>">
                            Mirco Home Banner
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php
                    $isManageUserAllowed = in_array('Mirco Photo Gallery', array_column($permisson->toArray(), 'child'))
                    ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('micro-photo-gallery.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/micro-photo-gallery') ? 'active' : ''); ?>">
                            Mirco Photo Gallery
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php
                    $isManageUserAllowed = in_array('Mirco Video Gallery', array_column($permisson->toArray(), 'child'))
                    ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item open">
                        <a href="<?php echo e(route('micro-video-gallery.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/micro-video-gallery') ? 'active' : ''); ?>">
                            Mirco Video Gallery
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php
                    $isManageUserAllowed = in_array('Mirco Add Category', array_column($permisson->toArray(),
                    'child')) ||
                    (Auth::check() && Auth::user()->user_type == 1);
                    ?>

                    <?php if($isManageUserAllowed): ?>
                    <li class="menu-item <?php echo e(Request::url() == url('admin/photovideogallery') ? 'open' : ''); ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle <?php echo e(Request::url() == url('admin/photovideogallery') ? 'active' : ''); ?>">
                            Mirco Photo Gallery/ Video Gallery
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item open">
                                <a href="<?php echo e(route('photovideogallery.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/photovideogallery') ? 'open' : ''); ?>">
                                    Mirco Add Category
                                </a>
                            </li>
                        </ul>

                    </li>
                    <?php endif; ?>
                </ul>

            </li>
            <?php endif; ?>
            <?php
            $isManageUserAllowed = in_array('Micro Manage Audit', array_column($permisson->toArray(), 'child')) ||
            (Auth::check() && Auth::user()->user_type == 1);
            ?>

            <?php if($isManageUserAllowed): ?>
            <li class="menu-item open">
                <a href="<?php echo e(route('micro_manage_audit.index')); ?>" class="menu-link <?php echo e(Request::url() == url('admin/micro_manage_audit') ? 'active' : ''); ?>">
                    <i class="material-icons menu-icon">list</i>
                    <span class="title">Micro Manage Audit</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </aside>
</div><?php /**PATH C:\xampp11\htdocs\lbsnaa-website\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>