

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Manage State</h1>
    <a href="<?php echo e(route('state.create')); ?>" class="btn btn-primary">Add State</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>State Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($state->id); ?></td>
                <td><?php echo e($state->state_name); ?></td>
                <td><?php echo e($state->status ? 'Active' : 'Inactive'); ?></td>
                <td>
                    <a href="<?php echo e(route('state.edit', $state->id)); ?>" class="btn btn-warning">Edit</a>
                    <form action="<?php echo e(route('state.destroy', $state->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/manage_state/index.blade.php ENDPATH**/ ?>