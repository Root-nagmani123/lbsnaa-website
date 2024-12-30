<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($course) && isset($subcategory)): ?>
<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="col-12 mb-4 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>" class="text-danger">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('user.navigationpagesbyslug', ['slug' => 'training'])); ?>"
                                class="text-danger">Training Courses</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('user.courseslug', ['slug' => $subcategory->slug])); ?>"
                                class="text-danger">
                                <?php echo e($subcategory->category_name); ?>

                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo e($course->course_name); ?>

                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-primary shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="fw-bold mb-0 text-white"><?php echo e($course->course_name); ?></h2>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-primary">Course Information</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Section:</strong>
                                <span><?php echo e($course->section_name); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Venue:</strong>
                                <span><?php echo e($course->venue_title); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Course Coordinator:</strong>
                                <span><?php echo e($course->coordinator_id ?? 'N/A'); ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Associate Course Coordinators:</strong>
                                <ul class="mb-0">
                                    <li><?php echo e($course->asst_coordinator_1_id ?? 'N/A'); ?></li>
                                    <li><?php echo e($course->asst_coordinator_2_id ?? 'N/A'); ?></li>
                                    <li><?php echo e($course->asst_coordinator_3_id ?? 'N/A'); ?></li>
                                    <li><?php echo e($course->asst_coordinator_4_id ?? 'N/A'); ?></li>
                                    <li><?php echo e($course->asst_coordinator_5_id ?? 'N/A'); ?></li>
                                </ul>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Duration:</strong>
                                <span><?php echo e(\Carbon\Carbon::parse($course->course_start_date)->format('d M, Y')); ?> to
                                    <?php echo e(\Carbon\Carbon::parse($course->course_end_date)->format('d M, Y')); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h4>Archived Courses:</h4>
                <?php if($courses_list->isNotEmpty()): ?>
                <div class="form-group">
                    <select class="form-select" name="archive" id="archive_course"
                        onchange="navigateToArchivedCourse(this.value)">
                        <option value="">Select Archived Course</option>
                        <?php $__currentLoopData = $courses_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archived): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(route('user.courseDetailslug', $archived->id)); ?>">
                            <?php echo e($archived->course_name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php else: ?>
                <p>No archived courses available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php else: ?>
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Course not found!</h4>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/course_details.blade.php ENDPATH**/ ?>