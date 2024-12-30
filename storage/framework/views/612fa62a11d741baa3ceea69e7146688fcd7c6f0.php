

<?php $__env->startSection('title', 'Sub Organisation Chart'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Chart</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Organization Chart</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Sub Organization Chart</h4>

            <a href="<?php echo e(route('organisation_chart.create')); ?>?parent_id=<?php echo e($parent_id); ?>">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Employee</span>
                    </span>
                </button>
            </a>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Employee Name</th>
                            <th class="col">Sub org.</th>
                            <th class="col">Parent</th>
                            <th class="col">Description</th>
                            <th class="col">Status</th>
                            <th class="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($records->isEmpty()): ?>
                        <div class="alert alert-warning text-center" role="alert" colspan="6" class="text-center">
                            No records found
                        </div>
                        <?php else: ?>
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($record->employee_name); ?></td>
                            <td><a href="<?php echo e(route('organisation-chart.sub-org', ['parent_id' => $record->id])); ?>"
                                    class="btn btn-secondary btn-sm text-white">click here</a></td>
                            <td><?php echo e($employeeNames); ?></td>
                            <td><?php echo e($record->description); ?></td>
                            <td>
                                <a href="<?php echo e(route('organisation_chart.edit', $record->id)); ?>"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <!-- <form action="<?php echo e(route('organisation-chart.destroy', $record->id)); ?>" method="POST"
                                    style="display:inline;"> -->
                                    <form action="<?php echo e(route('organisation-chart.destroy', $record->id)); ?>" method="POST"
                                    style="display:inline;">
                                    
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-primary text-white">Delete</button>
                                </form>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="organisation_chart" data-column="status" data-id="<?php echo e($record->id); ?>"
                                        <?php echo e($record->status ? 'checked' : ''); ?>>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/manage_organisationchart/sub_org.blade.php ENDPATH**/ ?>