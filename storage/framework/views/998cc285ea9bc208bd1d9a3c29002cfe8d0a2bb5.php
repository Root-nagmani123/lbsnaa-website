<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($photoGalleries)): ?>
<section class="py-2">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                           Home
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/lbsnaa-sub_m/mediagallery?slug=<?php echo e($slug); ?>" style="color: #af2910;">Media Gallery</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Photo Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid">
    <div style="margin: 20px 0;">
        
        <form action="<?php echo e(route('user.media_gallery')); ?>" method="GET" id="filterForm" style="display: flex; gap: 10px; align-items: center;">

            <!-- Pass slug explicitly -->
            <input type="hidden" name="slug" value="<?php echo e($slug); ?>">

            <!-- Keyword filter -->
            <label for="keyword" class="fw-semibold label">Search:</label>
            <input type="text" name="keyword" id="keyword" placeholder="Keyword Search" value="<?php echo e(request('keyword')); ?>" class="form-control h-58 w-25">

            <!-- Category filter -->
            <select name="category" class="form-control h-58 w-25">
                <option value="">All Categories</option>
                <?php $__currentLoopData = $photoGalleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($gallery->category_id); ?>" <?php echo e(request('category') == $gallery->category_id ? 'selected' : ''); ?>>
                    <?php echo e($gallery->media_category_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <!-- Year filter -->
            <select name="year" class="form-control h-58 w-25">
                <option value="">All Years</option>
                <?php for($year = date('Y'); $year >= 2000; $year--): ?>
                <option value="<?php echo e($year); ?>" <?php echo e(request('year') == $year ? 'selected' : ''); ?>>
                    <?php echo e($year); ?>

                </option>
                <?php endfor; ?>
            </select>

            <!-- Submit button -->
            <button type="submit" class="btn btn-outline-primary fw-semibold">Submit</button>

            <!-- Clear filters -->
            <button type="button" onclick="clearFilters()" class="fw-semibold btn btn-outline-secondary">Clear</button>
        </form>

    </div>


    <!-- Gallery Display -->
    <?php if($photoGalleries->isNotEmpty()): ?>
    <div class="row">
        <?php $__currentLoopData = $photoGalleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <div class="card">

                <div class="card-body" style="padding:0;">
                    <a href="<?php echo e(route('media_gallery_details', ['id' => $gallery->category_id, 'slug' => $slug])); ?>"> <!-- Use route helper -->
                        <img src="<?php echo e(asset('storage/uploads/category_images/' . $gallery->category_image)); ?>" class="img-fluid rounded" 
                        alt="<?php echo e($gallery->category_image); ?>" style="width: 100%; height: 250px; object-fit: cover;">
                    </a>
                </div> 
                <div class="card-footer" style="border:none;height: 100px;overflow-y: scroll;">
                    <div class="form-field mt-2">
                        <p class="card-text"><?php echo e($gallery->media_category_name); ?></p>
                    </div>
                </div>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php else: ?>
    <p style="text-align: center; color: #999; font-size: 18px;">No photos available.</p>
    <?php endif; ?>
<?php endif; ?>
</section>
<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    function clearFilters() {
        // Redirect to the URL with only the slug parameter
        const slug = new URLSearchParams(window.location.search).get('slug');
        window.location.href = `<?php echo e(route('user.media_gallery')); ?>?slug=${slug}`;
    }
</script>



<?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/user/pages/microsites/media_gallery.blade.php ENDPATH**/ ?>