

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit Section Category</h2>
            <form action="<?php echo e(route('admin.section_category.update', $sectionCategory->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $sectionCategory->name)); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control"><?php echo e(old('description', $sectionCategory->description)); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="officer_incharge">Officer Incharge</label>
                    <input type="text" name="officer_Incharge" class="form-control" value="<?php echo e(old('officer_Incharge', $sectionCategory->officer_Incharge)); ?>">
                </div>

                <div class="form-group">
                    <label for="alternative_Incharge_1st">Alternative Incharge 1st</label>
                    <input type="text" name="alternative_Incharge_1st" class="form-control" value="<?php echo e(old('alternative_Incharge_1st', $sectionCategory->alternative_Incharge_1st)); ?>">
                </div>

                <div class="form-group">
                    <label for="alternative_Incharge_2st">Alternative Incharge 2nd</label>
                    <input type="text" name="alternative_Incharge_2st" class="form-control" value="<?php echo e(old('alternative_Incharge_2st', $sectionCategory->alternative_Incharge_2st)); ?>">
                </div>

                <div class="form-group">
                    <label for="alternative_Incharge_3st">Alternative Incharge 3rd</label>
                    <input type="text" name="alternative_Incharge_3st" class="form-control" value="<?php echo e(old('alternative_Incharge_3st', $sectionCategory->alternative_Incharge_3st)); ?>">
                </div>

                <div class="form-group">
                    <label for="alternative_Incharge_4st">Alternative Incharge 4th</label>
                    <input type="text" name="alternative_Incharge_4st" class="form-control" value="<?php echo e(old('alternative_Incharge_4st', $sectionCategory->alternative_Incharge_4st)); ?>">
                </div>

                <div class="form-group">
                    <label for="alternative_Incharge_5st">Alternative Incharge 5th</label>
                    <input type="text" name="alternative_Incharge_5st" class="form-control" value="<?php echo e(old('alternative_Incharge_5st', $sectionCategory->alternative_Incharge_5st)); ?>">
                </div>

                <div class="form-group">
                    <label for="section_head">Section Head</label>
                    <input type="text" name="section_head" class="form-control" value="<?php echo e(old('section_head', $sectionCategory->section_head)); ?>">
                </div>

                <div class="form-group">
                    <label for="phone_internal_office">Phone Internal Office</label>
                    <input type="text" name="phone_internal_office" class="form-control" value="<?php echo e(old('phone_internal_office', $sectionCategory->phone_internal_office)); ?>">
                </div>

                <div class="form-group">
                    <label for="phone_internal_residence">Phone Internal Residence</label>
                    <input type="text" name="phone_internal_residence" class="form-control" value="<?php echo e(old('phone_internal_residence', $sectionCategory->phone_internal_residence)); ?>">
                </div>

                <div class="form-group">
                    <label for="phone_p_t_office">Phone P&T Office</label>
                    <input type="text" name="phone_p_t_office" class="form-control" value="<?php echo e(old('phone_p_t_office', $sectionCategory->phone_p_t_office)); ?>">
                </div>

                <div class="form-group">
                    <label for="phone_p_t_residence">Phone P&T Residence</label>
                    <input type="text" name="phone_p_t_residence" class="form-control" value="<?php echo e(old('phone_p_t_residence', $sectionCategory->phone_p_t_residence)); ?>">
                </div>

                <div class="form-group">
                    <label for="fax">Fax</label>
                    <input type="text" name="fax" class="form-control" value="<?php echo e(old('fax', $sectionCategory->fax)); ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $sectionCategory->email)); ?>">
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="1" <?php echo e($sectionCategory->status == 1 ? 'selected' : ''); ?>>Active</option>
                        <option value="0" <?php echo e($sectionCategory->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                </div>

                <input type="hidden" name="section_id" class="form-control" value="<?php echo e(old('fax', $sectionCategory->section_id)); ?>">

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp6\htdocs\lbsnaa_website\resources\views/admin/sections/section_category/edit.blade.php ENDPATH**/ ?>