<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($nav_page)): ?>

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Home link -->
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>">
                                <?php if(Cookie::get('language') ==
                                '2'): ?>घर
                                <?php else: ?>
                                Home
                                <?php endif; ?>
                            </a>
                        </li>

                        <!-- Dynamic breadcrumbs -->
                        <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!$loop->last): ?>
                        <li class="breadcrumb-item">
                            <a
                                href="<?php echo e(route('user.navigationpagesbyslug', $crumb['slug'])); ?>"><?php echo e($crumb['title']); ?></a>
                        </li>
                        <?php else: ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($crumb['title']); ?></li>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </nav>


            </div>
        </div>
    </div>
</section>

<section class="py-8 bg-light">
    <div class="container-fluid">
        <div class="row gy-4 gy-xl-0">

            <div class="col-12">
                <!-- Additional content for the second column -->
                <div class="mb-3">
                    <h2 class="h1 fw-bold text-primary">
                        <?php echo e($nav_page->menutitle); ?>

                    </h2>
                </div>
                <?php if($director_img != ''): ?>
                <div class="row">
                    <img src="<?php echo e(asset($director_img->image)); ?>" alt="mentor" class="avatar avatar-xl rounded-circle">

                </div>
                <?php endif; ?>

                <p><?= $nav_page->content ?></p>
            </div>
        </div>
    </div>
</section>


<?php else: ?>
<h4>
    <?php if(Cookie::get('language') ==
    '2'): ?>समाचार मौजूद नहीं है
    <?php else: ?>
    News does not exist
    <?php endif; ?>
</h4>
<?php endif; ?>


<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/user/pages/navigationpagesbyslug.blade.php ENDPATH**/ ?>