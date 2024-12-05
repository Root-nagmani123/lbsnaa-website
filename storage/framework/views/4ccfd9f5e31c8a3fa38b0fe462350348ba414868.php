
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Training Program</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('Managenews.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Training Program - Micro</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">Edit Training Program</h4>
            </div>
            <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <form action="<?php echo e(route('training-programs.update', $trainingProgram->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Page Language</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="radio" name="language" value="1"
                                    <?php echo e($trainingProgram->language == '1' ? 'checked' : ''); ?> required> English
                                <input type="radio" name="language" value="2"
                                    <?php echo e($trainingProgram->language == '2' ? 'checked' : ''); ?>> Hindi
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
                                        <?php echo e(is_null($trainingProgram->research_centre) ? 'selected' : ''); ?>>
                                        Select Research Centre
                                    </option>
                                    dd($researchCentres);
                                    <?php $__currentLoopData = $researchCentres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id); ?>"
                                        <?php echo e((string)$trainingProgram->research_centre === (string)$id ? 'selected' : ''); ?>>
                                        <?php echo e($name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Program Name</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="program_name" class="form-control text-dark ps-5 h-58"
                                    value="<?php echo e($trainingProgram->program_name); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Venue</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="venue" class="form-control text-dark ps-5 h-58"
                                    value="<?php echo e($trainingProgram->venue); ?>" required>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Program Co-ordinator</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="program_coordinator" class="form-control text-dark ps-5 h-58"
                                    value="<?php echo e($trainingProgram->program_coordinator); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Program Description</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <textarea name="program_description" class="form-control text-dark ps-5 h-58"
                                    required><?php echo e($trainingProgram->program_description); ?></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Start Date</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="date" name="start_date" class="form-control text-dark ps-5 h-58"
                                    value="<?php echo e($trainingProgram->start_date); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">End Date</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="date" name="end_date" class="form-control text-dark ps-5 h-58"
                                    value="<?php echo e($trainingProgram->end_date); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Important Links</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="important_links" class="form-control text-dark ps-5 h-58"
                                    value="<?php echo e($trainingProgram->important_links); ?>" required>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Registration Status</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="registration_status" id="registration_status"
                                    class="form-control text-dark ps-5 h-58">
                                    <option value="1" class="text-dark"
                                        <?php echo e($trainingProgram->registration_status == 1? 'selected' : ''); ?>>On</option>
                                    <option value="2" class="text-dark"
                                        <?php echo e($trainingProgram->registration_status == 2? 'selected' : ''); ?>>Off</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Page Status</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="page_status" class="form-control text-dark ps-5 h-58" required>
                                    <option value="1" <?php echo e($trainingProgram->page_status == 1? 'selected' : ''); ?>>Active
                                    </option>
                                    <option value="0" <?php echo e($trainingProgram->page_status == 0? 'selected' : ''); ?>>Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="<?php echo e(route('training-programs.index')); ?>" class="btn btn-secondary text-white fw-semibold">Back</a>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let today = new Date().toISOString().split('T')[0];

    const startDateInput = document.querySelector('input[name="start_date"]');
    const endDateInput = document.querySelector('input[name="end_date"]');

    // Set min date for both start and end date on page load
    startDateInput.setAttribute('min', today);
    endDateInput.setAttribute('min', today);

    // Update end date min whenever start date is changed
    startDateInput.addEventListener('change', function() {
        endDateInput.setAttribute('min', this.value);
    });
});
</script>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/micro/training_program/edit.blade.php ENDPATH**/ ?>