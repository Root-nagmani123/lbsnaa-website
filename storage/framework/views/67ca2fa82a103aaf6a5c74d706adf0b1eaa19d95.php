<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="col-12">
                <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-2">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('home')); ?>" style="color: #af2910;">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Product List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product List Section -->
<section class="py-4">
    <div class="container">

        <!-- Search Form -->
        <form id="search_frm" name="search_frm" method="get" action="">
            <div class="content-box mb-4">
                <h3>Search Products</h3>
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Keywords">Keywords:</label>
                            <input type="text" class="form-control" id="Keywords" name="keywords" value="<?php echo e($keywords); ?>"
                                placeholder="Search Products">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Products">Products:</label>
                            <select name="pro_category" id="type" class="form-control">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"
                                    <?php echo e(request('pro_category') == $category->id ? 'selected' : ''); ?>>
                                    <?php echo e($category->category_name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Products">Product Type:</label>
                            <select name="producttype" id="producttype" class="form-control">
                                <option value="">Select</option>
                                <option value="1" <?php echo e(request('producttype') == 1 ? 'selected' : ''); ?>>Sale</option>
                                <option value="2" <?php echo e(request('producttype') == 2 ? 'selected' : ''); ?>>Download</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button id="btn2" type="reset" class="btn btn-outline-warning fw-bold w-100"
                            onclick="pageLoad()">Reset</button>
                        <input type="hidden" name="action" value="reset">
                        <button id="btn2" type="submit" class="btn btn-outline-primary fw-bold w-100">Submit</button>
                        <input type="hidden" name="action" value="submit">
                    </div>
                </div>
            </div>
        </form>

        <!-- Products Display -->
        <div class="row g-4">
            <?php if(count($souvenir) > 0): ?>
            <?php $__currentLoopData = $souvenir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-lg-4 d-flex">
                <div class="card w-100 shadow-sm">
                    <div class="card-header text-truncate" style="border-bottom: 0;">
                        <h5 title="<?php echo e($product->product_title); ?>"><?php echo e(Str::limit($product->product_title, 50, '...')); ?>

                        </h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <img src="<?php echo e(asset('AcademySouvenir/images/' . $product->upload_image)); ?>"
                            class="card-img-top img-fluid rounded" alt="<?php echo e($product->product_title); ?>"
                            style="height: 200px; object-fit: cover;">
                        <p class="description mt-3 text-truncate">
                            <?php echo (Str::limit($product->product_description, 50, '...'));?></p>
                        <p class="price fw-bold text-primary"><span>₹</span> <?php echo e($product->product_price); ?></p>
                        <p class="mt-auto small">
                            <span class="text-muted">For Purchase, kindly contact:</span><br>
                            <a href="mailto:<?php echo e($product->contact_email_id); ?>"><?php echo e($product->contact_email_id); ?></a>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <div>No Result Found</div>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/souvenir_list.blade.php ENDPATH**/ ?>