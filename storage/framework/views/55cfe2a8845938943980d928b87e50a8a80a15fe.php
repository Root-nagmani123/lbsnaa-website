 <header class="header-area bg-white mb-4 rounded-bottom-10" id="header-area">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-sm-6 col-md-4">
                        <div class="left-header-content">
                            <ul
                                class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                                <li>
                                    <button class="header-burger-menu bg-transparent p-0 border-0"
                                        id="header-burger-menu">
                                        <i data-feather="menu"></i>
                                    </button>
                                </li>
                                <!-- <li>
                                    <form class="src-form position-relative">
                                        <input type="text" class="form-control" placeholder="Search here..">
                                        <button type="submit"
                                            class="src-btn position-absolute top-50 end-0 translate-middle-y bg-transparent p-0 border-0">
                                            <i data-feather="search"></i>
                                        </button>
                                    </form>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-6 col-md-8">
                        <div class="right-header-content mt-2 mt-sm-0">
                            <ul
                                class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">
                                <li class="header-right-item">
                                    <div class="dropdown admin-profile">
                                        <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor"
                                            data-bs-toggle="dropdown">
                                            <div class="flex-shrink-0">
                                                <img class="rounded-circle wh-54" src="<?php echo e(asset('admin_assets/images/avatar-14.jpg')); ?>" 
                                                    alt="admin">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-none d-xxl-block">
                                                        <span class="degeneration">Super Admin</span>
                                                        <div class="d-flex align-content-center">
                                                            <h3>Viru</h3>
                                                            <div class="down">
                                                                <i data-feather="chevron-down"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="dropdown-menu border-0 bg-white w-100 admin-link">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center text-body"
                                                    href="<?php echo e(route('view-profile.index')); ?>">
                                                    <i data-feather="user"></i>
                                                    <span class="ms-2">View Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center text-body"
                                                    href="<?php echo e(route('change_password')); ?>">
                                                    <i data-feather="tool"></i>
                                                    <span class="ms-2">Change Password</span>
                                                </a>
                                            </li>
                                            <li>
                                                    <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                    </form>
                                                    
                                                    <a class="dropdown-item d-flex align-items-center text-body"
                                                    href="#"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <i data-feather="log-out"></i>
                                                        <span class="ms-2">Logout</span>
                                                    </a>
                                                </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/layouts/header.blade.php ENDPATH**/ ?>