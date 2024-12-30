
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Center</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Photo Gallery</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Photo Gallery</h4>
            <a href="<?php echo e(route('micro-photo-gallery.create')); ?>">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Photo Gallery</span>
                    </span>
                </button>
            </a>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Category Name</th>
                            <th class="col">Media Category</th>
                            <th class="col">Option</th>
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <pre><?php echo e(print_r($galleries)); ?></pre> -->
                        <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Use $index to track the row number -->
                        <tr>
                            <!-- <pre><?php echo e(print_r($gallery)); ?></pre> -->
                            <td class="text-center"><?php echo e($index + 1); ?></td> <!-- Display index here -->
                            <td><?php echo e($gallery->name ?? 'N/A'); ?></td>
                            <td><?php echo e($gallery->media_cat_name ?? 'N/A'); ?></td>
                            <td>
                                <button type="button"
                                    class="btn btn-outline-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-name="<?php echo e($gallery->name); ?>"
                                    data-media_cat_name="<?php echo e($gallery->media_cat_name); ?>"
                                    data-image_title_english="<?php echo e($gallery->image_title_english); ?>"
                                    data-image_title_hindi="<?php echo e($gallery->image_title_hindi); ?>"
                                    data-related_news="<?php echo e($gallery->related_news); ?>"
                                    data-related_events="<?php echo e($gallery->related_events); ?>"
                                    data-image_files="<?php echo e($gallery->image_files); ?>">
                                    View
                                </button>
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-start gap-2">
                                    <a href="<?php echo e(route('micro-photo-gallery.edit', $gallery->id)); ?>"
                                        class="btn btn-success text-white btn-sm">
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('micro-photo-gallery.destroy', $gallery->id)); ?>" method="POST"
                                        class="m-0">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-primary text-white btn-sm"
                                            onclick="return confirm('Are you sure you want to delete?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="micro_manage_photo_galleries" data-column="status"
                                        data-id="<?php echo e($gallery->id); ?>" <?php echo e($gallery->status ? 'checked' : ''); ?>>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal start -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tenders / Circulars Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="sliderText">Title</label>
                    <p id="sliderText"></p> <!-- Text will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderDescription">Type</label>
                    <p id="sliderDescription"></p> <!-- Description will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderDescription">publish_date</label>
                    <p id="sliderDescription"></p> <!-- Description will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderDescription">Type</label>
                    <p id="sliderDescription"></p> <!-- Description will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderImage">Image</label>
                    <img id="sliderImage" src="" width="100" /> <!-- Image will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderLanguage">Language</label>
                    <p id="sliderLanguage"></p> <!-- Language will be injected here -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-slider');
    const modalTitle = document.getElementById('staticBackdropLabel');
    const modalBody = document.querySelector('.modal-body');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Extract data from the button
            const name = this.dataset.name;
            const media_cat_name = this.dataset.media_cat_name;
            const publish_date = this.dataset.publish_date;
            const image_title_english = this.dataset.image_title_english;
            const image_title_hindi = this.dataset.image_title_hindi;
            const image_files = this.dataset.image_files;

            // Parse the JSON string to get the array of image paths
            let images = [];
            try {
                images = JSON.parse(image_files); // Decode JSON-encoded string
            } catch (error) {
                console.error("Error parsing image files:", error);
            }
            const baseUrl = `${window.location.protocol}//${window.location.hostname}:${window.location.port}`;
            // Generate HTML for the images
            let imagesHtml = '<div>';
            images.forEach(image => {
                imagesHtml +=
                    `<img src="${baseUrl}/storage/${image}" alt="Image" style="max-width: 100px; margin-right: 10px;">`;
            });
            imagesHtml += '</div>';

            // Update modal content
            modalTitle.textContent = 'Photo Gallery Details';
            modalBody.innerHTML = `
                <div>
                    <p><strong>Category Name:</strong> ${name}</p>
                    <p><strong>Related Training Program:</strong> ${media_cat_name}</p>
                    <p><strong>Image Title (English):</strong> ${image_title_english}</p>
                    <p><strong>Image TItle (Hindi):</strong> ${image_title_hindi}</p>
                    <p><strong>Images:</strong></p>
                    ${imagesHtml}
                </div>`;
        });
    });
});
</script>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/micro/manage_media_center/manage_photo/index.blade.php ENDPATH**/ ?>