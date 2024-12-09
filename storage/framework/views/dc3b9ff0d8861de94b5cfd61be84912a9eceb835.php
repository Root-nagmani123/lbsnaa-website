
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Audit Logs</h3>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="default-table-area members-list">
    <div class="table-responsive">
        <table class="table align-middle" id="myTable">
            <thead>
                <tr class="text-center">
                    <th class="col">ID</th>
                    <th class="col">Module Name / Page Name</th>
                    <th class="col">Time Stamp</th>
                    <th class="col">Created By</th>
                    <th class="col">Updated By</th>
                    <th class="col">Login/Logout/Login Failed</th>
                    <th class="col">IP Address</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $audits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $audit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <!-- Use $index for the incrementing index -->
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td> <!-- Auto-incrementing index -->
                            <td><?php echo e($audit->Module_Name); ?></td>
                            <td><?php echo e(date('Y-m-d H:i:s', strtotime($audit->Time_Stamp))); ?></td>
                            <td><?php echo e($audit->Created_By); ?></td>
                            <td><?php echo e($audit->Updated_By); ?></td>
                            <td><?php echo e($audit->Action_Type); ?></td>
                            <td><?php echo e($audit->IP_Address); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp5\htdocs\lbsnaa_website\resources\views/admin/manage_audit/index.blade.php ENDPATH**/ ?>