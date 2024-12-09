

<?php $__env->startSection('content'); ?>
<h1>Course List</h1>
<a href="<?php echo e(route('admin.courses.create')); ?>" class="btn btn-primary">Add Course</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Abbreviation</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($course->id); ?></td>
            <td><?php echo e($course->course_name); ?></td>
            <td><?php echo e($course->abbreviation); ?></td>
            <td>
                <a href="<?php echo e(route('admin.courses.edit', $course->id)); ?>" class="btn btn-warning">Edit</a>
                <form action="<?php echo e(route('admin.courses.destroy', $course->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/courses/index.blade.php ENDPATH**/ ?>