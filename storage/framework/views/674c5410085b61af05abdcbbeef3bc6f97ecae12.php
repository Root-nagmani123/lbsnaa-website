<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div style="margin: 20px 0;">
    <form action="<?php echo e(route('photoGalleries.filterGallery')); ?>" method="GET" style="display: flex; gap: 10px; align-items: center;">
        <!-- Keyword Search -->
        <label for="keyword">Search:</label>
        <input type="text" name="keyword" id="keyword" placeholder="Keyword Search" value="<?php echo e(request('keyword')); ?>" style="padding: 5px;">

        <!-- Category Dropdown -->
        <select name="category" style="padding: 5px;">
            <option value="">All Categories</option>
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($course->id); ?>" <?php echo e(request('category') == $course->id ? 'selected' : ''); ?>>
                    <?php echo e($course->course_name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <!-- Year Dropdown -->
        <select name="year" style="padding: 5px;">
            <option value="">All Years</option>
            <?php for($year = date('Y'); $year >= 2000; $year--): ?>
                <option value="<?php echo e($year); ?>" <?php echo e(request('year') == $year ? 'selected' : ''); ?>><?php echo e($year); ?></option>
            <?php endfor; ?>
        </select>

        <!-- Submit Button -->
        <button type="submit" style="padding: 5px 10px;">Submit</button>

        <!-- Clear Button -->
        <button type="button" onclick="clearFilters()" style="padding: 5px 10px; background-color: #f4f4f4; border: 1px solid #ccc;">Clear</button>
    </form>
</div>

<!-- Gallery Display -->
<?php if(isset($photoGalleries) && $photoGalleries->isNotEmpty()): ?>
    <div class="gallery-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php $__currentLoopData = $photoGalleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="gallery-card" style="width: 300px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <div style="padding: 15px;">
                    <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;"><?php echo e($gallery->image_title_english); ?></h3>
                    <p style="margin: 0; font-size: 14px; color: #666;"><?php echo e($gallery->image_title_hindi); ?></p>
                </div>

                <?php
                    $imageFiles = json_decode($gallery->image_files, true);
                ?>

                <?php if(is_array($imageFiles) && !empty($imageFiles)): ?>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; padding: 10px;">
                        <?php $__currentLoopData = $imageFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="width: 100px; height: 100px; overflow: hidden; border: 1px solid #ddd; border-radius: 5px;">
                                <img src="<?php echo e(asset('storage/' . $imageFile)); ?>" alt="<?php echo e($gallery->image_title_english); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p style="padding: 10px; color: #999;">No valid images available.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <p style="text-align: center; color: #999; font-size: 18px;">No photos available.</p>
<?php endif; ?>

<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    function clearFilters() {
        document.getElementById('keyword').value = '';
        document.querySelector('select[name="category"]').selectedIndex = 0;
        document.querySelector('select[name="year"]').selectedIndex = 0;
        document.querySelector('form').submit();
    }
</script>
<?php /**PATH C:\xampp11\htdocs\lbsnaa-website\resources\views/user/pages/microsites/media_gallery.blade.php ENDPATH**/ ?>