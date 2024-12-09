<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($photoGalleries)): ?>
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
                        <li class="breadcrumb-item active" aria-current="page">Photo Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="container">
    <!-- Filter Form -->
    <div style="margin: 20px 0;">
        <form action="<?php echo e(route('photoGalleries.filterGallery')); ?>" method="GET"
            style="display: flex; gap: 10px; align-items: center;">
            <!-- Keyword Search -->
            <label for="keyword" class="fw-semibold label">Search:</label>
            <input type="text" name="keyword" id="keyword" placeholder="Keyword Search" value="<?php echo e(request('keyword')); ?>"
                class="form-control ps-5 h-58 w-25">

            <!-- Category Dropdown -->
            <select name="category" class="form-control ps-5 h-58 w-25">
                <option value="">All Categories</option>
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($course->id); ?>" <?php echo e(request('category') == $course->id ? 'selected' : ''); ?>>
                    <?php echo e($course->course_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <!-- Year Dropdown -->
            <select name="year" class="form-control ps-5 h-58 w-25">
                <option value="">All Years</option>
                <?php for($year = date('Y'); $year >= 2000; $year--): ?>
                <option value="<?php echo e($year); ?>" <?php echo e(request('year') == $year ? 'selected' : ''); ?>><?php echo e($year); ?></option>
                <?php endfor; ?>
            </select>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-outline-primary fw-semibold">Submit</button>

            <!-- Clear Button -->
            <button type="button" onclick="clearFilters()" class="fw-semibold btn btn-outline-secondary">Clear</button>
        </form>
    </div>
<!-- Gallery Display -->
<?php if($photoGalleries->isNotEmpty()): ?>
<div class="row g-4">
    <?php $__currentLoopData = $photoGalleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $imageFiles = json_decode($gallery->image_files, true);
        ?>

        <?php if(is_array($imageFiles) && !empty($imageFiles)): ?>
            <?php $__currentLoopData = $imageFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 col-sm-6">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Image -->
                    <img src="<?php echo e(asset('storage/' . $imageFile)); ?>" class="card-img-top rounded-3 img-fluid" alt="<?php echo e($gallery->image_title_english); ?>" style="object-fit: cover; height: 200px;">
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($gallery->image_title_english); ?></h5>
                        <p class="card-text"><?php echo e($gallery->image_title_hindi); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <div class="col-12">
            <p style="text-align: center; color: #999;">No valid images available for this gallery.</p>
        </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php else: ?>
<p style="text-align: center; color: #999; font-size: 18px;">No photos available.</p>
<?php endif; ?>
<?php endif; ?>
<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/microsites/media_gallery.blade.php ENDPATH**/ ?>