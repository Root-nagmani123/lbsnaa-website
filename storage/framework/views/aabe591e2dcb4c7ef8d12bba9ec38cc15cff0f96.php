
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">View Profile</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">View Profile</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="welcome-farol card border-0 rounded-0 rounded-top-3 position-relative" style="background-color:#af2910;">
                    <div class="card-body p-4 pb-5 my-2">
                        <div class="mw-350">
                            <h3 class="text-white fw-semibold fs-20 mb-2">Welcome to LBSNAA Dashboard !</h3>
                        </div>
                    </div>
                </div>
                <div class="stats-box style-eight bg-white card border-0 rounded-0 rounded-bottom-3 mb-4">
                    <div class="card-body p-4 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="profile-img">
                                <img src="<?php echo e(asset('admin_assets/images/avatar-14.jpg')); ?>"
                                    class="rounded-circle border border-2 border-white wh-57 mb-4" alt="user">
                                <h4 class="fs-16 fw-semibold mb-1">Viru</h4>
                                <span class="fs-14">Super Admin</span> <br>
                                <span class="fs-14">Login ID:- <?php echo e($user->name ?? 'N/A'); ?></span> <br>
                                <span class="fs-14">Email ID:- <?php echo e($user->email ?? 'N/A'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                            <h4 class="fw-semibold fs-18 mb-0">Personal Information</h4>
                        </div>

                        <ul class="ps-0 mb-0 list-unstyled">
                            <li class="border-bottom border-color-gray mb-3 pb-3">
                                <span class="fw-semibold text-dark w-130 d-inline-block">Full Name :</span>
                                <span>Viru</span>
                            </li>
                            <li class="border-bottom border-color-gray mb-3 pb-3">
                                <span class="fw-semibold text-dark w-130 d-inline-block">Mobile :</span>
                                <a href="tel:(123)1231234" class="text-decoration-none">(123) 123 1234</a>
                            </li>
                            <li class="border-bottom border-color-gray mb-3 pb-3">
                                <span class="fw-semibold text-dark w-130 d-inline-block">Email :</span>
                                <a href="mailto:#"
                                    class="text-decoration-none">admin@lbsnaa.nic.in</a>
                            </li>
                            <li class="border-bottom border-color-gray mb-3 pb-3">
                                <span class="fw-semibold text-dark w-130 d-inline-block">Location :</span>
                                <span>Mussoorie, Uttrakhand, India</span>
                            </li>
                            <li>
                                <span class="fw-semibold text-dark w-130 d-inline-block">Designation :</span>
                                <span>Super Admin</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp5\htdocs\lbsnaa_website\resources\views/admin/manage_profile/index.blade.php ENDPATH**/ ?>