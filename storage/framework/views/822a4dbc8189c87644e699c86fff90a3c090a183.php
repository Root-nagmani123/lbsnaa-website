<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2 mb-4">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Traning Calendar</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="p-2">
    <div class="container">
    <div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
      <div class="default-table-area members-list">
      <div class="table-responsive">
    <table class="table align-middle table-bordered" id="myTable">
                <?php
                // Determine current year and month
                $currentYear = date('Y');
                $currentMonth = date('m');

                // Set the start and end year for the table
                if ($currentMonth >= 4) {
                    // If current month is April or later, start from April of the current year to March of the next year
                    $startYear = $currentYear;
                    $endYear = $currentYear + 1;
                } else {
                    // If current month is before April, start from April of the previous year to March of the current year
                    $startYear = $currentYear - 1;
                    $endYear = $currentYear;
                }

                // Generate the months and years for table header
                $months = [
                    'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'
                ];
            ?>

            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Course Name</th>
                    <th>Support Section</th>
                    <th>Course Coordinator</th>
                    <th>Duration</th>
                    
                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($index < 9): ?> 
                            <th><?php echo e($month); ?> <?php echo e($startYear); ?></th>
                        <?php else: ?> 
                            <th><?php echo e($month); ?> <?php echo e($endYear); ?></th>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>

            <tbody>
    <?php
        $serial = 1;
    ?>

    
    <?php $__currentLoopData = $organizedCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentCategoryId => $parentCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <tr>
            <td></td>
            <td colspan="16" class="text-dark fw-bold">
                <?php echo e($parentCategory['name']); ?>

            </td>
        </tr>

        
        <?php $__currentLoopData = $parentCategory['subcategories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategoryId => $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <tr>
                <td></td>
                <td colspan="16" class="text-dark fw-bold">
                    -- <?php echo e($subcategory['name']); ?>

                </td>
            </tr>

            
            <?php $__currentLoopData = $subcategory['courses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php
                    $courseStart = strtotime($course['course_start_date']);
                    $courseEnd = strtotime($course['course_end_date']);
                    $durationInDays = ($courseEnd - $courseStart) / (60 * 60 * 24) + 1; // Calculate number of days including both start and end dates
                    if ($durationInDays < 7) {
                        $duration = $durationInDays . ' day' . ($durationInDays > 1 ? 's' : '');
                    } else {
                        $durationInWeeks = ceil($durationInDays / 7); // Round up to show weeks
                        $duration = $durationInWeeks . ' week' . ($durationInWeeks > 1 ? 's' : '');
                    }
                ?>

                
                <tr>
                    
                    <td style="background-color: <?php echo e($subcategory['color']); ?>;"><?php echo e($serial++); ?></td>
                    <td style="background-color: <?php echo e($subcategory['color']); ?>;"><?php echo e($course['course_name']); ?></td>
                    <td style="background-color: <?php echo e($subcategory['color']); ?>;"><?php echo e($course['support_section']); ?></td>
                    <td style="background-color: <?php echo e($subcategory['color']); ?>;">Course Coordinator Here</td> <!-- Add logic to fetch coordinator if available -->
                    <td style="background-color: <?php echo e($subcategory['color']); ?>;">
                        <?php if($course['course_start_date'] && $course['course_end_date']): ?>
                            <?php echo e($duration); ?>

                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    
                    <?php for($month = 4; $month <= 15; $month++): ?>
                        <?php
                            $cellDate = ($month <= 12) ? "2024-" . str_pad($month, 2, '0', STR_PAD_LEFT) : "2025-" . str_pad($month - 12, 2, '0', STR_PAD_LEFT);
                            $courseStartDate = date('Y-m', strtotime($course['course_start_date']));
                            $courseEndDate = date('Y-m', strtotime($course['course_end_date']));

                            // Determine if the current cell is within the duration of the course
                            $isWithinDuration = ($courseStartDate <= $cellDate) && ($courseEndDate >= $cellDate);
                        ?>
                        <td class="center" style="
                            <?php if($isWithinDuration): ?>
                                background-color: <?php echo e($subcategory['color']); ?>;
                            <?php endif; ?>
                        ">
                            
                            <?php if($courseStartDate == $cellDate && $courseEndDate == $cellDate): ?>
                                <?php echo e(date('d', strtotime($course['course_start_date']))); ?> - <?php echo e(date('d', strtotime($course['course_end_date']))); ?>

                            <?php elseif($courseStartDate == $cellDate): ?>
                                <?php echo e(date('d', strtotime($course['course_start_date']))); ?> -
                            <?php elseif($courseEndDate == $cellDate): ?>
                                <?php echo e(date('d', strtotime($course['course_end_date']))); ?>

                            <?php endif; ?>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>






    </table>
</div>

      </div>
    </div>
  </div>
    </div>
</section>



<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/training_cal.blade.php ENDPATH**/ ?>