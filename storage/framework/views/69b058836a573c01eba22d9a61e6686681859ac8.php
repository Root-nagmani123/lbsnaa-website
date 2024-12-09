

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<h1>News and Updates</h1>
<a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-primary">Add News</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Start Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->title); ?></td>
            <td><?php echo e($item->start_date); ?></td>
            <td><?php echo e($item->status ? 'Active' : 'Inactive'); ?></td>
            <td>
                <a href="<?php echo e(route('admin.news.edit', $item->id)); ?>" class="btn btn-warning">Edit</a>
                <form action="<?php echo e(route('admin.news.destroy', $item->id)); ?>" method="POST" style="display:inline;">
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/news/index.blade.php ENDPATH**/ ?>