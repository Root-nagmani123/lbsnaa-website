

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Add New Quick Link</h2>

    <form action="<?php echo e(route('admin.quick_links.store')); ?>" method="POST"  enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="text">Text</label>
            <input type="text" name="text" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="link_type">Link Type</label>
            <select id="link_type" class="form-control" name="link_type" onchange="toggleLinkInput()">
                <option value="url">URL</option>
                <option value="file">Document</option>
            </select>
        </div>

        <div id="url_input" class="form-group" style="display: none;">
            <label for="url">URL</label>
            <input type="test" name="url" class="form-control">
            <small class="text-muted">Provide a URL if you're not uploading a document.</small>
        </div>

        <div id="file_input" class="form-group" style="display: none;">
            <label for="file">Document (PDF)</label>
            <input type="file" name="file" class="form-control">
            <small class="text-muted">Provide a file if you're not entering a URL.</small>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="checkbox" name="status" value="1">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/home/quick_link_create.blade.php ENDPATH**/ ?>