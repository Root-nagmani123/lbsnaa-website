<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="py-5">
    <!-- container -->
    <div class="container">
        <div class="row">
            <!-- Title Column -->
            <div class="col-12 col-lg-5">
                <div class="mb-2">
                    <!-- Title -->
                    <h3 class="mb-3 fw-bold">Media Gallery</h3>
                </div>
            </div>
        </div>
        
        <!-- Success Message -->
        <?php if(session('success')): ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Media Gallery -->
        <div class="row g-3 py-lg-4 pt-4 justify-content-start">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="#" class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift">
                    <div class="p-3">
                        <img src="<?php echo e(asset('assets/images/audio-book.png')); ?>" alt="Academy Song"
                            class="img-fluid rounded-circle" style="max-width: 100px;">
                    </div>
                    <div class="mt-3">
                        <h4 class="text-center">Academy Song</h4>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="<?php echo e(route('user.photogallery')); ?>"
                    class="bg-white text-center shadow-sm text-wrap rounded-4 w-100 border card-lift">
                    <div class="p-3">
                        <img src="<?php echo e(asset('assets/images/gallery (1).png')); ?>" alt="Photo Gallery"
                            class="img-fluid rounded-circle" style="max-width: 100px;">
                    </div>
                    <div class="mt-3">
                        <h4 class="text-center">Photos Gallery</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/mediagallery.blade.php ENDPATH**/ ?>