<?php $__env->startSection('content'); ?>

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Course</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Course Chart</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Course List</h4>
            <a href="<?php echo e(route('admin.courses.create')); ?>">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Course</span>
                    </span>
                </button>
            </a>
        </div>
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Course Name</th>
                            <th class="col">Abbreviation</th>
                            <th class="col">Language</th>
                            <th class="col">Coordinator</th>
                            <th class="col">Option</th>
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td> <!-- Auto-incrementing index -->
                            <td><?php echo e($course->course_name); ?></td>
                            <td><?php echo e($course->abbreviation); ?></td>
                            <td><?php echo e($course->language == 1 ? 'English' : 'Hindi'); ?></td>
                            <td><?php echo e($course->coordinator_id); ?></td>
                            <td>
                                <button type="button"
                                    class="btn btn-outline-primary text-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"

                                    data-course_name="<?php echo e($course->course_name); ?>"
                                    data-abbreviation="<?php echo e($course->abbreviation); ?>"
                                    data-coordinator_id="<?php echo e($course->coordinator_id); ?>"
                                    data-meta_keyword="<?php echo e($course->meta_keyword); ?>"
                                    data-meta_description="<?php echo e($course->meta_description); ?>"
                                    data-description="<?php echo e($course->description); ?>"
                                    data-course_start_date="<?php echo e($course->course_start_date); ?>"
                                    data-course_end_date="<?php echo e($course->course_end_date); ?>"
                                    data-support_section="<?php echo e($course->support_section); ?>"
                                    data-course_type="<?php echo e($course->course_type); ?>"
                                    data-language="<?php echo e($course->language == 1 ? 'English' : 'Hindi'); ?>">
                                    View
                                </button>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.courses.edit', $course->id)); ?>"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="<?php echo e(route('admin.courses.destroy', $course->id)); ?>" method="POST"
                                    style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-primary text-white"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="course" data-column="page_status" data-id="<?php echo e($course->id); ?>"
                                        <?php echo e($course->page_status ? 'checked' : ''); ?>>
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
            const course_name = this.dataset.course_name || 'N/A';
            const abbreviation = this.dataset.abbreviation || 'N/A';
            const coordinator_id = this.dataset.coordinator_id || 'N/A';
            const meta_keyword = this.dataset.meta_keyword || 'N/A';
            const meta_description = this.dataset.meta_description || 'N/A';
            const description = this.dataset.description || 'N/A';
            const course_start_date = this.dataset.course_start_date || 'N/A';
            const course_end_date = this.dataset.course_end_date;
            const support_section = this.dataset.support_section || '';
            const course_type = this.dataset.course_type || '';
            const language = this.dataset.language || 'N/A';

            
            // Update modal content
            modalTitle.textContent = 'News Details';
            modalBody.innerHTML = `
                <div>
                    <p><strong>Course Name:</strong> ${course_name}</p>
                    <p><strong>Abbreviation:</strong> ${abbreviation}</p>
                    <p><strong>Coordinator ID:</strong> ${coordinator_id}</p>
                    <p><strong>Meta Keyword:</strong> ${meta_keyword}</p>
                    <p><strong>Meta Description:</strong> ${meta_description}</p>
                    <p><strong>Description:</strong> ${description}</p>
                    <p><strong>Course Start Date:</strong> ${course_start_date}</p>
                    <p><strong>Course End Date:</strong> ${course_end_date}</p>
                    <p><strong>Support Section:</strong> ${support_section}</p>
                    <p><strong>Course Type:</strong> ${course_type}</p>
                    <p><strong>Language:</strong> ${language}</p>
                </div>`;
        });
    });
});
</script>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/hardeep/public_html/lbsnaa-website/resources/views/admin/courses/index.blade.php ENDPATH**/ ?>