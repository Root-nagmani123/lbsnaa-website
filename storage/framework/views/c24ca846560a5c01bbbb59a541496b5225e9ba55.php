<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($subcategory)): ?>
<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-light rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2 mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>" style="color: #af2910;">
                                <?php if(Cookie::get('language') == '2'): ?>
                                घर
                                <?php else: ?>
                                Home
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('user.navigationpagesbyslug', ['slug' => 'training'])); ?>"
                                class="text-danger">
                                <?php if(Cookie::get('language') == '2'): ?>
                                प्रशिक्षण पाठ्यक्रम
                                <?php else: ?>
                                Training Courses
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('user.course_subcourse_slug', ['slug' => $parent_category->slug])); ?>"
                                class="text-danger"><?php echo e($parent_category->category_name); ?></a>
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
    <div class="container-fluid">
        <!-- Section Header -->
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <h2 class="h1 fw-bold text-primary">
                        <?php echo e($subcategory->category_name); ?>

                    </h2>
                </div>
                <p class="text-muted"><?= htmlspecialchars_decode($subcategory->description); ?>
                </p>
            </div>
        </div>
        <section class="py-4">
            <div class="container-fluid">
                <h4 class="mb-3">
                    <?php if(Cookie::get('language') == '2'): ?>
                    आगामी पाठ्यक्रम:
                    <?php else: ?>
                    Upcoming Courses:
                    <?php endif; ?>
                </h4>
                <?php if(count($upcomingCourse) >0): ?>
                <?php $__currentLoopData = $upcomingCourse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upcomingCourses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="current-course-box mb-3 p-3 border rounded bg-light">
                    <h5 class="fw-bold"><?php echo e($upcomingCourses->course_name); ?></h5>
                    <p>
                        <strong>
                            <?php if(Cookie::get('language') == '2'): ?>
                            पाठ्यक्रम तिथि:
                            <?php else: ?>
                            Course Date:
                            <?php endif; ?>
                        </strong>
                        <?php echo e(\Carbon\Carbon::parse($upcomingCourses->course_start_date)->format('d F, Y')); ?>

                        to
                        <?php echo e(\Carbon\Carbon::parse($upcomingCourses->course_end_date)->format('d F, Y')); ?>

                    </p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <p class="text-muted">
                    <?php if(Cookie::get('language') == '2'): ?>
                    इस श्रेणी के लिए कोई आगामी पाठ्यक्रम उपलब्ध नहीं है।
                    <?php else: ?>
                    No Upcoming courses available for this category.
                    <?php endif; ?>
                </p>
                <?php endif; ?>
            </div>
        </section>
        <!-- Current Courses Section -->
        <section class="py-4">
            <div class="container-fluid">
                <h4 class="mb-3">
                    <?php if(Cookie::get('language') == '2'): ?>
                    वर्तमान पाठ्यक्रम:
                    <?php else: ?>
                    Current Courses:
                    <?php endif; ?>
                </h4>
                <?php if(count($currentCourse) >0): ?>
                <?php $__currentLoopData = $currentCourse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currentCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="current-course-box mb-3 p-3 border rounded bg-light">
                    <h5 class="fw-bold"><?php echo e($currentCourse->course_name); ?></h5>
                    <p>
                        <strong>
                            <?php if(Cookie::get('language') == '2'): ?>
                            पाठ्यक्रम तिथि:
                            <?php else: ?>
                            Course Date:
                            <?php endif; ?>
                        </strong>
                        <?php echo e(\Carbon\Carbon::parse($currentCourse->course_start_date)->format('d F, Y')); ?>

                        to
                        <?php echo e(\Carbon\Carbon::parse($currentCourse->course_end_date)->format('d F, Y')); ?>

                    </p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <p class="text-muted">
                    <?php if(Cookie::get('language') == '2'): ?>
                    इस श्रेणी के लिए कोई वर्तमान पाठ्यक्रम उपलब्ध नहीं है।
                    <?php else: ?>
                    No current courses available for this category.
                    <?php endif; ?>
                </p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Archived Courses Section -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-4">
                    <h4 class="mb-3"><?php if(Cookie::get('language') == '2'): ?>
                        संग्रहीत पाठ्यक्रम:
                        <?php else: ?>
                        Archived Courses:
                        <?php endif; ?></h4>
                    <?php if($courses->isNotEmpty()): ?>
                    <div class="form-group">
                        <label for="archive_course" class="form-label">
                        <?php if(Cookie::get('language') == '2'): ?>
                        संग्रहीत पाठ्यक्रम का चयन करें:
                        <?php else: ?>
                        Select Archived Course:
                        <?php endif; ?>
                        </label>
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
                    <p class="text-muted">
                        <?php if(Cookie::get('language') == '2'): ?>
                        कोई संग्रहित पाठ्यक्रम उपलब्ध नहीं है.
                        <?php else: ?>
                        No archived courses available.
                        <?php endif; ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>



<?php else: ?>
<h4>
    <?php if(Cookie::get('language') == '2'): ?>
    मौजूद नहीं
    <?php else: ?>
    Does not exist
    <?php endif; ?>
</h4>
<?php endif; ?>

<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
function navigateToArchivedCourse(url) {
    if (url) {
        window.location.href = url; // Redirects to the selected URL
    }
}
</script><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/user/pages/course_list.blade.php ENDPATH**/ ?>