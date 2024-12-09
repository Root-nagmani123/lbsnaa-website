
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<h2>Audio Gallery</h2>
<a href="<?php echo e(route('media-center.create')); ?>" class="btn btn-primary">Add New Audio</a>

<table class="table">
    <thead>
        <tr>
            <th>Category</th>
            <th>Audio Title (English)</th>
            <th>Audio Title (Hindi)</th>
            <th>Audio File</th>
            <th>Page Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $audios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($audio->category_name); ?></td>
            <td><?php echo e($audio->audio_title_en); ?></td>
            <td><?php echo e($audio->audio_title_hi); ?></td>
            <td><a href="<?php echo e(asset('uploads/audios/'.$audio->audio_upload)); ?>" target="_blank">Play</a></td>
            <td>
                <?php if($audio->page_status == 1): ?>
                    Draft
                <?php elseif($audio->page_status == 2): ?>
                    Approval
                <?php elseif($audio->page_status == 3): ?>
                    Publish
                <?php else: ?>
                    Unknown
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo e(route('media-center.edit', $audio->id)); ?>" class="btn btn-warning">Edit</a>
                <form action="<?php echo e(route('media-center.destroy', $audio->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                    
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp5\htdocs\lbsnaa_website\resources\views/admin/manage_mediacenter/index.blade.php ENDPATH**/ ?>