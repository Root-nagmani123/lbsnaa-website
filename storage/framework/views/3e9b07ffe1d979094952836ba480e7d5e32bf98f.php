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
                    <h4 class="fw-semibold fs-18 mb-0">Add Quick Links</h4>
                </div>

                <form action="<?php echo e(route('admin.quick_links.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="text" class="label">Text</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="text" class="form-control text-dark ps-5 h-58" required>
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
                                        <option value="" selected>Select</option>
                                        <option value="url">URL</option>
                                        <option value="file">Document</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6" id="url_input" style="display: none;">
                            <div class="form-group mb-4">
                                <label for="url" class="label">URL</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="test" name="url" class="form-control text-dark ps-5 h-58">
                                    <small class="text-muted">Provide a URL if you're not uploading a document.</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="file_input" style="display: none;">
                            <div class="form-group mb-4">
                                <label for="file" class="label">Document (PDF)</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="file" class="form-control text-dark ps-5 h-58">
                                    <small class="text-muted">Provide a file if you're not entering a URL.</small>
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
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0 mt-4">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button> &nbsp;
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
function toggleLinkInput() {
    var linkType = document.getElementById('link_type').value;

    // Hide both by default
    document.getElementById('url_input').style.display = 'none';
    document.getElementById('file_input').style.display = 'none';

    // Show the relevant input based on selection
    if (linkType === 'url') {
        document.getElementById('url_input').style.display = 'block';
    } else if (linkType === 'file') {
        document.getElementById('file_input').style.display = 'block';
    }
}

// Call the function on page load in case there's a default selection
window.onload = function() {
    toggleLinkInput();
}
</script>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/admin/home/quick_link_create.blade.php ENDPATH**/ ?>