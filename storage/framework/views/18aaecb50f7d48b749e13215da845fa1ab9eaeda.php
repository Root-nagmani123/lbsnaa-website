

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col">
        <h2>Edit News</h2>
        <form action="<?php echo e(route('admin.news.update', $news->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="title">News Title *</label>
                <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $news->title)); ?>" required>
            </div>

            <div class="form-group">
                <label for="short_description">News Short Description *</label>
                <textarea name="short_description" class="form-control" required><?php echo e(old('short_description', $news->short_description)); ?></textarea>
            </div>

            <div class="form-group">
                <label for="meta_title">Meta Title *</label>
                <input type="text" name="meta_title" class="form-control" value="<?php echo e(old('meta_title', $news->meta_title)); ?>" required>
            </div>

            <div class="form-group">
                <label for="meta_keywords">Meta Keyword</label>
                <input type="text" name="meta_keywords" class="form-control" value="<?php echo e(old('meta_keywords', $news->meta_keywords)); ?>">
            </div>

            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea name="meta_description" class="form-control"><?php echo e(old('meta_description', $news->meta_description)); ?></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea name="description" class="form-control" required><?php echo e(old('description', $news->description)); ?></textarea>
            </div>

            <div class="form-group">
                <label for="main_image">Upload Main Image *</label>
                <input type="file" name="main_image" class="form-control" accept="image/*">
                <small>Current: <img src="<?php echo e(asset( $news->main_image)); ?>" alt="Current Image" style="max-width: 150px;"></small>
            </div>

            <div class="form-group">
                <label for="multiple_images">Upload Multiple Images</label>
                <input type="file" name="multiple_images[]" class="form-control" accept="image/*" multiple>
                <small>Current Images: 
                    <?php $__currentLoopData = json_decode($news->multiple_images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(asset($image)); ?>" alt="Current Image" style="max-width: 150px; margin: 5px;">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </small>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date *</label>
                <input type="date" name="start_date" class="form-control" value="<?php echo e(old('start_date', $news->start_date)); ?>" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" value="<?php echo e(old('end_date', $news->end_date)); ?>">
            </div>

            <div class="form-group">
                <label for="status">News Status</label>
                <select name="status" class="form-control">
                    <option value="1" <?php echo e($news->status == 1 ? 'selected' : ''); ?>>Active</option>
                    <option value="0" <?php echo e($news->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update News</button>
            <a href="<?php echo e(route('admin.news.index')); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/news/edit.blade.php ENDPATH**/ ?>