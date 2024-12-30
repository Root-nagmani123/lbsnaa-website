
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">All Vacancies</h4>

            <a href="<?php echo e(route('manage_vacancy.create')); ?>">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Vacancy</span>
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
                            <th class="col">#</th> <!-- Add index column -->
                            <th class="col">Job Title</th>
                            <th class="col">Publish Date</th>
                            <th class="col">Expiry Date</th>
                            <th class="col">Language</th>
                            <th class="col">Uploaded Document / Website Link</th> <!-- Column for document or link -->
                            <th class="col">Option</th>
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vacancies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vacancy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Use $index for the incrementing index -->
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>

                            <td><?php echo e($vacancy->job_title); ?></td>
                            <td><?php echo e($vacancy->publish_date); ?></td>
                            <td><?php echo e($vacancy->expiry_date); ?></td>
                            <td><?php echo e($vacancy->language == 1 ? 'English' : 'Hindi'); ?></td>
                            <td>
                                <?php if($vacancy->content_type == 'PDF' && $vacancy->document_upload): ?>
                                <?php
                                $extension = pathinfo($vacancy->document_upload, PATHINFO_EXTENSION);
                                ?>
                                <?php if(in_array($extension, ['jpg', 'jpeg', 'png'])): ?>
                                <!-- Display image -->
                                <img src="<?php echo e(asset('storage/' . $vacancy->document_upload)); ?>" alt="Document Image"
                                    style="width: 100px; height: auto;">
                                <?php elseif($extension === 'pdf'): ?>
                                <!-- Provide a link to view or download the PDF -->
                                <a href="<?php echo e(asset('storage/' . $vacancy->document_upload)); ?>" target="_blank">View
                                    PDF</a>
                                <?php else: ?>
                                <!-- Fallback if the document type is unsupported -->
                                Unsupported document format.
                                <?php endif; ?>
                                <?php elseif($vacancy->content_type == 'Website' && $vacancy->website_link): ?>
                                <!-- Display website link -->
                                <a href="<?php echo e($vacancy->website_link); ?>" target="_blank">View Link</a>
                                <?php else: ?>
                                No document or link available.
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-job_title="<?php echo e($vacancy->job_title); ?>"
                                    data-content_type="<?php echo e($vacancy->content_type); ?>"
                                    data-publish_date="<?php echo e($vacancy->publish_date); ?>"
                                    data-expiry_date="<?php echo e($vacancy->expiry_date); ?>"
                                    data-job_description="<?php echo e($vacancy->job_description); ?>"
                                    data-image="<?php echo e(asset('/storage/' . $vacancy->document_upload)); ?>"
                                    data-website_link="<?php echo e($vacancy->website_link); ?>"
                                    data-language="<?php echo e($vacancy->language == 1 ? 'English' : 'Hindi'); ?>">
                                    View
                                </button>
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-start gap-2">
                                    <a href="<?php echo e(route('manage_vacancy.edit', $vacancy->id)); ?>"
                                        class="btn btn-success text-white btn-sm">
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('manage_vacancy.destroy', $vacancy->id)); ?>" method="POST"
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
                                        data-table="manage_vacancies" data-column="status" data-id="<?php echo e($vacancy->id); ?>"
                                        <?php echo e($vacancy->status ? 'checked' : ''); ?>>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Vacancies Details</h1>
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
            const job_title = this.dataset.job_title || 'N/A';
            const content_type = this.dataset.content_type || 'N/A';
            const publish_date = this.dataset.publish_date || 'N/A';
            const expiry_date = this.dataset.expiry_date || 'N/A';
            const image = this.dataset.image;
            const website_link = this.dataset.website_link;
            const job_description = this.dataset.job_description || 'N/A';
            const language = this.dataset.language || 'N/A';

            console.log('Image:', image);
            console.log('Website Link:', website_link);

            // Determine which to display: image or link
            let fileContent = '';
            if (image && image.trim() !== '' && image !== 'null') {
                fileContent =
                    `<p><strong>File:</strong><img src="${image}" alt="Vacancy Image" class="img-fluid mb-3" style="width:100px; height:100px;" /></p>`;
            } else if (website_link && website_link.trim() !== '' && website_link !== 'null') {
                fileContent =
                    `<p><strong>Website Link:</strong> <a href="${website_link}" target="_blank">View Link</a></p>`;
            } else {
                fileContent = `<p><strong>File:</strong> Not available</p>`;
            }

            // Update modal content
            modalTitle.textContent = 'Tenders / Circulars Details';
            modalBody.innerHTML = `
                <div>
                    <p><strong>Job Title:</strong> ${job_title}</p>
                    <p><strong>Content Type:</strong> ${content_type}</p>
                    <p><strong>Publish Date:</strong> ${publish_date}</p>
                    <p><strong>Expiry Date:</strong> ${expiry_date}</p>
                    <p><strong>Description:</strong> ${job_description}</p>
                    ${fileContent}
                    <p><strong>Language:</strong> ${language}</p>
                </div>`;
        });
    });
});
</script>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/manage_vacancy/index.blade.php ENDPATH**/ ?>