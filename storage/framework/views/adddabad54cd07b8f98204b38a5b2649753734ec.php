
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Manage Organisers</h4>
            
            <a href="<?php echo e(route('organisers.create')); ?>">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Organiser</span>
                    </span>
                </button>
            </a>
        </div>
        <div class="default-table-area members-list">
    <div class="table-responsive">
        <table class="table align-middle" id="myTable">
            <thead>
                <tr class="text-center">
                    <th class="col">ID</th> <!-- Updated to reflect the index -->
                    <th class="col">Section Name</th>
                    <th class="col">Language</th>
                    <th class="col">Status</th>
                    <th class="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $organisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organiser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td> 
                            <td><?php echo e($organiser->organiser_name); ?></td>
                            <td><?php echo e(ucfirst($organiser->language)); ?></td>
                            <td>
                                <?php if($organiser->status == 1): ?>
                                    Active
                                <?php elseif($organiser->status == 2): ?>
                                    Inactive
                                <?php else: ?>
                                    Unknown
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('organisers.edit', $organiser->id)); ?>" class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="<?php echo e(route('organisers.destroy', $organiser->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-primary text-white">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp5\htdocs\lbsnaa_website\resources\views/admin/training_master/manage_organiser/index.blade.php ENDPATH**/ ?>