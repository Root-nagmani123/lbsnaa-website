<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($gallery_details)): ?>
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('user.micrositebyslug', ['slug' => $slug])); ?>"
                                style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/lbsnaa-sub_m/mediagallery?slug=<?php echo e($slug); ?>" style="color: #af2910;">Media
                                Gallery</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Photo Gallery Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid">
    <!-- Gallery Display -->
    <?php if($gallery_details->isNotEmpty()): ?>
    <div class="row">
        <?php $__currentLoopData = $gallery_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        // Decode the JSON array of image files
        $imageFiles = json_decode($gallery->image_files, true);
        ?>

        <?php if(!empty($imageFiles) && is_array($imageFiles)): ?>
        <!-- Loop through all images -->
        <?php $__currentLoopData = $imageFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-body p-0">
                    <a href="<?php echo e(asset('storage/' . $imageFile)); ?>" data-fancybox="gallery" data-caption="<?php echo e($gallery->image_title_english); ?>">
                        <img src="<?php echo e(asset('storage/' . $imageFile)); ?>"
                             class="img-fluid rounded-top mb-2"
                             alt="Gallery Image"
                             style="width: 100%; height: 250px; object-fit: cover;">
                    </a>
                    <div class="card-footer text-center">
                        <p class="card-text mb-0"><?php echo e($gallery->image_title_english); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <!-- Fallback image if no image is found -->
        <div class="col-md-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-body p-0">
                    <img src="<?php echo e(asset('storage/uploads/default-placeholder.png')); ?>"
                         class="img-fluid rounded-top"
                         alt="No Image Available"
                         style="width: 100%; height: 250px; object-fit: cover;">
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php else: ?>
        <p style="text-align: center; color: #999; font-size: 18px;">No photos available.</p>
    <?php endif; ?>
</section>

<?php endif; ?>
<!-- Include Fancybox CSS -->
<link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" rel="stylesheet">

<!-- Include Fancybox JS -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        Fancybox.bind("[data-fancybox='gallery']", {
            Toolbar: {
                display: ["zoom", "close"], // Display zoom and close buttons
            },
            closeButton: "inside", // Optional: Inside the lightbox
        });
    });
</script>

<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/user/pages/microsites/media_gallery_details.blade.php ENDPATH**/ ?>