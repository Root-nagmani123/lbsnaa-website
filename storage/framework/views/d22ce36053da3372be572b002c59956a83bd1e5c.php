
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Training Program</h3> -->
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
                                <select class="form-select form-control  h-58" name="research_centre"
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
                                <input type="text" name="program_name" class="form-control text-dark  h-58"
                                    value="<?php echo e($trainingProgram->program_name); ?>">
                                <?php $__errorArgs = ['program_name'];
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
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Venue</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="venue" class="form-control text-dark  h-58"
                                    value="<?php echo e($trainingProgram->venue); ?>">
                                <?php $__errorArgs = ['venue'];
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
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Program Co-ordinator</label>
                            <div class="form-group position-relative">
                                <input type="text" name="program_coordinator" class="form-control text-dark  h-58"
                                    value="<?php echo e($trainingProgram->program_coordinator); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label">Program Description</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <textarea name="program_description" class="form-control text-dark  h-58" id="description">
                                    <?php echo e($trainingProgram->program_description); ?></textarea>
                                <?php $__errorArgs = ['program_description'];
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
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Start Date</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="date" name="start_date" class="form-control text-dark  h-58"
                                    value="<?php echo e($trainingProgram->start_date); ?>">
                                <?php $__errorArgs = ['start_date'];
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
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">End Date</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="date" name="end_date" class="form-control text-dark  h-58"
                                    value="<?php echo e($trainingProgram->end_date); ?>">
                                <?php $__errorArgs = ['end_date'];
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
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label">Important Links</label>
                            <div class="form-group position-relative">
                                <input type="text" name="important_links" class="form-control text-dark  h-58"
                                    value="<?php echo e($trainingProgram->important_links); ?>" id="important_links">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Registration Status</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="registration_status" id="registration_status"
                                    class="form-control text-dark  h-58">
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
                                <select name="page_status" class="form-control text-dark  h-58">
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
<!-- here this code use for the editer js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$('#important_links').summernote({
    tabsize: 2,
    height: 300
});
</script>  
<!-- here this code end of the editer js -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
  $.noConflict();
jQuery(document).ready(function ($) {
    $('#description').summernote({
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['style']], // Heading styles (e.g., H1, H2)
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']], // Font options
            ['fontname', ['fontname']], // Font family selector
            ['fontsize', ['fontsize']], // Font size selector
            ['color', ['color']], // Font and background color
            ['para', ['ul', 'ol', 'paragraph', 'align']], // Lists and alignment
            ['height', ['height']], // Line height adjustment
            ['table', ['table']], // Table insertion
            ['insert', ['link', 'picture', 'video', 'pdf']], // Insert elements
            ['view', ['fullscreen', 'codeview', 'help']], // Fullscreen, code view, and help
            ['misc', ['undo', 'redo']] // Undo and redo actions
        ],
        buttons: {
            pdf: function () {
                var ui = $.summernote.ui; 

                // Create a PDF upload button
                return ui.button({
                    contents: '<i class="note-icon-file"></i> PDF',
                    tooltip: 'Upload PDF',
                    click: function () {
                        // Trigger file input dialog
                        $('<input type="file" accept="application/pdf">')
                            .on('change', function (event) {
                                var file = event.target.files[0];
                                if (file) {
                                    uploadPDF(file);
                                }
                            })
                            .click();
                    }
                }).render();
            }
        }
    });
    

    function uploadPDF(file) {
        // Use AJAX to upload the file to your server
        var formData = new FormData();
        formData.append('file', file);

        $.ajax({
            url: '/admin/upload-pdf', // Your server endpoint
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token to headers
        },
            success: function (response) {
                $('#description').summernote('insertText', response.url);
      
            },
            error: function (xhr) {
                alert('Failed to upload PDF. Please try again.');
            }
        });
    }
});
</script>
<!-- here this code end of the editer js -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp11\htdocs\lbsnaa-website\resources\views/admin/micro/training_program/edit.blade.php ENDPATH**/ ?>