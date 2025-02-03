<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Page Content -->
<!-- slider start -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-indicators">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo e($i); ?>"
            class="<?php echo e($i == 0 ? 'active' : ''); ?>" aria-current="<?php echo e($i == 0 ? 'true' : 'false'); ?>"
            aria-label="<?php echo e($slider->text); ?>"></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Dynamic Slider -->
    <div class="carousel-inner">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
            <img src="<?php echo e(asset('slider-images/' . $slider->image)); ?>" class="d-block img-fluid"
                alt="<?php echo e($slider->text); ?>">
            <div class="carousel-caption" style="bottom: 0 !important;">
                <h3 class="text-center slider-caption"><?php echo e($slider->text); ?></h3>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Carousel Controls -->
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
<section class="py-3 bg-light">
    <div class="container-fluid">
        <div>
            <div class="position-relative d-flex overflow-x-hidden align-items-center">
                <!-- Latest Updates Button -->

                <button class="btn btn-primary btn-sm me-2 rounded py-2" id="basic-addon2"
                    style="z-index: 999;width: 200px;"> <?php if(Cookie::get('language') == '2'): ?>
                    नवीनतम अपडेट
                    <?php else: ?>
                    Latest Updates
                    <?php endif; ?></button>

                <!-- Marquee Section -->
                <div id="marqueeWrapper" class="w-100 overflow-hidden">
                    <div id="marqueeContainer" class="d-flex gap-3 flex-nowrap align-items-center">
                        <?php $__currentLoopData = $news_scrollers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scroller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($scroller->website_url)): ?>
                        <a href="<?php echo e($scroller->website_url != '' ? (str_starts_with($scroller->website_url, 'http') ? $scroller->website_url : 'http://' . $scroller->website_url) : url($scroller->website_url)); ?>"
                            target="_blank"
                            class="d-inline-flex align-items-center justify-content-center text-center card-lift px-3 rounded border shadow-sm"
                            style="height: 30px; white-space: nowrap; background-color: #f8f9fa;">
                            <span class="text-gray-800"><?php echo e($scroller->menutitle); ?></span>
                        </a>
                        <?php elseif(!empty($scroller->pdf_file)): ?>
                        <a href="<?php echo e(asset($scroller->pdf_file)); ?>" target="_blank"
                            class="d-inline-flex align-items-center justify-content-center text-center card-lift px-3 rounded border shadow-sm"
                            style="height: 30px; white-space: nowrap; background-color: #f8f9fa;">
                            <span class="text-gray-800"><?php echo e($scroller->menutitle); ?></span>
                        </a>
                        <?php else: ?>
                        <a href="<?php echo e(route('user.letest_updates', $scroller->menu_slug)); ?>"
                            class="d-inline-flex align-items-center justify-content-center text-center card-lift px-3 rounded border shadow-sm"
                            style="height: 30px; white-space: nowrap; background-color: #f8f9fa;">
                            <span class="text-gray-800"><?php echo e($scroller->menutitle); ?></span>
                        </a>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <!-- Play/Pause Button -->
                <button class="btn btn-secondary btn-sm me-2 rounded" id="playPauseBtn" style="z-index: 999;">
                    <i class="material-icons menu-icon">pause</i>
                </button>
            </div>

        </div>
    </div>
    </div>
</section>
<section class="py-3">
    <div class="container-fluid">
        <div class="row gy-4 gy-xl-0">
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="<?php echo e(asset('assets/images/icons/1.jpg')); ?>" alt=""
                            class="avatar avatar-xl rounded-circle" style="object-fit: cover;">
                    </div>
                    <div class="card-body pt-2" style=" height: 100px;">
                        <h4 class="mb-3">
                            <?php if(Cookie::get('language') == '2'): ?>
                            निदेशक संदेश
                            <?php else: ?>
                            Director Message
                            <?php endif; ?>
                        </h4>
                        <a href="<?php echo e(url('menu/director-message')); ?>" class="icon-link icon-link-hover link-primary">
                            <?php if(Cookie::get('language') == '2'): ?>
                            संदेश
                            <?php else: ?>
                            Message
                            <?php endif; ?>
                        </a> <br>
                        <a href="<?php echo e(url('menu/previous-directors')); ?>" class="icon-link icon-link-hover link-primary">
                            <?php if(Cookie::get('language') == '2'): ?>
                            पूर्व निदेशक
                            <?php else: ?>
                            Previous Director
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="<?php echo e(asset('assets/images/icons/3.jpg')); ?>" alt=""
                            class="avatar avatar-xl rounded-circle" style="object-fit: cover;">
                    </div>
                    <div class="card-body pt-2" style="overflow-y:scroll; height: 100px;">
                        <h4 class="mb-3">
                            <?php if(Cookie::get('language') == '2'): ?>
                            दौड़ पाठ्यक्रम
                            <?php else: ?>
                            Runing Courses
                            <?php endif; ?>
                        </h4>
                        <?php if(count($current_course) > 0): ?>
                        <ul>
                            <?php $i = 0; ?>
                            <?php $__currentLoopData = $current_course; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('user.courseDetailslug', ['slug' => $course->id])); ?>"
                                    style="color: #af2910;">
                                    <?php echo e($course->course_name); ?>

                                </a><br>
                                Course Coordinator: <?php echo e($course->coordinator_id); ?><br>
                                <?php echo e(date('d F, Y', strtotime($course->course_start_date))); ?> to
                                <?php echo e(date('d F, Y', strtotime($course->course_end_date))); ?>

                            </li>
                            <?php $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>



                        <?php else: ?>
                        <span>
                            <?php if(Cookie::get('language') == '2'): ?>
                            कोई पाठ्यक्रम उपलब्ध नहीं है
                            <?php else: ?>
                            No Course Available
                            <?php endif; ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer" style="border:none;float: right;text-align: right;">
                        <button class="btn btn-primary btn-sm"> <a href="<?php echo e(route('user.runningCourses')); ?>"
                                style="color: white;">
                                <?php if(Cookie::get('language') == '2'): ?>
                                सभी को देखें
                                <?php else: ?>
                                View All
                                <?php endif; ?>
                            </a></button>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="<?php echo e(asset('assets/images/icons/4.jpg')); ?>" alt=""
                            class="avatar avatar-xl rounded-circle text-center" style="object-fit: cover;">
                    </div>
                    <div class="card-body pt-2 pb-2" style="overflow-y:scroll;height: 100px;">
                        <h4 class="mb-3">
                            <?php if(Cookie::get('language') == '2'): ?>
                            आगामी पाठ्यक्रम
                            <?php else: ?>
                            Upcoming Courses
                            <?php endif; ?>
                        </h4>
                        <?php if(count($upcoming_course) > 0): ?>
                        <ul>

                            <?php $__currentLoopData = $upcoming_course; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('user.courseDetailslug', ['slug' => $course->id])); ?>"
                                    style="color: #af2910;">
                                    <?php echo e($course->course_name); ?>

                                </a><br>
                                Course Coordinator: <?php echo e($course->coordinator_id); ?><br>
                                <?php echo e(date('d F, Y', strtotime($course->course_start_date))); ?> to
                                <?php echo e(date('d F, Y', strtotime($course->course_end_date))); ?>

                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                        <?php else: ?>
                        <span> <?php if(Cookie::get('language') == '2'): ?>
                            कोई पाठ्यक्रम उपलब्ध नहीं है
                            <?php else: ?>
                            No Course Available
                            <?php endif; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer" style="border:none;float: right;text-align: right;">
                        <button class="btn btn-primary btn-sm"><a href="<?php echo e(route('user.upcomingCourses')); ?>"
                                style="color: white;"><?php if(Cookie::get('language') == '2'): ?>
                                सभी को देखें
                                <?php else: ?>
                                View All
                                <?php endif; ?></a></button>

                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="<?php echo e(asset('assets/images/icons/2.jpg')); ?>" alt=""
                            class="avatar avatar-xl rounded-circle text-center" style="object-fit: cover;">
                    </div>
                    <div class="card-body pt-2" style="height: 100px;">
                        <h4 class="mb-3">
                            <?php if(Cookie::get('language') == '2'): ?>
                            प्रशिक्षण कैलेंडर
                            <?php else: ?>
                            Training Calendar
                            <?php endif; ?>
                        </h4>
                        <a href="<?php echo e(url('cms/training_cal')); ?>" class="icon-link icon-link-hover link-primary">
                            <?php if(Cookie::get('language') == '2'): ?>
                            एलबीएसएनएए का प्रशिक्षण कैलेंडर
                            <?php else: ?>
                            Training Calendar of LBSNAA
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="<?php echo e(asset('assets/images/icons/5.jpg')); ?>" alt=""
                            class="avatar avatar-xl rounded-circle text-center" style="object-fit: cover;">
                    </div>
                    <div class="card-body pt-2" style="height: 100px;">
                        <h4 class="mb-3">
                            <?php if(Cookie::get('language') == '2'): ?>
                            अकादमी में जीवन
                            <?php else: ?>
                            Life at Academy
                            <?php endif; ?>
                        </h4>
                        <a href="<?php echo e(url('menu/the-academy-experience')); ?>"
                            class="icon-link icon-link-hover link-primary">
                            <?php if(Cookie::get('language') == '2'): ?>
                            अकादमी का अनुभव
                            <?php else: ?>
                            The Academy Experience
                            <?php endif; ?>

                        </a><br>
                        <a href="<?php echo e(url('menu/a-day-in-the-life-of-a-trainee')); ?>"
                            class="icon-link icon-link-hover link-primary">
                            <?php if(Cookie::get('language') == '2'): ?>
                            एक प्रशिक्षु के जीवन का एक दिन
                            <?php else: ?>
                            A day in the life of a Trainee
                            <?php endif; ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <div class="card card-lift text-center text-lg-start h-100">
                    <div class="p-3 p-lg-4 text-center">
                        <img src="<?php echo e(asset('assets/images/icons/6.jpg')); ?>" alt=""
                            class="avatar avatar-xl rounded-circle text-center" style="object-fit: cover;">
                    </div>
                    <div class="card-body pt-2" style="height: 100px;">
                        <h4 class="mb-3">
                            <?php if(Cookie::get('language') == '2'): ?>
                            अकादमी स्मारिका
                            <?php else: ?>
                            Academy Souvenir
                            <?php endif; ?>
                        </h4>
                        <a href="<?php echo e(url('souvenir?pro_category=7')); ?>" class="icon-link icon-link-hover link-primary">
                            <?php if(Cookie::get('language') == '2'): ?>
                            यादगार लम्हे
                            <?php else: ?>
                            Memorabilia
                            <?php endif; ?>
                        </a><br>
                        <a href="<?php echo e(url('souvenir?pro_category=6')); ?>" class="icon-link icon-link-hover link-primary">
                            <?php if(Cookie::get('language') == '2'): ?>
                            परिधान
                            <?php else: ?>
                            Apparel
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 mb-5 bg-light" id="news">
    <div class="container-fluid">
        <div class="row gy-4">
            <div class="col-12 col-md-9">
                <div class="mb-3">
                    <div class="card card-hover border">
                        <div class="card-header" style="background-color:#af2910">
                            <h3 class="text-white"><?php if(Cookie::get('language') == '2'): ?>
                                अकादमी समाचार
                                <?php else: ?>
                                LBSNAA Academy News
                                <?php endif; ?> <span class="float-end"><a href="<?php echo e(route('user.news_listing')); ?>"
                                        class="text-white"
                                        style="text-decoration: none;font-size:14px"><?php if(Cookie::get('language') == '2'): ?>
                                        सभी को देखें
                                        <?php else: ?>
                                        View All
                                        <?php endif; ?></a></span></h3>
                        </div>
                    </div>
                </div>
                <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                    <!-- Carousel Inner (carousel items) -->
                    <div class="carousel-inner">
                        <?php $__currentLoopData = $news->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Group cards into chunks of 3 for each slide -->
                        <div class="carousel-item <?php echo e($loop->first ? 'active' : ''); ?>">
                            <div class="row">
                                <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- Card -->
                                <div class="col-lg-4 col-md-6 col-12 mb-4">
                                    <div class="card">
                                        <div class="card-header p-0 border-0">
                                            <img src="<?php echo e(isset($slider->main_image) && !empty($slider->main_image) ? asset($slider->main_image) : asset('assets/images/4.jpg')); ?>"
                                                class="card-img-top img-fluid" alt="blogpost"
                                                style="object-fit: cover; height: 250px; width: 100%;">
                                        </div>
                                        <div class="card-body" style="height: 200px; overflow-y: hidden;">
                                            <span class="fs-5 mb-2 fw-semibold d-block text-success">
                                                <?php if(Cookie::get('language') == '2'): ?>
                                                प्रकाशित किया गया:
                                                <?php else: ?>
                                                Posted On:
                                                <?php endif; ?>

                                                <?php echo e(\Carbon\Carbon::parse($slider->start_date)->format('d F, Y')); ?></span>
                                            <h3><a href="<?php echo e(route('user.newsbyslug', $slider->title_slug)); ?>"
                                                    class="icon-link icon-link-hover link-dark fw-semibold"><?php echo e($slider->title); ?></a>
                                            </h3>
                                            <p><?php echo e($slider->short_description); ?></p>
                                        </div>
                                        <div class="card-footer border-0" style="height:50px;">
                                            <a href="<?php echo e(route('user.newsbyslug', $slider->title_slug)); ?>"
                                                class="icon-link icon-link-hover link-primary fw-semibold">
                                                <span>
                                                    <?php if(Cookie::get('language') == '2'): ?>
                                                    और पढ़ें
                                                    <?php else: ?>
                                                    Read More
                                                    <?php endif; ?>
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>



            </div>
            <div class="col-12 col-md-3">
                <!-- Quick Links Section -->
                <div class="card card-hover border">
                    <div class="card-header" style="background-color:#af2910">
                        <h3 class="text-white"><?php if(Cookie::get('language') == '2'): ?> त्वरित लिंक्स <?php else: ?> Quick Links
                            <?php endif; ?></h3>
                    </div>
                    <div class="card-body p-0" style="height: 520px; overflow-y: scroll;">
                        <ul class="mt-2 mb-2 list-group list-group-flush">
                            <?php $__currentLoopData = $quick_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $quick_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="text-start list-group-item">
                                <?php if(!empty($quick_link->url)): ?>
                                <a href="<?php echo e($quick_link->url_type == 'external' ? (str_starts_with($quick_link->url, 'http') ? $quick_link->url : 'http://' . $quick_link->url) : url($quick_link->url)); ?>"
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
    </div>
</section>

<style>
#marqueeWrapper {
    position: relative;
    overflow: hidden;
    white-space: nowrap;
}

#marqueeContainer {
    display: inline-flex;
    white-space: nowrap;
    will-change: transform;
}

#marqueeWrapper {
    overflow: hidden;
    position: relative;
}

#marqueeContainer {
    display: flex;
    gap: 3px;
    flex-nowrap: nowrap;
    align-items: center;
    animation: marquee 50s linear infinite;
    will-change: transform;
    /* Helps with smoother animations */
}

@keyframes marquee {
    0% {
        transform: translateX(100%);
    }

    100% {
        transform: translateX(-100%);
    }
}

.paused {
    animation-play-state: paused;
}
</style>
<script>
document.getElementById('marqueeWrapper').addEventListener('mouseenter', function() {
    document.getElementById('marqueeContainer').style.animationPlayState = 'paused';
});

document.getElementById('marqueeWrapper').addEventListener('mouseleave', function() {
    document.getElementById('marqueeContainer').style.animationPlayState = 'running';
});
</script>
<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/user/pages/home.blade.php ENDPATH**/ ?>