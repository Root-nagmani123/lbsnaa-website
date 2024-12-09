
<?php $__env->startSection('title', 'Manage Video Gallery'); ?>

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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Video Gallery</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Manage Video Gallery</h4>
            <a href="<?php echo e(route('micro-video-gallery.create')); ?>">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New Video</span>
                    </span>
                </button>
            </a>
        </div>
        <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th> <!-- Index Column -->
                            <th class="col">Category</th>
                            <th class="col">Video Title (English)</th>
                            <th class="col">Video Title (Hindi)</th>
                            <th class="col">Video</th> <!-- Video Display Column -->
                            <th class="col">Option</th>
                            <th class="col">Page Status</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td> <!-- Display Index -->
                            <td><?php echo e($video->category_name); ?></td>
                            <td><?php echo e($video->video_title_en); ?></td>
                            <td><?php echo e($video->video_title_hi); ?></td>
                            <!-- Display the uploaded video -->
                            <td>
                                <?php if($video->video_upload): ?>
                                <!-- Assuming video_upload is the file path in your database -->
                                <video width="150" height="100" controls>
                                    <source src="<?php echo e(asset('storage/' . $video->video_upload)); ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <?php else: ?>
                                No Video Uploaded
                                <?php endif; ?>
                            </td>

                            <td>
                                <button type="button"
                                    class="btn btn-outline-primary text-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"

                                    data-category_name="<?php echo e($video->category_name); ?>"
                                    data-audio_title_en="<?php echo e($video->video_title_en); ?>"
                                    data-audio_title_hi="<?php echo e($video->video_title_hi); ?>"
                                    data-video_upload="<?php echo e($video->video_upload); ?>">

                                    View
                                </button>
                            </td>

                            <td>
                                <a href="<?php echo e(route('micro-video-gallery.edit', $video->id)); ?>"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="<?php echo e(route('micro-video-gallery.destroy', $video->id)); ?>" method="POST"
                                    style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-primary text-white"
                                    onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="micro_video_galleries" data-column="page_status"
                                        data-id="<?php echo e($video->id); ?>" <?php echo e($video->page_status ? 'checked' : ''); ?>>
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
    const viewButtons = document.querySelectorAll('.view-slider');  // Select all buttons with class 'view-slider'
    const modalTitle = document.getElementById('staticBackdropLabel');  // Modal title element
    const modalBody = document.querySelector('.modal-body');  // Modal body element

    // Loop through each button
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Extract data from the button attributes
            const category_name = this.dataset.category_name;
            const audio_title_en = this.dataset.audio_title_en;
            const audio_title_hi = this.dataset.audio_title_hi;
            const video_upload = this.dataset.video_upload;  // This holds the relative file path of the uploaded video

            // Form the correct URL to access the video file
            const videoUrl = `http://127.0.0.1:8000/storage/${video_upload}`;

            // Update modal content dynamically
            modalTitle.textContent = 'Video Details';  // Set modal title
            modalBody.innerHTML = `
                <div>
                    <p><strong>Category Name:</strong> ${category_name}</p>
                    <p><strong>Video Title (Hindi):</strong> ${audio_title_hi}</p>
                    <p><strong>Video Title (English):</strong> ${audio_title_en}</p>
                    <p><strong>Video:</strong></p>
                    ${video_upload ? `
                        <video width="560" height="315" controls style="width:300px; height:300px;">
                            <source src="${videoUrl}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    ` : `<p>No video available</p>`}  <!-- Embed video if path exists, otherwise show error -->
                </div>`;
        });
    });
});
</script>




<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/micro/manage_media_center/video_gallery/index.blade.php ENDPATH**/ ?>