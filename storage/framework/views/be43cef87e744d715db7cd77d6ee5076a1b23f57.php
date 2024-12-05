
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
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <div class="default-table-area members-list">
    <div class="table-responsive">
        <table class="table align-middle" id="myTable">
            <thead>
                <tr class="text-center">
                    <th class="col">ID</th> <!-- Add index column -->
                    <th class="col">Job Title</th>
                    <th class="col">Publish Date</th>
                    <th class="col">Expiry Date</th>
                    <th class="col">Language</th>
                    <th class="col">Uploaded Document / Website Link</th> <!-- Column for document or link -->
                    <th class="col">Actions</th>
                    <th class="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $vacancies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vacancy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <!-- Use $index for the incrementing index -->
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                    
                            <td><?php echo e($vacancy->job_title); ?></td>
                            <td><?php echo e($vacancy->publish_date); ?></td>
                            <td><?php echo e($vacancy->expiry_date); ?></td>
                            <td><?php echo e($vacancy->language == 1 ? 'English' : 'Hindi'); ?></td>
                             <td>   <?php if($vacancy->content_type == 'PDF' && $vacancy->document_upload): ?>
                                    <!-- Check if document is an image -->
                                    <?php if(in_array(pathinfo($vacancy->document_upload, PATHINFO_EXTENSION), ['jpg', 'png', 'jpeg'])): ?>
                                        <img src="<?php echo e(asset('uploads/' . $vacancy->document_upload)); ?>" alt="Document Image" style="width: 100px; height: auto;">
                                    <?php elseif(pathinfo($vacancy->document_upload, PATHINFO_EXTENSION) == 'pdf'): ?>
                                        <!-- Provide a link to download or view the PDF -->
                                        <a href="<?php echo e(asset('uploads/' . $vacancy->document_upload)); ?>" target="_blank">View PDF</a>
                                    <?php else: ?>
                                        No document uploaded.
                                    <?php endif; ?>
                                <?php elseif($vacancy->content_type == 'Website' && $vacancy->website_link): ?>
                                    <!-- Display website link if content type is Website -->
                                    <a href="<?php echo e($vacancy->website_link); ?>" target="_blank">View Link</a>
                                <?php else: ?>
                                    No document or link available.
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('manage_vacancy.edit', $vacancy->id)); ?>" class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="<?php echo e(route('manage_vacancy.destroy', $vacancy->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-primary text-white">Delete</button>
                                </form>
                            </td>
                            <td><div class="form-check form-switch">
            <input class="form-check-input status-toggle" type="checkbox" role="switch"  data-table="manage_vacancies" 
            data-column="status" data-id="<?php echo e($vacancy->id); ?>" <?php echo e($vacancy->status ? 'checked' : ''); ?>>
          </div></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/manage_vacancy/index.blade.php ENDPATH**/ ?>