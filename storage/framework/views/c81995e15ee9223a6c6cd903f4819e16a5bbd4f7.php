
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <h2>All Events</h2>
    <a href="<?php echo e(route('manage_events.create')); ?>" class="btn btn-primary">Add Event</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th> <!-- New column for index -->
                <th>Language</th>
                <th>Title</th>
                <th>Course</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <!-- Use $index to track the iteration -->
                <tr>
                    <td><?php echo e($index + 1); ?></td> <!-- Display the index + 1 for human-readable numbering -->
                    <td><?php echo e($event->language); ?></td>
                    <td><?php echo e($event->event_title); ?></td>
                    <td><?php echo e($event->course->name ?? 'N/A'); ?></td>
                    <td><?php echo e($event->start_date); ?></td>
                    <td><?php echo e($event->end_date); ?></td>
                    <td><?php echo e($event->status); ?></td>
                    <td>
                        <a href="<?php echo e(route('manage_events.edit', $event->id)); ?>" class="btn btn-warning">Edit</a>
                        <form action="<?php echo e(route('manage_events.destroy', $event->id)); ?>" method="POST" style="display:inline;">
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/manage_events/index.blade.php ENDPATH**/ ?>