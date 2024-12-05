
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">All Events</h4>

            <a href="<?php echo e(route('manage_events.create')); ?>">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Event</span>
                    </span>
                </button>
            </a>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
        <div class="default-table-area members-list recent-orders">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">ID</th> <!-- New column for index -->
                            <th class="col">Language</th>
                            <th class="col">Title</th>
                            <th class="col">Course</th>
                            <th class="col">Start Date</th>
                            <th class="col">End Date</th>
                            <th class="col">Status</th>
                            <th class="col">Actions</th>
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
                            <td>
                                <?php if($event->status == 1): ?>
                                    Draft
                                <?php elseif($event->status == 2): ?>
                                    Approval
                                <?php elseif($event->status == 3): ?>
                                    Publish
                                <?php else: ?>
                                    Unknown
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('manage_events.edit', $event->id)); ?>"
                                    class="btn btn-success text-white">Edit</a>
                                <form action="<?php echo e(route('manage_events.destroy', $event->id)); ?>" method="POST"
                                    style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-primary text-white" onclick="return confirm('Are you sure you want to delete this faculty member?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/manage_events/index.blade.php ENDPATH**/ ?>