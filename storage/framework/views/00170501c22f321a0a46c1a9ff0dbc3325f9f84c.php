<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($subcategory)): ?>
<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-light rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2 mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #af2910;">
                            <?php echo e($subcategory->category_name); ?>

                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>


<section class="py-1">
    <div class="container">
        <!-- Section Header -->
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <h2 class="h1 fw-bold text-primary">
                        <?php echo e($subcategory->category_name); ?>

                    </h2>
                </div>
                <p class="text-muted"><?php echo e($subcategory->description); ?></p>
            </div>
        </div>

        <!-- Current Courses Section -->
        <section class="py-4">
            <div class="container">
                <h4 class="mb-3">Current Courses:</h4>
                <?php if($currentCourse): ?>
                    <div class="current-course-box mb-3 p-3 border rounded bg-light">
                        <h5 class="fw-bold"><?php echo e($currentCourse->course_name); ?></h5>
                        <p>
                            <strong>Course Date:</strong> 
                            <?php echo e(\Carbon\Carbon::parse($currentCourse->course_start_date)->format('d F, Y')); ?> 
                            to 
                            <?php echo e(\Carbon\Carbon::parse($currentCourse->course_end_date)->format('d F, Y')); ?>

                        </p>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No current courses available for this category.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Archived Courses Section -->
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <h4 class="mb-3">Archived Courses:</h4>
                    <?php if($courses->isNotEmpty()): ?>
                        <div class="form-group">
                            <label for="archive_course" class="form-label">Select Archived Course:</label>
                            <select name="archive" id="archive_course" class="form-select"
                                onchange="navigateToArchivedCourse(this.value)">
                                <option value="">Select Archived Course</option>
                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archived): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(route('user.courseDetailslug', $archived->id)); ?>">
                                        <?php echo e($archived->course_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No archived courses available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>



<?php else: ?>
    <h4>Does not exist</h4>
<?php endif; ?>

<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    function navigateToArchivedCourse(url) {
        if (url) {
            window.location.href = url; // Redirects to the selected URL
        }
    }
</script>
<?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/course_list.blade.php ENDPATH**/ ?>