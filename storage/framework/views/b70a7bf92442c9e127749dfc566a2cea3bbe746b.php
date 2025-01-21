<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($trainingdetails)): ?>
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
                        <li class="breadcrumb-item"> 
                            <a href="/lbsnaa-sub_tp/trainings/<?php echo e($slug); ?>" style="color: #af2910;">Training Details</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Training Program Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Quick Links -->
<section class="py-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-12">
                <table class="table table-hover table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2" style="background-color:#af2910; color:white;">Course
                                Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($trainingdetails): ?>
                        <tr>
                            <th><b>Program Name:</b></th>
                            <td><?php echo e($trainingdetails->program_name); ?></td>

                        </tr>
                        <tr>
                            <th><b>Venue:</b></th>
                            <td><?php echo e($trainingdetails->venue); ?></td>

                        </tr>
                        <tr>
                            <th><b>Course Coordinator:</b></th>
                            <td><?php echo e($trainingdetails->program_coordinator); ?></td>
                        </tr>
                        <tr>
                            <td><b>Duration:</b></td>
                            <td><?php echo e($trainingdetails->start_date); ?> To <?php echo e($trainingdetails->end_date); ?></td>
                        </tr>
                        <tr>
                            <td><b>Program Description:</b></td>
                            <td><?php echo html_entity_decode($trainingdetails->program_description ?? ''); ?></td>
                        </tr>
                        <?php else: ?>
                        <p>No training details available.</p>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-lg-3 mb-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color: #af2910;">
                        <h3 class="text-white">Quick Links</h3>
                    </div>
                    <div class="card-body" style="padding: 0;height:230px; overflow-y: scroll">
                        <ul class="mt-2 mb-2 list-group list-group-flush">
                            <?php $__empty_1 = true; $__currentLoopData = $quickLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="text-start list-group-item">
                                    <?php if($link->website_url): ?>
                                        <!-- For website URL -->
                                        <a href="<?php echo e($link->website_url); ?>" class="text-primary" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                                                </svg>
                                            </span>
                                            <?php echo e($link->txtename); ?>

                                        </a>
                                    <?php elseif($link->pdf_file): ?>
                                        <!-- For PDF URL -->
                                        <a href="<?php echo e(asset('storage/' . $link->pdf_file)); ?>" class="text-primary" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                                    <path d="M9 1H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7l-5-6zm0 1.5V6h5L9 2.5zM4 2h5v4H4V2zM3 12V4h5v4h5v4H3z"/>
                                                </svg>
                                            </span>
                                            <?php echo e($link->txtename); ?>

                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="text-start list-group-item text-danger">No data available</li>
                            <?php endif; ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH C:\xampp11\htdocs\lbsnaa-website\resources\views/user/pages/microsites/training_details.blade.php ENDPATH**/ ?>