

<?php $__env->startSection('title', 'Academy Souvenir'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Academy Souvenirs List</h2>
    
    <a href="<?php echo e(route('academy_souvenirs.create')); ?>" class="btn btn-primary mb-3">Add Academy Souvenir</a>
    
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Category</th>
                <th>Product Title</th>
                <th>Product Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $souvenirs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $souvenir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($souvenir->id); ?></td>
                <td><?php echo e($souvenir->product_category); ?></td>
                <td><?php echo e($souvenir->product_title); ?></td>
                <td><?php echo e($souvenir->product_type); ?></td>
                <td><?php echo e($souvenir->product_status ? 'Active' : 'Inactive'); ?></td>
                <td>
                    <a href="<?php echo e(route('academy_souvenirs.edit', $souvenir->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="<?php echo e(route('academy_souvenirs.destroy', $souvenir->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/souvenirModule/academy_souvenirs/index.blade.php ENDPATH**/ ?>