

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Module</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Sections</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Create Section Category</h4>
                </div>
                <form action="<?php echo e(route('admin.section_category.update', $sectionCategory->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"> English
                                    <input type="radio" name="language" value="2"> Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="name" class="label">Name</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="name" class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('name', $sectionCategory->name)); ?>" required>
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description" class="label">Description</label>
                                <div class="form-group position-relative">
                                    <textarea name="description" class="form-control ps-5 text-dark"
                                        rows="5"><?php echo e(old('description', $sectionCategory->description)); ?></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="officer_incharge" class="label">Officer Incharge</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="officer_Incharge" class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('officer_Incharge', $sectionCategory->officer_Incharge)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_Incharge_1st" class="label">Alternative Incharge 1st</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="alternative_Incharge_1st" class="form-control"
                                        value="<?php echo e(old('alternative_Incharge_1st', $sectionCategory->alternative_Incharge_1st)); ?>">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_Incharge_2st" class="label">Alternative Incharge 2nd</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="alternative_Incharge_2st"
                                        class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('alternative_Incharge_2st', $sectionCategory->alternative_Incharge_2st)); ?>">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_Incharge_3st" class="label">Alternative Incharge 3rd</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="alternative_Incharge_3st"
                                        class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('alternative_Incharge_3st', $sectionCategory->alternative_Incharge_3st)); ?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_Incharge_4st" class="label">Alternative Incharge 4th</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="alternative_Incharge_4st"
                                        class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('alternative_Incharge_4st', $sectionCategory->alternative_Incharge_4st)); ?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_Incharge_5st" class="label">Alternative Incharge 5th</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="alternative_Incharge_5st"
                                        class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('alternative_Incharge_5st', $sectionCategory->alternative_Incharge_5st)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="section_head" class="label">Section Head</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="section_head" class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('section_head', $sectionCategory->section_head)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_internal_office" class="label">Phone Internal Office</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="phone_internal_office"
                                        class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('phone_internal_office', $sectionCategory->phone_internal_office)); ?>">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_internal_residence" class="label">Phone Internal Residence</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="phone_internal_residence"
                                        class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('phone_internal_residence', $sectionCategory->phone_internal_residence)); ?>">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_p_t_office" class="label">Phone P&T Office</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="phone_p_t_office" class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('phone_p_t_office', $sectionCategory->phone_p_t_office)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_p_t_residence" class="label">Phone P&T Residence</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="phone_p_t_residence"
                                        class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('phone_p_t_residence', $sectionCategory->phone_p_t_residence)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="fax" class="label">Fax</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="fax" class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('fax', $sectionCategory->fax)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="email" class="label">Email</label>
                                <div class="form-group position-relative">
                                    <input type="email" name="email" class="form-control ps-5 text-dark h-58"
                                        value="<?php echo e(old('email', $sectionCategory->email)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="status" class="label">Status</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="status" class="form-control ps-5 text-dark h-58" required>
                                        <option value="1" <?php echo e($sectionCategory->status == 1 ? 'selected' : ''); ?>>Active
                                        </option>
                                        <option value="0" <?php echo e($sectionCategory->status == 0 ? 'selected' : ''); ?>>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="section_id" class="form-control"
                            value="<?php echo e(old('fax', $sectionCategory->section_id)); ?>">

                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button>&nbsp;
                            <a href="<?php echo e(route('admin.section_category', ['catid' => $sectionCategory->section_id])); ?>" class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp11\htdocs\lbsnaa-website\resources\views/admin/sections/section_category/edit.blade.php ENDPATH**/ ?>