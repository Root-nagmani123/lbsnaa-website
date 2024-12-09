
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <h2>Add Event</h2>

    <form action="<?php echo e(route('manage_events.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>Page Language:</label><br>
            <label><input type="radio" name="language" value="English" <?php echo e(old('language') == 'English' ? 'checked' : ''); ?>> English</label>
            <label><input type="radio" name="language" value="Hindi" <?php echo e(old('language') == 'Hindi' ? 'checked' : ''); ?>> Hindi</label>
            <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Event Title:</label>
            <input type="text" name="event_title" class="form-control" value="<?php echo e(old('event_title')); ?>">
            <?php $__errorArgs = ['event_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control ckeditor"><?php echo e(old('description')); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Course:</label>
            <select name="course_id" class="form-control">
                <option value="">Select Course</option>
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($course->id); ?>" <?php echo e(old('course_id') == $course->id ? 'selected' : ''); ?>><?php echo e($course->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['course_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>


        <div class="form-group">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" value="<?php echo e(old('start_date')); ?>">
            <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" value="<?php echo e(old('end_date')); ?>">
            <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>





        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control">
            	<option value="">Select</option>
                <option value="Draft" <?php echo e(old('status') == 'Draft' ? 'selected' : ''); ?>>Draft</option>
                <option value="Approval" <?php echo e(old('status') == 'Approval' ? 'selected' : ''); ?>>Approval</option>
                <option value="Publish" <?php echo e(old('status') == 'Publish' ? 'selected' : ''); ?>>Publish</option>
            </select>
            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="<?php echo e(route('manage_events.index')); ?>" class="btn btn-danger">Cancel</a>
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



<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/manage_events/create.blade.php ENDPATH**/ ?>