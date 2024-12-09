

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Edit Faculty Member</h2>
    
    <form action="<?php echo e(route('admin.faculty.update', $faculty->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?> <!-- This is necessary to send a PUT request -->

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="category">Category *</label>
                <select name="category" class="form-control" required>
                    <option value=" ">Select Category</option>
                    <option value="1" <?php echo e($faculty->category == 1 ? 'selected' : ''); ?>>Inhouse</option>
                    <option value="2" <?php echo e($faculty->category == 2 ? 'selected' : ''); ?>>Visiting</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="name">Name *</label>
                <input type="text" name="name" class="form-control" value="<?php echo e($faculty->name); ?>" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name_in_hindi">Name in Hindi</label>
                <input type="text" name="name_in_hindi" class="form-control" value="<?php echo e($faculty->name_in_hindi); ?>">
            </div>

            <div class="col-md-6">
                <label for="email">Email *</label>
                <input type="email" name="email" class="form-control" value="<?php echo e($faculty->email); ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="image">Upload Image *</label>
                <input type="file" name="image" class="form-control">
                <?php if($faculty->image): ?>
                    <img src="<?php echo e(asset($faculty->image)); ?>" alt="Current Image" width="100">
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <label for="description">Description *</label>
                <textarea name="description" class="form-control" required><?php echo e($faculty->description); ?></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="description_in_hindi">Description in Hindi</label>
                <textarea name="description_in_hindi" class="form-control"><?php echo e($faculty->description_in_hindi); ?></textarea>
            </div>

            <div class="col-md-6">
                <label for="designation">Designation *</label>
                <input type="text" name="designation" class="form-control" value="<?php echo e($faculty->designation); ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="designation_in_hindi">Designation in Hindi</label>
                <input type="text" name="designation_in_hindi" class="form-control" value="<?php echo e($faculty->designation_in_hindi); ?>">
            </div>

            <div class="col-md-6">
                <label for="cadre">Cadre</label>
                <select name="cadre" class="form-control">
                    <option value="">Select Cadre</option>
                    <option value="1" <?php echo e($faculty->cadre == 1 ? 'selected' : ''); ?>>AM</option>
                    <option value="2" <?php echo e($faculty->cadre == 2 ? 'selected' : ''); ?>>AP</option>
                    <!-- Add your options here -->
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="batch">Batch</label>
                <select name="batch" class="form-control">
                    <option value="">Select Batch</option>
                    <option value="1950" <?php echo e($faculty->batch == '1950' ? 'selected' : ''); ?>>1950</option>
                    <option value="1951" <?php echo e($faculty->batch == '1951' ? 'selected' : ''); ?>>1951</option>
                    <!-- Add your options here -->
                </select>
            </div>

            <div class="col-md-6">
                <label for="service">Service</label>
                <input type="text" name="service" class="form-control" value="<?php echo e($faculty->service); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="country_code">Country Code</label>
                <input type="text" name="country_code" class="form-control" value="<?php echo e($faculty->country_code); ?>">
            </div>

            <div class="col-md-6">
                <label for="std_code">STD Code</label>
                <input type="text" name="std_code" class="form-control" value="<?php echo e($faculty->std_code); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="phone_internal_office">Phone Internal Office</label>
                <input type="text" name="phone_internal_office" class="form-control" value="<?php echo e($faculty->phone_internal_office); ?>">
            </div>

            <div class="col-md-6">
                <label for="phone_internal_residence">Phone Internal Residence</label>
                <input type="text" name="phone_internal_residence" class="form-control" value="<?php echo e($faculty->phone_internal_residence); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="phone_pt_office">Phone P&T Office</label>
                <input type="text" name="phone_pt_office" class="form-control" value="<?php echo e($faculty->phone_pt_office); ?>">
            </div>

            <div class="col-md-6">
                <label for="phone_pt_residence">Phone P&T Residence</label>
                <input type="text" name="phone_pt_residence" class="form-control" value="<?php echo e($faculty->phone_pt_residence); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" class="form-control" value="<?php echo e($faculty->mobile); ?>">
            </div>

            <div class="col-md-6">
                <label for="abbreviation">Abbreviation</label>
                <input type="text" name="abbreviation" class="form-control" value="<?php echo e($faculty->abbreviation); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="rank">Rank</label>
                <select name="rank" class="form-control">
                    <option value="1" <?php echo e($faculty->rank == 1 ? 'selected' : ''); ?>>1</option>
                    <option value="2" <?php echo e($faculty->rank == 2 ? 'selected' : ''); ?>>2</option>
                    <option value="3" <?php echo e($faculty->rank == 3 ? 'selected' : ''); ?>>3</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="present_at_station">Present at Station</label>
                <select name="present_at_station" class="form-control">
                    <option value="1" <?php echo e($faculty->present_at_station == 1 ? 'selected' : ''); ?>>Yes</option>
                    <option value="0" <?php echo e($faculty->present_at_station == 0 ? 'selected' : ''); ?>>No</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="acm_member">ACM Member</label>
                <select name="acm_member" class="form-control">
                    <option value="1" <?php echo e($faculty->acm_member == 1 ? 'selected' : ''); ?>>Yes</option>
                    <option value="0" <?php echo e($faculty->acm_member == 0 ? 'selected' : ''); ?>>No</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="acm_status_in_committee">ACM Status in Committee</label>
                <input type="text" name="acm_status_in_committee" class="form-control" value="<?php echo e($faculty->acm_status_in_committee); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="co_opted_member">Co-Opted Member</label>
                <select name="co_opted_member" class="form-control">
                    <option value="1" <?php echo e($faculty->co_opted_member == 1 ? 'selected' : ''); ?>>Yes</option>
                    <option value="0" <?php echo e($faculty->co_opted_member == 0 ? 'selected' : ''); ?>>No</option>
                </select>
            </div>

           

       

            <div class="col-md-6">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="1" <?php echo e($faculty->status == 1 ? 'selected' : ''); ?>>Active</option>
                    <option value="0" <?php echo e($faculty->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Update Faculty Member</button>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/faculty_members/edit.blade.php ENDPATH**/ ?>