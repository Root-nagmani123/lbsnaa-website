

<?php $__env->startSection('title', 'Add Academy Souvenir'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Souvenir</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Souvenir</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add Academy Souvenir</h4>
                </div>

                <form action="<?php echo e(route('academy_souvenirs.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"> English
                                    <input type="radio" name="language" value="2"> Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="product_category">Product Category :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="product_category" id="product_category"
                                        required>
                                        <option value="1" class="text-dark" selected>Select Category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" class="text-dark"><?php echo e($category->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="product_title">Product Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="product_title"
                                        id="product_title" value="<?php echo e(old('product_title')); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="product_type">Product Type :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="product_type" id="product_type"
                                        required>
                                        <option value="" class="text-dark">Select</option>
                                        <option value="Sale" class="text-dark">Sale</option>
                                        <option value="Download" class="text-dark">Download</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="sale_fields" style="display: none;">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="product_price">Product Price :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="number" class="form-control text-dark ps-5 h-58" name="product_price"
                                            id="product_price" step="0.01" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="product_discounted_price">Product Discounted Price :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="number" class="form-control text-dark ps-5 h-58" name="product_discounted_price"
                                            id="product_discounted_price" step="0.01" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="contact_email_id">Contact Email :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="email" class="form-control text-dark ps-5 h-58" name="contact_email_id"
                                            id="contact_email_id" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="download_fields" style="display: none;">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="document_upload">Document Upload :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="file" class="form-control text-dark ps-5 h-58" name="document_upload"
                                            id="document_upload" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="upload_image">Upload Image :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark ps-5 h-58" name="upload_image"
                                        id="upload_image" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="product_description">Product Description :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                        <textarea name="product_description" id="product_description" rows="3" required class="form-control text-dark"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="product_status">Product Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="product_status" id="product_status"
                                        required>
                                        <option value="" class="text-dark" selected>Select</option>
                                        <option value="1" class="text-dark">Active</option>
                                        <option value="0" class="text-dark">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button> &nbsp;
                            <a href="<?php echo e(route('academy_souvenirs.index')); ?>" class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

    <script>
        // Show/hide sale or download fields based on product type
        document.getElementById('product_type').addEventListener('change', function() {
            if (this.value === 'Sale') {
                document.getElementById('sale_fields').style.display = 'block';
                document.getElementById('download_fields').style.display = 'none';
            } else if (this.value === 'Download') {
                document.getElementById('sale_fields').style.display = 'none';
                document.getElementById('download_fields').style.display = 'block';
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/souvenirModule/academy_souvenirs/create.blade.php ENDPATH**/ ?>