
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">All Tenders / Circulars</h4>

            <a href="<?php echo e(route('manage_tender.create')); ?>">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New Tender/Circular</span>
                    </span>
                </button>
            </a>
        </div>
        <div class="default-table-area members-list recent-orders">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th> <!-- Index column -->
                            <th class="col">Title</th>
                            <th class="col">Type</th>
                            <th class="col">Language</th>
                            <th class="col">Publish Date</th>
                            <th class="col">Expiry Date</th>
                            <th class="col">Status</th>
                            <th class="col">File</th> <!-- Add a column for the file -->
                            <th class="col">Actions</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $tenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td> <!-- Auto-incrementing index -->
                            <td><?php echo e($tender->title); ?></td>
                            <td><?php echo e($tender->type); ?></td>
                            <td><?php echo e($tender->language); ?></td>
                            <td><?php echo e($tender->publish_date); ?></td>
                            <td><?php echo e($tender->expiry_date); ?></td>
                            <td><?php echo e($tender->status); ?></td>
                            <td>
                                <!-- Display image if the file exists -->
                                <?php if($tender->file && in_array(pathinfo($tender->file, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg'])): ?>
                                    <img src="<?php echo e(asset('/storage/uploads/' . $tender->file)); ?>" alt="Uploaded File" width="100">
                                <?php elseif($tender->file): ?>
                                    <a href="<?php echo e(asset('/storage/uploads/' . $tender->file)); ?>" target="_blank">View File</a>
                                <?php else: ?>
                                    No file uploaded
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('manage_tender.edit', $tender->id)); ?>"
                                    class="btn btn-success text-white">Edit</a>
                                <form action="<?php echo e(route('manage_tender.destroy', $tender->id)); ?>" method="POST"
                                    style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-primary text-white" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/manage_tender/index.blade.php ENDPATH**/ ?>