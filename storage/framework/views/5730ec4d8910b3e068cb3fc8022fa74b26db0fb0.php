
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Center</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Home Banner - Micro</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Edit Home Banner - Micro</h4>
                </div>
                <form action="<?php echo e(route('slider.update', $slider->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="language" class="label">Page Language</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        <?php echo e($slider->language == '1' ? 'checked' : ''); ?>>
                                    English
                                    <input type="radio" name="language" value="2"
                                        <?php echo e($slider->language == '2' ? 'checked' : ''); ?>>
                                    Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="research_centre">Select Research Centre:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="research_centre"
                                        id="research_centre" required>
                                        <option value="" disabled
                                            <?php echo e(is_null($slider->research_centre) ? 'selected' : ''); ?>>
                                            Select Research Centre
                                        </option>
                                        <?php $__currentLoopData = $researchCentres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id); ?>"
                                            <?php echo e((string)$slider ->research_centre === (string)$id ? 'selected' : ''); ?>>
                                            <?php echo e($name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="slider_image" class="label">Slider Image</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="slider_image" id="slider_image"
                                        class="form-control text-dark ps-5 h-58">
                                    <img src="<?php echo e(asset('storage/' . $slider->slider_image)); ?>" alt="Current Image"
                                        width="150" class="mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="slider_text" class="label">Slider Text</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="slider_text" id="slider_text"
                                        class="form-control text-dark ps-5 h-58" value="<?php echo e($slider->slider_text); ?>"
                                        required>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="slider_description" class="label">Slider Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="slider_description" id="slider_description"
                                        class="form-control text-dark ps-5 h-58"
                                        required><?php echo e($slider->slider_description); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="status" class="label">Status *</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="status" id="status" class="form-control text-dark ps-5 h-58" required>
                                        <option value="" selected>Select Status</option>
                                        <option value="1" <?php echo e($slider->status == '1' ? 'selected' : ''); ?>>Active</option>
                                        <option value="0" <?php echo e($slider->status == '0' ? 'selected' : ''); ?>>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0 mt-4">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="<?php echo e(route('slider.index')); ?>" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/micro/slider/edit.blade.php ENDPATH**/ ?>