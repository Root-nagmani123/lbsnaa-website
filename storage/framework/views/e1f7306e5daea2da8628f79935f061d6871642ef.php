<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row">
            <!-- Slider Section -->
            <div class="col-12 col-lg-9 mb-4">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel"
                    data-bs-interval="3000">
                    <div class="carousel-indicators">
                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo e($i); ?>"
                            class="<?php echo e($i == 0 ? 'active' : ''); ?>" aria-label="<?php echo e($slider->slider_text); ?>"></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="carousel-inner">
                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('storage/' . $slider->slider_image)); ?>" class="d-block img-fluid"
                                alt="<?php echo e($slider->slider_description); ?>"
                                style="width: 100%; height: 400px; object-fit: cover; border-radius: 10px;">
                            <div class="carousel-caption d-none d-md-block" style="bottom: 0 !important;">
                                <h3 class="text-white slider-caption"><?php echo e($slider->slider_text); ?></h3>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <script>
                var carousel = document.getElementById('carouselExampleCaptions');
                carousel.addEventListener('mouseenter', function() {
                    carousel.carousel('pause');
                });
                carousel.addEventListener('mouseleave', function() {
                    carousel.carousel('cycle');
                });
                </script>
            </div>


            <!-- What's New Section -->
            <div class="col-12 col-lg-3 mb-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color:#af2910">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-white">What's New</h5>

                            </div>
                            <div class="col-lg-6 text-end">
                                <a href="<?php echo e(route('user.whatnewall', ['slug' => $slug])); ?>"
                                    style="text-decoration: none;color: #fff">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="height:340px;overflow-y: scroll;">
                        <ul class="list-group list-group-flush">
                            <?php $__empty_1 = true; $__currentLoopData = $whatsNew; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item">
                                <?php if($news->website_url): ?>
                                <a href="<?php echo e($news->website_url); ?>" class="text-primary" target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    <?php echo e($news->txtename); ?>

                                </a>
                                <?php elseif($news->pdf_file): ?>
                                <a href="<?php echo e(asset('storage/' . $news->pdf_file)); ?>" class="text-primary"
                                    target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    <?php echo e($news->txtename); ?>

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
        <div class="row">
            <!-- Research Centres -->
            <div class="col-12 col-lg-9 mb-4">
                <?php $__currentLoopData = $research_centres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $research_centre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h1 class="text-center uppercase" style="color:#af2910"><?php echo e(($research_centre->home_title)); ?>

                    <br><span><img src="<?php echo e(asset('assets/images/devider.png')); ?>"
                            alt="<?php echo e($research_centre->home_title); ?>"></span></h1>
                <p style="text-align: justify;" class="mb-4"><?php echo $research_centre->description; ?></p>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="d-flex flex-wrap gap-3">
                    <?php $__currentLoopData = $research_centres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $research_centre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('mediagallery', ['slug' => $research_centre->research_centre_slug])); ?>"
                        class="card border shadow-sm text-center" style="width: 200px;">
                        <div class="card-body">
                            <img src="<?php echo e(asset('assets/images/image (2).png')); ?>"
                                alt="<?php echo e($research_centre->home_title); ?>" class="img-fluid">
                            <h6 class="mt-3">Gallery</h6>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php $__currentLoopData = $research_centres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $research_centre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('news', ['slug' => $research_centre->research_centre_slug])); ?>"
                        class="card border shadow-sm text-center" style="width: 200px;">
                        <div class="card-body">
                            <img src="<?php echo e(asset('assets/images/newspaper (1).png')); ?>"
                                alt="<?php echo e($research_centre->home_title); ?>" class="img-fluid">
                            <h6 class="mt-3">Latest News</h6>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-12 col-lg-3 mb-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color:#af2910">
                        <h5 class="text-white">Quick Links</h5>
                    </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: scroll;">
                        <ul class="list-group list-group-flush">
                            <?php $__empty_1 = true; $__currentLoopData = $quickLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item">
                                <?php if($link->website_url): ?>
                                <a href="<?php echo e($link->website_url); ?>" class="text-primary" target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    <?php echo e($link->txtename); ?>

                                </a>
                                <?php elseif($link->pdf_file): ?>
                                <a href="<?php echo e(asset('storage/' . $link->pdf_file)); ?>" class="text-primary"
                                    target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
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
</section>

<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/user/pages/microsites/index.blade.php ENDPATH**/ ?>