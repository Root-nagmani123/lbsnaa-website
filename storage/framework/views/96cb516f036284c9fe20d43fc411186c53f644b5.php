

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Sections</h1>
    <a href="<?php echo e(route('sections.create')); ?>" class="btn btn-primary">Add Section</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Section Title</th>
                <th>View</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($section->id); ?></td>
                <td><?php echo e($section->title); ?></td>
                <td><a href="<?php echo e(route('admin.section_category.index', $section->id)); ?>" class="">Click Here</a></td>
                <td><?php echo e($section->status ? 'Active' : 'Inactive'); ?></td>
                <td>
                    <a href="<?php echo e(route('sections.edit', $section->id)); ?>" class="btn btn-warning">Edit</a>
                    <form action="<?php echo e(route('sections.destroy', $section->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/sections/index.blade.php ENDPATH**/ ?>