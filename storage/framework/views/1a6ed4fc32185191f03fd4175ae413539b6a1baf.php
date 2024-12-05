<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($nav_page)): ?>

<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Home link -->
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>">Home</a>
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

<section class="py-1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="mb-6 mb-lg-8">
                    <h2 class="h1 fw-bold text-primary">
                        <?php echo e($nav_page->menutitle); ?>

                    </h2>
                </div>
            </div>
        </div>

        <p><?= $nav_page->content ?></p>
    </div>
</section>


<?php else: ?>
<h4>News does not exist</h4>
<?php endif; ?>


<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/navigationpagesbyslug.blade.php ENDPATH**/ ?>