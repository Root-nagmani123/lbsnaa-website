<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Page Content -->
<!-- slider start -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

    <div class="carousel-indicators">

        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($i == 0): ?>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to=<?php echo e($i); ?> class="active"
            aria-current="true" aria-label=<?php echo e($slider->text); ?>></button>
        <?php endif; ?>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo e($i); ?>"
            aria-label=<?php echo e($slider->text); ?>></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Dynamic Slider -->
    <div class="carousel-inner">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
            <img src="<?php echo e(asset('slider-images/' . $slider->image)); ?>" class="d-block img-fluid"
                alt="<?php echo e($slider->text); ?>"
                style="
  width: 100%;
  height: 600px; background-size: cover; background-position: center; border-radius: 10px;background-repeat: no-repeat;">
            <div class="carousel-caption d-none d-md-block">
                <h3 class="text-white"><?php echo e($slider->text); ?></h3>
                <!-- <p><?php echo e($slider->description); ?></p> -->
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- floating notification start -->
<section class="py-2 bg-white">
    <div class="container-fluid">
        <div class="position-relative d-flex overflow-hidden pt-4 gap-3">
            <button class="btn btn-primary" id="basic-addon2" style="z-index: 1;">Latest Updates</button>
            <div class="animate-marquee d-flex gap-3">
                <?php $__currentLoopData = $news_scrollers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scroller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('user.letest_updates', $scroller->menu_slug)); ?>"
                    class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border marquee-item">
                    <div class="p-3">
                        <span class="text-gray-800"><?php echo e($scroller->menutitle); ?></span>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid py-6 bg-white">
    <div class="container">
        <div class="position-relative d-flex overflow-x-hidden py-lg-4 pt-4">
            <div class="d-flex gap-3">
                <a href="#" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border"
                    style="width: 200px !important">
                    <!--img-->
                    <div class="p-3">
                        <img src="<?php echo e(asset('assets/images/65044826c6957DirSirNew.jpeg')); ?>" alt="mentor 19"
                            class="avatar avatar-xl rounded-circle">
                        <!--content-->
                        <div class="mt-3">
                            <h3 class="mb-0 h4">Director's Message</h3>
                            <span class="text-gray-800">Message</span><br>
                            <span class="text-gray-800">Previous Directors</span>
                        </div>
                    </div>
                </a>
                <a href="#" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border"
                    style="width: 200px !important">
                    <!--img-->
                    <div class="p-3">
                        <img src="<?php echo e(asset('assets/images/ebook.png')); ?>" alt="mentor 19" class="avatar avatar-xl">
                        <!--content-->
                        <div class="mt-3">
                            <h3 class="mb-0 h4">Running Courses</h3>
                        </div>
                    </div>
                </a>
                <a href="#" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border"
                    style="width: 200px !important">
                    <!--img-->
                    <div class="p-3">
                        <img src="<?php echo e(asset('assets/images/graduation.png')); ?>" alt="mentor 19" class="avatar avatar-xl">
                        <!--content-->
                        <div class="mt-3">
                            <h3 class="mb-0 h4">Upcoming Courses</h3>
                        </div>
                    </div>
                </a>
                <a href="#" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border"
                    style="width: 200px !important">
                    <!--img-->
                    <div class="p-3">
                        <img src="<?php echo e(asset('assets/images/calendar.png')); ?>" alt="mentor 19" class="avatar avatar-xl">
                        <!--content-->
                        <div class="mt-3">
                            <h3 class="mb-0 h4">Training Calendar</h3>
                        </div>
                    </div>
                </a>
                <a href="#" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border"
                    style="width: 200px !important">
                    <!--img-->
                    <div class="p-3">
                        <img src="<?php echo e(asset('assets/images/graduation (1).png')); ?>" alt="mentor 19"
                            class="avatar avatar-xl">
                        <!--content-->
                        <div class="mt-3">
                            <h3 class="mb-0 h4">Life at Academy</h3>
                        </div>
                    </div>
                </a>
                <a href="#" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift border"
                    style="width: 200px !important">
                    <!--img-->
                    <div class="p-3">
                        <img src="<?php echo e(asset('assets/images/shopping-bag.png')); ?>" alt="mentor 19"
                            class="avatar avatar-xl">
                        <!--content-->
                        <div class="mt-3">
                            <h3 class="mb-0 h4">Academy Souvenir</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-8 bg-light">
    <div class="container">
        <div class="row gy-4 gy-xl-0">
            <div class="col-8">
                <div class="px-xl-8 my-lg-6">
                    <div class="mb-5">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="fw-semibold text-primary">LBSNAA Academy News</h3>
                            </div>
                            <div class="col-6">
                                <span style="float:right;"><a href="<?php echo e(route('user.news_listing')); ?>"
                                        class="fw-semibold text-primary">View All</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative">
                        <div class="tns-outer" id="tns1-ow">
                            <!-- <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">
                                slide
                                <span class="current">6 to 7</span>
                                of 5
                            </div> -->
                            <div id="tns1-mw" class="tns-ovh">
                                <div class="tns-inner" id="tns1-iw">
                                    <div class="sliderTestimonialFourth tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                                        id="tns1">
                                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item tns-item">
                                            <!-- Card -->
                                            <div class="card mb-4 shadow-lg card-lift">
                                                <div class="card-header" style="border:none;padding:0;">
                                                    <a href="#">
                                                        <!-- Img  -->
                                                        <img src="<?php echo e(isset($slider->main_image) || !empty($slider->main_image) ? asset($slider->main_image) : asset('assets/images/4.jpg')); ?>"
                                                            class="card-img-top" alt="blogpost ">
                                                    </a>
                                                </div>
                                                <!-- Card body -->
                                                <div class="card-body">
                                                    <a href="#"
                                                        class="fs-5 mb-2 fw-semibold d-block text-success">Posted On :-
                                                        <?php echo e(\Carbon\Carbon::parse($slider->created_at)->format('d F, Y')); ?></a>
                                                    <h3><a href="blog-single.html"
                                                            class="text-inherit"><?php echo e($slider->title); ?></a></h3>
                                                    <p><?php echo e($slider->short_description); ?></p>
                                                    <!-- Media content -->
                                                </div>
                                                <div class="card-footer" style="border-top:none;">
                                                    <a href="<?php echo e(route('user.newsbyslug', $slider->title_slug)); ?>"
                                                        class="text-inherit text-primary">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="controls-testimonial controls justify-content-start"
                            id="sliderTestimonialFourthControls" aria-label="Carousel Navigation" tabindex="0">
                            <li class="prev ms-0" aria-controls="tns1" tabindex="-1" data-controls="prev">
                                <i class="fe fe-chevron-left"></i>
                            </li>
                            <li class="next ms-2" aria-controls="tns1" tabindex="-1" data-controls="next">
                                <i class="fe fe-chevron-right"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color: #af2910;">
                        <h3 class="text-white">Quick Links</h3>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        <ul class="mt-2 mb-2 list-group list-group-flush">
                            <?php $__currentLoopData = $quick_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $quick_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="text-start list-group-item">
                                <?php if(!empty($quick_link->url)): ?>
                                <a href="<?php echo e(str_starts_with($quick_link->url, 'http://') || str_starts_with($quick_link->url, 'https://') ? $quick_link->url : 'http://' . $quick_link->url); ?>"
                                    target="_blank" class="text-decoration-none text-primary">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    <?php echo e($quick_link->text); ?>

                                </a>
                                <?php elseif(!empty($quick_link->file)): ?>
                                <a href="<?php echo e(asset('quick-links-files/'.$quick_link->file)); ?>" target="_blank"
                                    class="text-decoration-none text-primary">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    <?php echo e($quick_link->text); ?>

                                </a>
                                <?php else: ?>
                                <?php echo e($quick_link->text); ?>

                                <?php endif; ?>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>


                    </div>
                </div>
            </div>
        </div>
</section>
<style>
.animate-marquee {
    display: flex;
    animation: marquee 5s linear infinite;
    gap: 20px;
    /* Adjust gap between items */
}

.marquee-item {
    min-width: 500px;
    /* Set a minimum width for the items */
    white-space: nowrap;
}

@keyframes marquee {
    0% {
        transform: translateX(150%);
        /* Start outside the right edge */
    }

    100% {
        transform: translateX(-100%);
        /* Move past the left edge */
    }
}

.overflow-hidden {
    overflow: hidden;
    /* Ensure content stays inside the container */
}
</style>
<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp11\htdocs\lbsnaa-website\resources\views/user/pages/home.blade.php ENDPATH**/ ?>