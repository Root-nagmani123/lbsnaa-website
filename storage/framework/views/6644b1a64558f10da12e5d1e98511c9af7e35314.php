

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container"> 
    <h1>Sections</h1>
    <a href="<?php echo e(route('admin.section_category.create',$id)); ?>" class="btn btn-primary">Add Section</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>description</th>
                <th>officer_Incharge</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($section->name); ?></td>
                <td><?php echo e($section->description); ?></td>
                <td><?php echo e($section->officer_Incharge); ?></td>
                
                <td><?php echo e($section->status ? 'Active' : 'Inactive'); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.section_category.edit', $section->id)); ?>" class="btn btn-warning">Edit</a>
                    <form action="<?php echo e(route('admin.section_category.destroy', $section->id, $id)); ?>" method="POST" style="display:inline;">
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/sections/section_category/index.blade.php ENDPATH**/ ?>