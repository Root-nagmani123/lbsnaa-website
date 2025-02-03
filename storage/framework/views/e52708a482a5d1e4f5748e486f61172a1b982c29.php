<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('user.micrositebyslug', ['slug' => $slug])); ?>" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Media Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid">
    <div class="row">
        <!-- Left Section: Galleries -->
        <div class="col-12 col-md-9">
            <div class="position-relative d-flex overflow-x-auto py-4 pt-lg-4">
                <div class="d-flex gap-3">
                    <?php if($research_centre): ?>
                        <a href="<?php echo e(route('user.media_gallery', ['slug' => $slug])); ?>" 
                           class="bg-white text-center shadow-sm text-wrap rounded-4 border card-lift flex-shrink-0"
                           style="width: 200px;">
                            <div class="p-3">
                                <img src="<?php echo e(asset('assets/images/images.png')); ?>" alt="Photo Gallery" class="avatar avatar-xl">
                                <div class="mt-3">
                                    <h3 class="h5 mb-0">Photo Gallery</h3>
                                </div>
                            </div>
                        </a>
                    <?php else: ?>
                        <p class="text-danger">No research centre found for the slug: <?php echo e($slug); ?>.</p>
                    <?php endif; ?>

                    <a href="<?php echo e(route('videoGallery', ['slug' => request()->query('slug')])); ?>" 
                       class="bg-white text-center shadow-sm text-wrap rounded-4 border card-lift flex-shrink-0"
                       style="width: 200px;">
                        <div class="p-3">
                            <img src="<?php echo e(asset('assets/images/gallery.png')); ?>" alt="Video Gallery" class="avatar avatar-xl">
                            <div class="mt-3">
                                <h3 class="h5 mb-0">Video Gallery</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Section: Quick Links -->
        <div class="col-12 col-md-3 mt-4 mt-md-0">
            <div class="card card-hover border">
                <div class="card-header" style="background-color: #af2910;">
                    <h5 class="text-white mb-0">Quick Links</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php $__empty_1 = true; $__currentLoopData = $quickLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item">
                                <?php if($link->website_url): ?>
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
                            <li class="list-group-item text-danger">No data available</li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>



<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/user/pages/microsites/mediagallery.blade.php ENDPATH**/ ?>