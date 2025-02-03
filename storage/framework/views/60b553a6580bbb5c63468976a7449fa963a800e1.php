<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Last Activity</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Activity</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
<div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Activity</h4>
            </div>
        <div class="default-table-area members-list">
    <div class="table-responsive">
        <table class="table align-middle" id="myTable">
            <thead>
                <tr class="text-center">
                    <th class="col">#</th>
                    <th class="col">Name</th>
                    <th class="col">Login ID</th>
                    <th class="col">Date</th>
                    <th class="col">Action</th>
                    <th class="col">IP Address</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;?>
        <?php $__currentLoopData = $recentLogins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $login): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i); ?></td>
                <td><?php echo e($login->user_name); ?></td>
                <td><?php echo e($login->login_id); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($login->login_time)->format('d-m-Y H:i:s')); ?></td>
                <td><?php echo e($login->action); ?></td>
                <td><?php echo e($login->ip_address); ?></td>
            </tr>
            <?php $i++;?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
        </table>
    </div>
</div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/admin/layouts/dashboard.blade.php ENDPATH**/ ?>