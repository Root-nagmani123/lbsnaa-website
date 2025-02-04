<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($nav_page)): ?>

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>" style="color: #af2910;"><?php if(Cookie::get('language') ==
                                '2'): ?>घर
                                <?php else: ?>
                                Home
                                <?php endif; ?></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo e($nav_page->menutitle); ?>

                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="mb-2">
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
<h4>
    <?php if(Cookie::get('language') ==
    '2'): ?>समाचार मौजूद नहीं है
    <?php else: ?>
    News does not exist
    <?php endif; ?>
</h4>
<?php endif; ?>


<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/user/pages/footer_details_page.blade.php ENDPATH**/ ?>