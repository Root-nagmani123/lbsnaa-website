

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Edit Staff Member</h4>
            </div>

                <form action="<?php echo e(route('admin.staff.update', $staff->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1" <?php echo e($staff->language == '1' ? 'checked' : ''); ?>> English
                                    <input type="radio" name="language" value="2" <?php echo e($staff->language == '2' ? 'checked' : ''); ?>> Hindi
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="name">Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="name" id="name" value="<?php echo e($staff->name); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="name_in_hindi">Name in Hindi :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="name_in_hindi" id="name_in_hindi" value="<?php echo e($staff->name_in_hindi); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="email">Email :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="email" class="form-control text-dark ps-5 h-58" name="email" id="email" value="<?php echo e($staff->email); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image">Upload Image :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark ps-5 h-58" name="image" id="image">
                                    <?php if($staff->image): ?>
                        <img src="<?php echo e(asset($staff->image)); ?>" alt="Staff Image" width="100">
                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="description" class="label">Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                       <textarea name="description" id="description" class="form-control ps-5 text-dark"><?php echo e($staff->description); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="description_in_hindi" class="label">Description in Hindi</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                       <textarea name="description_in_hindi" id="description_in_hindi" class="form-control ps-5 text-dark"><?php echo e($staff->description_in_hindi); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="designation">Designation :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="designation" id="designation" value="<?php echo e($staff->designation); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="designation_in_hindi">Designation in Hindi :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="designation_in_hindi" id="designation_in_hindi" value="<?php echo e($staff->designation_in_hindi); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="section">Section :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="section" id="section" required>
                                        <option value="Section 1" class="text-dark" <?php echo e($staff->section == 'Section 1' ? 'selected' : ''); ?>>Select 1</option>
                                        <option value="Section 2" class="text-dark" <?php echo e($staff->section == 'Section 2' ? 'selected' : ''); ?>>Select 1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="country_code">Country Code :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="country_code" id="country_code" value="<?php echo e($staff->country_code); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="std_code">STD Code :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="std_code" id="std_code" value="<?php echo e($staff->std_code); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_internal_office">Phone Internal Office :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="phone_internal_office" id="phone_internal_office" value="<?php echo e($staff->phone_internal_office); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_internal_residence">Phone Internal Residence :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="phone_internal_residence" id="phone_internal_residence" value="<?php echo e($staff->phone_internal_residence); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_pt_office">Phone P&T Office :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="phone_pt_office" id="phone_pt_office" value="<?php echo e($staff->phone_pt_office); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_pt_residence">Phone P&T Residence :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="phone_pt_residence" id="phone_pt_residence" value="<?php echo e($staff->phone_pt_residence); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="mobile">Mobile :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="mobile" id="mobile" value="<?php echo e($staff->mobile); ?>">
                                    <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div style="color: red;"><?php echo e($message); ?></div>  <!-- Display error if any -->
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="abbreviation">Abbreviation :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="abbreviation" id="abbreviation" value="<?php echo e($staff->abbreviation); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="rank">Rank :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="rank" id="rank" value="<?php echo e($staff->rank); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="present_at_station">Present at Station :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="present_at_station" id="present_at_station" required>
                                        <option value="1" class="text-dark" <?php echo e($staff->present_station == 1 ? 'selected' : ''); ?>>Yes</option>
                                        <option value="0" class="text-dark" <?php echo e($staff->present_station == 0 ? 'selected' : ''); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="acm_member">ACM Member :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="acm_member" id="acm_member" required>
                                        <option value="1" class="text-dark" <?php echo e($staff->acm_member == 1 ? 'selected' : ''); ?>>Yes</option>
                                        <option value="0" class="text-dark" <?php echo e($staff->acm_member == 0 ? 'selected' : ''); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="acm_status_in_committee">ACM Status in Committee :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="acm_status_in_committee" id="acm_status_in_committee" value="<?php echo e($staff->acm_status_in_committee); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="co_opted_member">Co-Opted Member :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="co_opted_member" id="co_opted_member" required>
                                        <option value="1" class="text-dark" <?php echo e($staff->co_opted_member == 1 ? 'selected' : ''); ?>>Yes</option>
                                        <option value="0" class="text-dark" <?php echo e($staff->co_opted_member == 0 ? 'selected' : ''); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="page_status">Page Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="page_status" id="page_status" required>
                                        <option value="1" class="text-dark" <?php echo e($staff->page_status == 1 ? 'selected' : ''); ?>>Active</option>
                                        <option value="0" class="text-dark" <?php echo e($staff->page_status == 0 ? 'selected' : ''); ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update Staff Member</button>
                            <a href="<?php echo e(route('admin.staff.index')); ?>" class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp11\htdocs\lbsnaa-website\resources\views/admin/staff_members/edit.blade.php ENDPATH**/ ?>