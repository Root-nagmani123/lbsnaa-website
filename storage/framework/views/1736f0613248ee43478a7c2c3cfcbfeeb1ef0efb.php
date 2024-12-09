

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Edit Slider</h2>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.slider_update', $slider->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group mb-3">
                <label for="image">Slider Image:</label>
                <input type="file" class="form-control" name="image">
                <small>Current Image:</small> <img src="<?php echo e(asset('slider-images/' . $slider->image)); ?>" width="100">
            </div>

            <div class="form-group mb-3">
                <label for="text">Slider Text:</label>
                <input type="text" class="form-control" name="text" value="<?php echo e($slider->text); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Slider Description:</label>
                <textarea name="description" class="form-control" required><?php echo e($slider->description); ?></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="1" <?php echo e($slider->status ? 'selected' : ''); ?>>Active</option>
                    <option value="0" <?php echo e(!$slider->status ? 'selected' : ''); ?>>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Slider</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/home/slider_edit.blade.php ENDPATH**/ ?>