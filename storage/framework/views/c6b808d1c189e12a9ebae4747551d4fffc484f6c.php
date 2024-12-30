<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($news)): ?>

<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="col-12 mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>" class="text-danger">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-danger">Academy News</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Academy News</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="container">
    <div class="row mb-3">
        <div class="col-md-9"></div>
        <div class="col-md-3 text-end">
            <a href="<?php echo e(route('user.news_old_listing')); ?>" class="btn btn-outline-primary fw-semibold btn-sm">Archive</a>
        </div>
    </div> 
</section>

<section class="py-6">
    <div class="container">
        <div class="row g-4">
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <!-- Card -->
                <div class="card shadow-lg card-lift h-100">
                    <div class="card-header p-0">
                        <a href="#">
                            <img src="<?php echo e(isset($slider->main_image) && !empty($slider->main_image) ? asset($slider->main_image) : asset('assets/images/4.jpg')); ?>"
                                class="card-img-top" alt="blogpost" style="height: 200px; object-fit: cover;">
                        </a>
                    </div>
                    <!-- Card body -->
                    <div class="card-body d-flex flex-column">
                        <a href="#"
                            class="fs-6 mb-2 fw-semibold d-block text-success">Posted On: <?php echo e(\Carbon\Carbon::parse($slider->start_date)->format('d F, Y')); ?></a>
                        <h3 class="fs-5">
                            <a href="<?php echo e(route('user.newsbyslug', $slider->title_slug)); ?>" class="text-dark text-decoration-none">
                                <?php echo e($slider->title); ?>

                            </a>
                        </h3>
                        <p class="text-truncate" style="max-height: 3rem;"><?php echo e($slider->short_description); ?></p>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer bg-white border-0 text-end">
                        <a href="<?php echo e(route('user.newsbyslug', $slider->title_slug)); ?>" class="text-primary">Read More</a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Load More Button (optional) -->
        <!-- 
        <div class="row">
            <div class="col-12 text-center mt-4">
                <a href="#" class="btn btn-primary">
                    <div class="spinner-border spinner-border-sm me-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    Load More
                </a>
            </div>
        </div>
        -->
    </div>
</section>



<?php else: ?>
<h4>News does not exist</h4>
<?php endif; ?>


<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/newsList.blade.php ENDPATH**/ ?>