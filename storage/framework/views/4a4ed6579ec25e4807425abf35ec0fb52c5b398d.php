
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Add Organiser</h1>

    <form action="<?php echo e(route('organisers.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label>Page Language:</label><br>
            <input type="radio" name="language" value="english" required> English<br>
            <input type="radio" name="language" value="hindi" required> Hindi
        </div>

        <div class="form-group">
            <label for="organiser_name">Organiser Name:</label>
            <input type="text" class="form-control" id="organiser_name" name="organiser_name" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-warning">Reset</button>
        <a href="<?php echo e(route('organisers.index')); ?>" class="btn btn-danger">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/training_master/manage_organiser/create.blade.php ENDPATH**/ ?>