<!-- resources/views/user/pages/microsites/video_gallery.blade.php -->

<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Media Gallery</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Video Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<div class="container my-4">
    <div class="row g-4">
        <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-sm-12 d-flex align-items-stretch">
            <!-- Bootstrap Card -->
            <div class="card h-100 shadow-sm">
                <!-- Card Image -->
                 <!-- Video Player -->
                    <video controls>
                        <source src="<?php echo e(asset('storage/' . $video->video_upload)); ?>" type="video/mp4" style="object-fit: cover; height: 200px; width: 100%;">
                        Your browser does not support the video tag.
                    </video>
                <!-- Card Body -->
                <div class="card-body d-flex flex-column">
                    <!-- Video Category -->
                    <h5 class="card-title text-primary"><?php echo e($video->category_name); ?></h5>
                    <!-- Video Titles -->
                    <h6 class="text-muted"><?php echo e($video->video_title_en); ?></h6>
                    <p class="text-muted"><?php echo e($video->video_title_hi); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/microsites/video_gallery.blade.php ENDPATH**/ ?>