

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Quick Links</h3>
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

                <form action="<?php echo e(route('admin.quick_links.update', $quickLink->id)); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="text" class="label">Text</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="text" class="form-control text-dark ps-5 h-58"
                                        value="<?php echo e($quickLink->text); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="link_type" class="label">Link Type</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select id="link_type" class="form-control h-58 text-dark ps-5" name="link_type"
                                        onchange="toggleLinkInput()">
                                        <option value="url" <?php echo e($quickLink->url ? 'selected' : ''); ?>>URL</option>
                                        <option value="file" <?php echo e($quickLink->file ? 'selected' : ''); ?>>Document</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="url_input" style="display: none;">
                            <!-- URL input field -->
                            <div class="form-group mb-4">
                                <label for="url" class="label">URL</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="url" value="<?php echo e($quickLink->url); ?>"
                                        class="form-control text-dark ps-5 h-58">
                                    <small class="text-muted">Provide a URL if you're not uploading a document.</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="file_input" style="display: none;">
                            <!-- File upload field -->
                            <div class="form-group mb-4">
                                <label for="file" class="label">Document (PDF)</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="file" class="form-control text-dark ps-5 h-58">
                                    <small class="text-muted">Upload a new document to replace the current one (PDF
                                        only).</small>

                                    <?php if($quickLink->file): ?>
                                    <p>Current File: <a href="<?php echo e(asset('quick-links-files/' . $quickLink->file)); ?>"
                                            target="_blank">View Document</a></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group mb-4">
                        <label for="status" class="label">Status</label>
                        <span class="star">*</span>
                        <div class="form-group position-relative">
                            <select name="status" id="status" class="form-control h-58 text-dark ps-5">
                                <option value="" selected>Select</option>
                                <option value="1" <?php echo e($quickLink->status == 1 ? 'selected' : ''); ?>>Active</option>
                                <option value="0" <?php echo e($quickLink->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                            </select>
                        </div>

                    </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0 mt-4">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="<?php echo e(route('admin.quick_links.index')); ?>"
                                class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function toggleLinkInput() {
        var linkType = document.getElementById('link_type').value;

        // Hide both by default
        document.getElementById('url_input').style.display = 'none';
        document.getElementById('file_input').style.display = 'none';

        // Show the relevant input based on the selection
        if (linkType === 'url') {
            document.getElementById('url_input').style.display = 'block';
        } else if (linkType === 'file') {
            document.getElementById('file_input').style.display = 'block';
        }
    }

    // Call the function on page load in case there's a default selection
    toggleLinkInput();
    
    document.getElementById('link_type').addEventListener('change', toggleLinkInput);
});
</script>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/home/quick_link_edit.blade.php ENDPATH**/ ?>