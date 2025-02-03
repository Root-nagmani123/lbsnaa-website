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
                        <li class="breadcrumb-item active" aria-current="page">Academy News</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-6">
    <div class="container-fluid">
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3">
                <a href="<?php echo e(route('user.archive', ['slug' => $slug])); ?>" class="btn btn-outline-primary fw-semibold btn-sm" style="float: right">Archive</a>
            </div>
        </div>
        <div class="row">
            <?php if($newsItems->isEmpty()): ?>
                <div class="col-12 text-center">
                    <p class="text-muted fs-4">No News Available</p>
                </div>
            <?php else: ?>
                <?php $__currentLoopData = $newsItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-3">
                    <!-- Card -->
                    <div class="card mb-4 shadow-lg card-lift" style="height:500px;">
                        <div class="card-header" style="border:none;padding:0;">
                            <img src="<?php echo e(asset($news->main_image)); ?>" class="card-img-top" alt="blogpost"
                                style="object-fit: cover;height:250px;">
                        </div> 
                        <!-- Card body -->
                        <div class="card-body d-flex flex-column" style="height:200px;">
                            <a href="" class="fs-5 mb-2 fw-semibold d-block text-success">Posted On :-
                                <?php echo e($news->start_date); ?></a>
                            <h3><?php echo e($news->title); ?></h3>
                            <p><?php echo e($news->short_description); ?></p>
                            <!-- Media content -->
                        </div>
                        <div class="card-footer" style="border-top:none;">
                            <a href="<?php echo e(route('news.details', ['id' => $news->managenews_id, 'slug' => $news->research_centre_slug])); ?>"
                                class="text-inherit text-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/user/pages/microsites/news.blade.php ENDPATH**/ ?>