
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <h2>Edit Event</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('manage_events.update', $event->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label>Page Language:</label>
            <div>
                <label><input type="radio" name="language" value="English" <?php echo e(old('language', $event->language) == 'English' ? 'checked' : ''); ?>> English</label>
                <label><input type="radio" name="language" value="Hindi" <?php echo e(old('language', $event->language) == 'Hindi' ? 'checked' : ''); ?>> Hindi</label>
            </div>
        </div>

        <div class="form-group">
            <label>Event Title:</label>
            <input type="text" name="event_title" class="form-control" value="<?php echo e(old('event_title', $event->event_title)); ?>">
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control ckeditor"><?php echo e(old('description', $event->description)); ?></textarea>
        </div>

        <div class="form-group">
            <label>Course:</label>
            <select name="course_id" class="form-control">
                <option value="">Select Course</option>
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($course->id); ?>" <?php echo e(old('course_id', $event->course_id) == $course->id ? 'selected' : ''); ?>>
                        <?php echo e($course->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" value="<?php echo e(old('start_date', $event->start_date)); ?>">
        </div>

        <div class="form-group">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" value="<?php echo e(old('end_date', $event->end_date)); ?>">
        </div>

        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="Draft" <?php echo e(old('status', $event->status) == 'Draft' ? 'selected' : ''); ?>>Draft</option>
                <option value="Approval" <?php echo e(old('status', $event->status) == 'Approval' ? 'selected' : ''); ?>>Approval</option>
                <option value="Publish" <?php echo e(old('status', $event->status) == 'Publish' ? 'selected' : ''); ?>>Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo e(route('manage_events.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
<?php $__env->stopSection(); ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="start_date"]').setAttribute('min', today);
        document.querySelector('input[name="end_date"]').setAttribute('min', today);
    });
</script>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/manage_events/edit.blade.php ENDPATH**/ ?>