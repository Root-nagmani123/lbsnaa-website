

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Course</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Course Chart</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Course List</h4>
            <a href="<?php echo e(route('admin.courses.create')); ?>">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Course</span>
                    </span>
                </button>
            </a>
        </div>
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">ID</th>
                            <th class="col">Course Name</th>
                            <th class="col">Abbreviation</th>
                            <th class="col">Language</th>
                            <th class="col">Coordinator</th>
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td> <!-- Auto-incrementing index -->
                            <td><?php echo e($course->course_name); ?></td>
                            <td><?php echo e($course->abbreviation); ?></td>
                            <td><?php echo e($course->language == 1 ? 'English' : 'Hindi'); ?></td>
                            <td><?php echo e($course->coordinator_id); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.courses.edit', $course->id)); ?>"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="<?php echo e(route('admin.courses.destroy', $course->id)); ?>" method="POST"
                                    style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-primary text-white"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="course" data-column="page_status" data-id="<?php echo e($course->id); ?>"
                                        <?php echo e($course->page_status ? 'checked' : ''); ?>>
                                </div>
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp6\htdocs\lbsnaa_website\resources\views/admin/courses/index.blade.php ENDPATH**/ ?>