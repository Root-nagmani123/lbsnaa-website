

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Category</h1>

    <form action="<?php echo e(route('souvenir.update', $category->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="<?php echo e($category->type); ?>" required>
        </div>
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo e($category->category_name); ?>" required>
        </div>
        <div class="mb-3">
            <label for="category_name_hindi" class="form-label">Category Name in Hindi</label>
            <input type="text" class="form-control" id="category_name_hindi" name="category_name_hindi" value="<?php echo e($category->category_name_hindi); ?>">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="1" <?php echo e($category->status == 1 ? 'selected' : ''); ?>>Active</option>
                <option value="0" <?php echo e($category->status == 0 ? 'selected' : ''); ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/souvenirModule/edit.blade.php ENDPATH**/ ?>