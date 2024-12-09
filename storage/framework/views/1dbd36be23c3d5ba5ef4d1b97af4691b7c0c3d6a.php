

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Create Section Category</h2>
            <form action="<?php echo e(route('admin.section_category.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
 
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <input type="hidden" name="section_id" value="<?php echo e($id); ?>">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="officer_incharge">Officer Incharge</label>
                    <input type="text" name="officer_Incharge" class="form-control">
                </div>

                <div class="form-group">
                    <label for="alternative_incharge_1st">Alternative Incharge 1st</label>
                    <input type="text" name="alternative_incharge_1st" class="form-control">
                </div>

                <div class="form-group">
                    <label for="alternative_incharge_2st">Alternative Incharge 2nd</label>
                    <input type="text" name="alternative_incharge_2st" class="form-control">
                </div>

                <div class="form-group">
                    <label for="alternative_incharge_3st">Alternative Incharge 3rd</label>
                    <input type="text" name="alternative_incharge_3st" class="form-control">
                </div>

                <div class="form-group">
                    <label for="alternative_incharge_4st">Alternative Incharge 4th</label>
                    <input type="text" name="alternative_incharge_4st" class="form-control">
                </div>

                <div class="form-group">
                    <label for="alternative_incharge_5st">Alternative Incharge 5th</label>
                    <input type="text" name="alternative_incharge_5st" class="form-control">
                </div>

                <div class="form-group">
                    <label for="section_head">Section Head</label>
                    <input type="text" name="section_head" class="form-control">
                </div>

                <div class="form-group">
                    <label for="phone_internal_office">Phone Internal Office</label>
                    <input type="text" name="phone_internal_office" class="form-control">
                </div>

                <div class="form-group">
                    <label for="phone_internal_residence">Phone Internal Residence</label>
                    <input type="text" name="phone_internal_residence" class="form-control">
                </div>

                <div class="form-group">
                    <label for="phone_p_t_office">Phone P&T Office</label>
                    <input type="text" name="phone_p_t_office" class="form-control">
                </div>

                <div class="form-group">
                    <label for="phone_p_t_residence">Phone P&T Residence</label>
                    <input type="text" name="phone_p_t_residence" class="form-control">
                </div>

                <div class="form-group">
                    <label for="fax">Fax</label>
                    <input type="text" name="fax" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/sections/section_category/create.blade.php ENDPATH**/ ?>