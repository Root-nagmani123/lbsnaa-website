

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Manage Social Media Links</h2>

    <form action="<?php echo e(route('socialmedia.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="txtename">Title *</label>
            <input type="text" name="txtename" class="form-control" value="<?php echo e($socialMedia->title ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="facebook">Facebook URL *</label>
            <input type="text" name="facebook" class="form-control"  value="<?php echo e($socialMedia->facebook_url ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="twitter">Twitter URL *</label>
            <input type="text" name="twitter" class="form-control" value="<?php echo e($socialMedia->twitter_url ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="googleplus">Youtube URL *</label>
            <input type="text" name="googleplus" class="form-control" value="<?php echo e($socialMedia->youtube_url ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="linkedin">LinkedIn URL *</label>
            <input type="text" name="linkedin" class="form-control" value="<?php echo e($socialMedia->linkedin_url ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="txtstatus">Page Status *</label>
            <select name="txtstatus" class="form-control" requireds>
                <option value="1" <?php echo e(isset($socialMedia) && $socialMedia->status == 1 ? 'selected' : ''); ?>>Draft</option>
                <option value="2" <?php echo e(isset($socialMedia) && $socialMedia->status == 2 ? 'selected' : ''); ?>>Approval</option>
                <option value="3" <?php echo e(isset($socialMedia) && $socialMedia->status == 3 ? 'selected' : ''); ?>>Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/socialmedia/index.blade.php ENDPATH**/ ?>