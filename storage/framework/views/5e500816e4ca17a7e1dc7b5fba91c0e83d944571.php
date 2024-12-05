
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Manage Organisers</h2>

    <a href="<?php echo e(route('organisers.create')); ?>" class="btn btn-primary">Add Organiser</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th> <!-- Updated to reflect the index -->
                <th>Section Name</th>
                <th>Language</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $organisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organiser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <!-- Use $loop->iteration to auto-increment the index -->
                <td><?php echo e($loop->iteration); ?></td> 
                <td><?php echo e($organiser->organiser_name); ?></td>
                <td><?php echo e(ucfirst($organiser->language)); ?></td>
                <td><?php echo e(ucfirst($organiser->status)); ?></td>
                <td>
                    <a href="<?php echo e(route('organisers.edit', $organiser->id)); ?>" class="btn btn-warning">Edit</a>

                    <form action="<?php echo e(route('organisers.destroy', $organiser->id)); ?>" method="POST" style="display:inline-block;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/training_master/manage_organiser/index.blade.php ENDPATH**/ ?>