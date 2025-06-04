<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>" style="color: #af2910;"><?php if($_COOKIE['language'] ==
                                '2'): ?>होम
                                <?php else: ?>
                                Home
                                <?php endif; ?></a>
                        </li>
                        <li class="breadcrumb-item">

                            <?php if($_COOKIE['language'] ==
                            '2'): ?>प्रशिक्षण कैलेंडर
                            <?php else: ?>
                            Traning Calendar
                            <?php endif; ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-2" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="mb-4">
                <h2 class="h1 fw-bold text-primary">
                    <?php if($_COOKIE['language'] ==
                    '2'): ?>प्रशिक्षण कैलेंडर
                    <?php else: ?>
                    Traning Calendar
                    <?php endif; ?>
                </h2>
            </div>
        </div>
        <form id="form2" action="<?php echo e(url()->current()); ?>" method="GET">
            <div class="row mb-4">
                <div class="col-lg-1">
                    <label for="select_year" class="form-label"> <?php if($_COOKIE['language'] ==
                        '2'): ?>फ़िल्टर वर्ष
                        <?php else: ?>
                        Filter Year
                        <?php endif; ?>
                    </label>
                </div>
                <div class="col-lg-3">
                    <?php
                    $currentYear = date('Y'); // Current year
                    $currentMonth = date('m'); // Current month
                    $startYear = $currentYear - 3; // Start year (adjust as needed)

                    // Get selected year from request
                    $selectedYear = request()->input('select_year');

                    // Agar user ne select nahi kiya toh default financial year set karein
                    if (!$selectedYear) {
                    if ($currentMonth >= 4) {
                    $selectedYear = $currentYear + 1; // Financial year (current - next)
                    } else {
                    $selectedYear = $currentYear; // Previous - current year
                    }
                    }
                    ?>

                    <select name="select_year" id="select_year" class="form-control ps-5 text-dark h-58">
                        <option value="">Select Year</option>
                        <?php for($year = $startYear; $year <= $currentYear + 3; $year++): ?> <option value="<?php echo e($year); ?>"
                            <?php echo e(($year == $selectedYear) ? 'selected' : ''); ?>>
                            <?php echo e($year - 1); ?> - <?php echo e($year); ?>

                            </option>
                            <?php endfor; ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <button type="submit" id="btn2" class="btn btn-outline-primary"><?php if($_COOKIE['language'] ==
                        '2'): ?>जमा करना
                        <?php else: ?>
                        Submit
                        <?php endif; ?></button>
                </div>
            </div>
        </form>

        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="default-table-area members-list">
                    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                        <table class="table align-middle table-bordered mb-0" id="myTable">
                            <?php
                            // Determine current year and month
                            $selectedYear = request()->input('select_year');
                            if (!$selectedYear) {
                            $currentYear = date('Y');
                            $currentMonth = date('m');

                            if ($currentMonth >= 4) {
                            $startYear = $currentYear;
                            $endYear = $currentYear + 1;
                            } else {
                            $startYear = $currentYear - 1;
                            $endYear = $currentYear;
                            }
                            } else {
                            // Agar user ne year select kiya hai toh usko financial year ka start-end banayein
                            $startYear = $selectedYear - 1; // Financial Year Start
                            $endYear = $selectedYear; // Financial Year End
                            }
                            $selectedMonths = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan',
                            'Feb', 'Mar'];
                            $lang = isset($_COOKIE['language']) && $_COOKIE['language'] == '2' ? 'hi' : 'en';

                            $months = [
                            'en' => ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb',
                            'Mar'],
                            'hi' => ['अप्रैल', 'मई', 'जून', 'जुलाई', 'अगस्त', 'सितंबर', 'अक्टूबर', 'नवंबर', 'दिसंबर',
                            'जनवरी', 'फ़रवरी', 'मार्च'],
                            ];

                            $selectedMonths = $months[$lang];
                            ?>

                            <thead class="sticky-top bg-white" style="z-index: 1020;">
                                <tr>
                                    <th>#</th>
                                    <th>
                                        <?php if($_COOKIE['language'] == '2'): ?>
                                        कोर्स का नाम
                                        <?php else: ?>
                                        Course Name
                                        <?php endif; ?>
                                    </th>
                                    <th>
                                        <?php if($_COOKIE['language'] == '2'): ?>
                                        सहायता अनुभाग
                                        <?php else: ?>
                                        Support Section
                                        <?php endif; ?>
                                    </th>
                                    <th>
                                        <?php if($_COOKIE['language'] == '2'): ?>
                                        पाठ्यक्रम समन्वयक
                                        <?php else: ?>
                                        Course Coordinator
                                        <?php endif; ?>
                                    </th>
                                    <th>
                                        <?php if($_COOKIE['language'] == '2'): ?>
                                        अवधि
                                        <?php else: ?>
                                        Duration
                                        <?php endif; ?>
                                    </th>
                                    
                                    <?php $__currentLoopData = $selectedMonths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th><?php echo e($month); ?> <?php echo e($index < 9 ? $startYear : $endYear); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $serial = 1; ?>
                                
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
                                $durationInDays = ($courseEnd - $courseStart) / (60 * 60 * 24) + 1;

                                if ($durationInDays < 7) { if ($lang=='hi' ) { $duration=$durationInDays . ' दिन' ; }
                                    else { $duration=$durationInDays . ' day' . ($durationInDays> 1 ? 's' : '');
                                    }
                                    } else {

                                    $durationInWeeks = ceil($durationInDays / 7);
                                    if ($lang == 'hi') {
                                    $duration = $durationInWeeks . ' सप्ताह';
                                    } else {
                                    $duration = $durationInWeeks . ' week' . ($durationInWeeks > 1 ? 's' : '');
                                    }
                                    }
                                    ?>

                                    
                                    <tr>
                                        <td style="background-color: <?php echo e($subcategory['color']); ?>;"><?php echo e($serial++); ?></td>
                                        <td style="background-color: <?php echo e($subcategory['color']); ?>;">
                                            <?php echo e($course['course_name']); ?>

                                        </td>
                                        <td style="background-color: <?php echo e($subcategory['color']); ?>;">
                                            <?php echo e($course['support_section']); ?>

                                        </td>
                                        <td style="background-color: <?php echo e($subcategory['color']); ?>;">
                                            <?php echo e($course['coordinator_id']); ?>

                                        </td>
                                        <td style="background-color: <?php echo e($subcategory['color']); ?>;">
                                            <?php if($course['course_start_date'] && $course['course_end_date']): ?>
                                            <?php echo e($duration); ?>

                                            <?php else: ?>
                                            N/A
                                            <?php endif; ?>
                                        </td>
                                        
                                        <?php for($month = 4; $month <= 15; $month++): ?> <?php $cellDate=($month <=12
                                            ? "$startYear-" : "$endYear-" ) . str_pad(($month - 1) % 12 + 1, 2, '0' ,
                                            STR_PAD_LEFT); $courseStartDate=date('Y-m',
                                            strtotime($course['course_start_date'])); $courseEndDate=date('Y-m',
                                            strtotime($course['course_end_date'])); $isWithinDuration=($courseStartDate
                                            <=$cellDate) && ($courseEndDate>= $cellDate);
                                            ?>
                                            <td class="center" style="
                                                <?php if($isWithinDuration): ?> background-color: <?php echo e($subcategory['color']); ?>; <?php endif; ?>
                                            ">
                                                <?php if($courseStartDate == $cellDate && $courseEndDate == $cellDate): ?>
                                                <?php echo e(date('d', strtotime($course['course_start_date']))); ?> -
                                                <?php echo e(date('d', strtotime($course['course_end_date']))); ?>

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
    </div>
</section>

<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\lbsnaa-website\resources\views/user/pages/training_cal.blade.php ENDPATH**/ ?>