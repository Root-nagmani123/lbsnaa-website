
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <h2>All Vacancies</h2>
    <a href="<?php echo e(route('manage_vacancy.create')); ?>" class="btn btn-primary">Add Vacancy</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th> <!-- Add index column -->
                <th>Job Title</th>
                <th>Language</th>
                <th>Publish Date</th>
                <th>Expiry Date</th>
                <th>Status</th>
                <th>Uploaded Document / Website Link</th> <!-- Column for document or link -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $vacancies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vacancy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <!-- Display index -->
                    <td><?php echo e($loop->iteration); ?></td>
                    
                    <td><?php echo e($vacancy->job_title); ?></td>
                    <td><?php echo e($vacancy->language); ?></td>
                    <td><?php echo e($vacancy->publish_date); ?></td>
                    <td><?php echo e($vacancy->expiry_date); ?></td>
                    <td><?php echo e($vacancy->status); ?></td>
                    <td>
                        <?php if($vacancy->content_type == 'PDF' && $vacancy->document_upload): ?>
                            <!-- Check if document is an image -->
                            <?php if(in_array(pathinfo($vacancy->document_upload, PATHINFO_EXTENSION), ['jpg', 'png', 'jpeg'])): ?>
                                <img src="<?php echo e(asset('storage/' . $vacancy->document_upload)); ?>" alt="Document Image" style="width: 100px; height: auto;">
                            <?php elseif(pathinfo($vacancy->document_upload, PATHINFO_EXTENSION) == 'pdf'): ?>
                                <!-- Provide a link to download or view the PDF -->
                                <a href="<?php echo e(asset('storage/' . $vacancy->document_upload)); ?>" target="_blank">View PDF</a>
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
                        <a href="<?php echo e(route('manage_vacancy.edit', $vacancy->id)); ?>" class="btn btn-warning">Edit</a>
                        <form action="<?php echo e(route('manage_vacancy.destroy', $vacancy->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/manage_vacancy/index.blade.php ENDPATH**/ ?>