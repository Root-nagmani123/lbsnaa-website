

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage News</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">News</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Edit News</h4>
            </div>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

                <form action="<?php echo e(route('admin.news.update', $news->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1" <?php echo e($news->language == '1' ? 'checked' : ''); ?>> English
                                    <input type="radio" name="language" value="2" <?php echo e($news->language == '2' ? 'checked' : ''); ?>> Hindi
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="title">Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="title" id="title" value="<?php echo e(old('title', $news->title)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="short_description" class="label">Short Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                       <textarea name="short_description" id="short_description" class="form-control ps-5 text-dark"><?php echo e(old('short_description', $news->short_description)); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_title">Meta Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="meta_title" id="meta_title" value="<?php echo e(old('meta_title', $news->meta_title)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_keywords">Meta Keywords :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="meta_keywords" id="meta_keywords" value="<?php echo e(old('meta_keywords', $news->meta_keywords)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="meta_description" class="label">Meta Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                       <textarea name="meta_description" id="meta_description" class="form-control ps-5 text-dark"><?php echo e(old('meta_description', $news->meta_description)); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description" class="label">Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                       <textarea name="description" id="description" class="form-control ps-5 text-dark"><?php echo e(old('description', $news->description)); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="main_image" class="label">Main Image</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                       <input type="file" name="main_image" id="main_image" class="form-control text-dark ps-5 h-58">
                                       <small>Current: <img src="<?php echo e(asset( $news->main_image)); ?>" alt="Current Image" style="max-width: 150px;"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="multiple_images" class="label">Upload Multiple Image</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                <input type="file" name="multiple_images[]" id="multiple_images" class="form-control text-dark ps-5 h-58" multiple>
                                <small>Current Images: 
                                        <?php $__currentLoopData = json_decode($news->multiple_images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <img src="<?php echo e(asset($image)); ?>" alt="Current Image" style="max-width: 150px; margin: 5px;">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="start_date" class="label">Start Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                       <input type="date" name="start_date" id="start_date" class="form-control text-dark ps-5 h-58" value="<?php echo e(old('start_date', $news->start_date)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="end_date" class="label">End Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                       <input type="date" name="end_date" id="end_date" class="form-control text-dark ps-5 h-58" value="<?php echo e(old('end_date', $news->end_date)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status" required>
                                        <option value="1" class="text-dark" <?php echo e($news->status == 1 ? 'selected' : ''); ?>>Active</option>
                                        <option value="0" class="text-dark" <?php echo e($news->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update News</button> &nbsp;
                            <a href="<?php echo e(route('admin.news.index')); ?>" class="btn btn-secondary text-white fw-semibold">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<script>
        $('#description').summernote({
            placeholder: 'description...',
            tabsize:2,
            height:300
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/news/edit.blade.php ENDPATH**/ ?>