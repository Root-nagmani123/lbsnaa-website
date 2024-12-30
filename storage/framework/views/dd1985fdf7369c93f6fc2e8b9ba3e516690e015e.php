<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

<!-- Search Form -->
<section class="py-3">
    <div class="container">
        <div class="contsearch">
            <form id="form2" method="GET" action="<?php echo e(route('user.news_old_listing')); ?>" class="row">
                <div class="col-lg-4">
                    <label for="Keywords" class="form-label">Search by Day/Month/Year:</label>
                    <input type="text" id="Keywords" name="keywords" value="<?php echo e(request('keywords')); ?>"
                        placeholder="Search News" class="form-control ps-5 text-dark h-58">
                </div>
                <div class="col-lg-4">
                    <label for="year" class="form-label">Years</label>
                    <select name="year" id="year" fdprocessedid="wgb9i" class="form-select ps-5 text-dark h-58">
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-lg-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-outline-primary fw-bold w-100">Submit</button>
                    <a href="<?php echo e(route('user.news_old_listing')); ?>"
                        class="btn btn-outline-warning fw-bold w-100">Reset</a>

                </div>
            </form>
        </div>
    </div>
</section>


<!-- News Section -->
<section class="py-6">
    <div class="container">
        <?php if($news->isNotEmpty()): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <!-- Card -->
                <div class="card shadow-lg card-lift h-100">
                    <div class="card-header p-0">
                        <a href="#">
                            <img src="<?php echo e($slider->main_image ? asset($slider->main_image) : asset('assets/images/4.jpg')); ?>"
                                class="card-img-top" alt="blogpost" style="height: 200px; object-fit: cover;">
                        </a>
                    </div>
                    <!-- Card body -->
                    <div class="card-body d-flex flex-column">
                        <a href="#" class="fs-6 mb-2 fw-semibold d-block text-success">Posted On:
                            <?php echo e(\Carbon\Carbon::parse($slider->start_date)->format('d F, Y')); ?></a>
                        <h3 class="fs-5">
                            <a href="<?php echo e(route('user.newsbyslug', $slider->title_slug)); ?>"
                                class="text-dark text-decoration-none">
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
        <?php else: ?>
        <h4>No News Found</h4>
        <?php endif; ?>
    </div>
</section>

<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/old_news.blade.php ENDPATH**/ ?>