

<?php $__env->startSection('title', 'Academy Souvenir'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Souvenir</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Souvenir</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Academy Souvenirs</h4>
            <a href="<?php echo e(route('academy_souvenirs.create')); ?>">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Academy</span>
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
                            <th class="col">Product Title</th>
                            <th class="col">Product Category</th>
                            <th class="col">Product Type</th>
                            <th class="col">Language</th>
                            <th class="col">Option</th>
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $souvenirs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $souvenir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td> <!-- Auto-incrementing index -->
                            <td><?php echo e($souvenir->product_title); ?></td>
                            <td><?php echo e($souvenir->product_category); ?></td>
                            <td><?php echo e($souvenir->product_type); ?></td>
                            <td><?php echo e($souvenir->language == 1 ? 'English' : 'Hindi'); ?></td>
                            <td>
                                <button type="button" class="btn btn-outline-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-product_category="<?php echo e($souvenir->product_category); ?>"
                                    data-product_title="<?php echo e($souvenir->product_title); ?>"
                                    data-product_type="<?php echo e($souvenir->product_type); ?>"
                                    data-product_price="<?php echo e($souvenir->product_price); ?>"
                                    data-product_discounted_price="<?php echo e($souvenir->product_discounted_price); ?>"
                                    data-contact_email_id="<?php echo e($souvenir->contact_email_id); ?>"
                                    data-document_upload="<?php echo e(asset('AcademySouvenir/documents/' . $souvenir->document_upload)); ?>"
                                    data-upload_image="<?php echo e(asset('AcademySouvenir/images/' . $souvenir->upload_image)); ?>"
                                    data-product_description="<?php echo e($souvenir->product_description); ?>"
                                    data-product_status="<?php echo e($souvenir->product_status); ?>"
                                    data-language="<?php echo e($souvenir->language == 1 ? 'English' : 'Hindi'); ?>">
                                    View
                                </button>
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-start gap-2">
                                    <a href="<?php echo e(route('academy_souvenirs.edit', $souvenir->id)); ?>"
                                        class="btn btn-success text-white btn-sm">
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('academy_souvenirs.destroy', $souvenir->id)); ?>" method="POST"
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
                                        data-table="academy_souvenirs" data-column="product_status"
                                        data-id="<?php echo e($souvenir->id); ?>" <?php echo e($souvenir->product_status ? 'checked' : ''); ?>>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Souvenirs Details</h1>
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
            const product_category = this.dataset.product_category || 'N/A';
            const product_title = this.dataset.product_title || 'N/A';
            const product_type = this.dataset.product_type || 'N/A';
            const product_price = this.dataset.product_price || 'N/A';
            const product_discounted_price = this.dataset.product_discounted_price || 'N/A';
            const contact_email_id = this.dataset.contact_email_id || 'N/A';
            const document_upload = this.dataset.document_upload || '';
            const upload_image = this.dataset.upload_image || '';
            const product_description = this.dataset.product_description || 'N/A';
            const product_status = this.dataset.product_status || 'N/A';
            const language = this.dataset.language || 'N/A';

            // Update modal content
            modalTitle.textContent = 'Souvenirs Details';
            modalBody.innerHTML = `
                <div>
                    <p><strong>Product Category:</strong> ${product_category}</p>
                    <p><strong>Product Title:</strong> ${product_title}</p>
                    <p><strong>Product Type:</strong> ${product_type}</p>
                    <p><strong>Product Price:</strong> ${product_price}</p>
                    <p><strong>Product Discounted Price:</strong> ${product_discounted_price}</p>
                    <p><strong>Email:</strong> ${contact_email_id}</p>
                    <p><strong>Product Description:</strong> ${product_description}</p>
                    <p><strong>Product Status:</strong> ${product_status}</p>
                    <p><strong>Language:</strong> ${language}</p>
                    <p><strong>Document Upload:</strong></p>
                    <a href="<?php echo e(asset('AcademySouvenir/documents/' . $souvenir->document_upload)); ?>" target="_blank">
                        View Document
                    </a>
                    
                    <p><strong>Upload Image:</strong></p>
                    ${upload_image ? `<img src="${upload_image}" alt="Uploaded Image" style="max-width: 100%; height: auto;">` : '<p>No image uploaded</p>'}
                </div>`;
        });
    });
});
</script>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/souvenirModule/academy_souvenirs/index.blade.php ENDPATH**/ ?>