<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($trainingprograms)): ?>
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('user.micrositebyslug', ['slug' => $slug])); ?>"
                                style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Training Program</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid">
    <!-- Gallery Display -->

    <div class="row">
        <div class="col-lg-9 col-12">
            <?php if($trainingprograms->isNotEmpty()): ?>
            <table class="table table-striped table-hover table-bordered">
                <thead class="bg-primary">
                    <tr>
                        <th class="col text-white">#</th>
                        <th class="col text-white">Program Name</th>
                        <th class="col text-white">Venue</th>
                        <th class="col text-white">Date</th>
                        <th class="col text-white">Registration</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $trainingprograms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td>
                            <a
                                href="<?php echo e(route('user.details', ['id' => $training->id, 'slug' => $training->research_centre_slug])); ?>" class="text-primary">
                                <?php echo e($training->program_name); ?>

                            </a>
                        </td>
                        <td><?php echo e($training->venue); ?></td>
                        <td><?php echo e($training->start_date); ?> To <?php echo e($training->end_date); ?></td>
                        <!-- <td><?php echo e($training->registration_status == 1 ? 'On' : 'Off'); ?></td> -->
                        <td>
                            <?php if($training->registration_status == 1): ?>
                            On
                            <?php elseif($training->registration_status == 2): ?>
                            Off
                            <?php else: ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No training programs available at the moment.</p>
            <?php endif; ?>
        </div>
        <!-- Quick Links -->
        <div class="col-12 col-lg-3 mb-4">
            <div class="card card-hover border">
                <div class="card-header" style="background-color: #af2910;">
                    <h3 class="text-white">Quick Links</h3>
                </div>
                <div class="card-body" style="padding: 0;">
                    <ul class="mt-2 mb-2 list-group list-group-flush">
                        <?php $__empty_1 = true; $__currentLoopData = $quickLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="text-start list-group-item">
                            <?php if($link->website_url): ?>
                            <!-- For website URL -->
                            <a href="<?php echo e($link->website_url); ?>" class="text-primary" target="_blank">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                        </path>
                                    </svg>
                                </span>
                                <?php echo e($link->txtename); ?>

                            </a>
                            <?php elseif($link->pdf_file): ?>
                            <!-- For PDF URL -->
                            <a href="<?php echo e(asset('storage/' . $link->pdf_file)); ?>" class="text-primary" target="_blank">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                        <path
                                            d="M9 1H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7l-5-6zm0 1.5V6h5L9 2.5zM4 2h5v4H4V2zM3 12V4h5v4h5v4H3z" />
                                    </svg>
                                </span>
                                <?php echo e($link->txtename); ?>

                            </a>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <!-- If no quickLinks are available -->
                        <li class="text-start list-group-item text-danger">No data available</li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/user/pages/microsites/training_program.blade.php ENDPATH**/ ?>