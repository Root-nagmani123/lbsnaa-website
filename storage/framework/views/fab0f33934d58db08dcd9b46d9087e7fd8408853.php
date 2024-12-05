

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Whats New / Quick Link</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Quick Links</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Edit Quick Links</h4>
                </div>
                <form action="<?php echo e(route('microquicklinks.update', $quickLink->id)); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group mb-4">
                                <label for="language" class="label">Page Language</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        <?php echo e($quickLink->language == 1 ? 'checked' : ''); ?>> English
                                    <input type="radio" name="language" value="2"
                                        <?php echo e($quickLink->language == 2 ? 'checked' : ''); ?>> Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label for="research_centre_id" class="label">Select Research Centre</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="research_centre_id" id="research_centre_id" class="form-control"
                                        required>
                                        <option value="">Select Research Centre</option>
                                        <?php $__currentLoopData = $researchCentres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id); ?>"
                                            <?php echo e($quickLink->research_centre_id == $id ? 'selected' : ''); ?>>
                                            <?php echo e($name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['research_centre_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label for="category_type" class="label">Category Type</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="categorytype" id="categorytype"
                                        class="form-control text-dark ps-5 h-58" required>
                                        <option value="">Select Category</option>
                                        <option value="1" <?php echo e($quickLink->categorytype == 1 ? 'selected' : ''); ?>>What's
                                            New
                                        </option>
                                        <option value="2" <?php echo e($quickLink->categorytype == 2 ? 'selected' : ''); ?>>Quick
                                            Link
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="txtename" class="label">Name</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="txtename" id="txtename"
                                        class="form-control text-dark ps-5 h-58" value="<?php echo e($quickLink->txtename); ?>"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="menu_type" class="label">Menu Type</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="menu_type" id="menu_type" class="form-control text-dark ps-5 h-58"
                                        required>
                                        <option value="">Select</option>
                                        <option value="1" <?php echo e($quickLink->menu_type == 1 ? 'selected' : ''); ?>>Content
                                        </option>
                                        <option value="2" <?php echo e($quickLink->menu_type == 2 ? 'selected' : ''); ?>>PDF file
                                            Upload
                                        </option>
                                        <option value="3" <?php echo e($quickLink->menu_type == 3 ? 'selected' : ''); ?>>Website URL
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="meta-fields" style="display: <?php echo e($quickLink->menu_type == 1 ? 'block' : 'none'); ?>;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="meta_title" class="label">Meta Title</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" name="meta_title" id="meta_title"
                                                class="form-control text-dark ps-5 h-58"
                                                value="<?php echo e($quickLink->meta_title); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="meta_keyword" class="label">Meta Keyword</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" name="meta_keyword" id="meta_keyword"
                                                class="form-control text-dark ps-5 h-58"
                                                value="<?php echo e($quickLink->meta_keyword); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="meta_description" class="label">Meta Description</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea name="meta_description" id="meta_description" class="form-control"
                                                rows="5"><?php echo e($quickLink->meta_description); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="description" class="label">Description</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea name="description" id="description" class="form-control"
                                                rows="5"><?php echo e($quickLink->description); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="pdf-field"
                            style="display: <?php echo e($quickLink->menu_type == 2 ? 'block' : 'none'); ?>;">
                            <div class="form-group">
                                <label for="pdf_file" class="label">Document Upload</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="pdf_file" id="pdf_file"
                                        class="form-control text-dark ps-5 h-58">
                                    <?php if($quickLink->pdf_file): ?>
                                    <small>Current file: <a href="<?php echo e(asset('storage/' . $quickLink->pdf_file)); ?>"
                                            target="_blank">View File</a></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="website-field"
                            style="display: <?php echo e($quickLink->menu_type == 3 ? 'block' : 'none'); ?>;">
                            <div class="form-group mb-4">
                                <label for="website_url" class="label">Website URL</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="url" name="website_url" id="website_url"
                                        class="form-control text-dark ps-5 h-58" value="<?php echo e($quickLink->website_url); ?>"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="start_date" class="label">Start Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" name="start_date" id="start_date"
                                        class="form-control text-dark ps-5 h-58" value="<?php echo e($quickLink->start_date); ?>"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="termination_date" class="label">Termination Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" name="termination_date" id="termination_date"
                                        class="form-control text-dark ps-5 h-58"
                                        value="<?php echo e($quickLink->termination_date); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="status" class="label">Page Status</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="status" id="status" class="form-control text-dark ps-5 h-58">
                                        <option value="1" <?php echo e($quickLink->status == 1 ? 'selected' : ''); ?>>Active
                                        </option>
                                        <option value="0" <?php echo e($quickLink->status == 0 ? 'selected' : ''); ?>>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0 mt-4">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="<?php echo e(route('microquicklinks.index')); ?>"
                                class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('menu_type').addEventListener('change', function() {
    const value = this.value;
    document.getElementById('meta-fields').style.display = value === '1' ? 'block' : 'none';
    document.getElementById('pdf-field').style.display = value === '2' ? 'block' : 'none';
    document.getElementById('website-field').style.display = value === '3' ? 'block' : 'none';
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/micro/quick_links/edit.blade.php ENDPATH**/ ?>