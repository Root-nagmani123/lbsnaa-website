



<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Section</h1>
    <form action="<?php echo e(route('sections.update', $section->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="title">Section Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo e($section->title); ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-control" required>
                <option value="1" <?php echo e($section->status ? 'selected' : ''); ?>>Active</option>
                <option value="0" <?php echo e(!$section->status ? 'selected' : ''); ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Section</button>
        <a href="<?php echo e(route('sections.index')); ?>" class="btn btn-secondary">Back</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/sections/edit.blade.php ENDPATH**/ ?>