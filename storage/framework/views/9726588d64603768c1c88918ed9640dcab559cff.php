
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Centetr</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Category</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
    <h4 class="fw-semibold fs-18 mb-sm-0">Manage Media Categories</h4>
</div>
                <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>
                <form action="<?php echo e(isset($category) ? route('media-categories.update', $category->id) : route('media-categories.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php if(isset($category)): ?>
                        <?php echo method_field('PUT'); ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="media_gallery">Media Gallery :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="media_gallery" id="media_gallery" required>
                                        <option value="" class="text-dark">Select</option>
                                        <option value="Photo Gallery" class="text-dark" <?php echo e(isset($category) && $category->media_gallery == 'Photo Gallery' ? 'selected' : ''); ?>>Photo Gallery</option>
                                        <option value="Video Gallery" class="text-dark" <?php echo e(isset($category) && $category->media_gallery == 'Video Gallery' ? 'selected' : ''); ?>>Video Gallery</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="name">Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="name"
                                        id="name" value="<?php echo e(old('name', $category->name ?? '')); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="hindi_name">Hindi Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="hindi_name"
                                        id="hindi_name" value="<?php echo e(old('hindi_name', $category->hindi_name ?? '')); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status" required>
                                        <option value="0" class="text-dark">Select</option>
                                        <option value="1" class="text-dark" <?php echo e(isset($category) && $category->status == '1' ? 'selected' : ''); ?>>Active</option>
                                        <option value="2" class="text-dark" <?php echo e(isset($category) && $category->status == '0' ? 'selected' : ''); ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit"><?php echo e(isset($category) ? 'Update' : 'Submit'); ?></button> &nbsp;
                            <a href="<?php echo e(route('media-categories.index')); ?>" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
    <h4 class="fw-semibold fs-18 mb-sm-0">Media List</h4>
</div>
              <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Media Gallery</th>
                            <th class="col">Name</th>
                            <th class="col">Hindi Name</th>
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->media_gallery); ?></td>
                        <td><?php echo e($item->name); ?></td>
                        <td><?php echo e($item->hindi_name); ?></td>
                            <td>
                                <a href="<?php echo e(route('media-categories.edit', $item->id)); ?>"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="<?php echo e(route('media-categories.destroy', $item->id)); ?>" method="POST"
                                    style="display:inline;">
                                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-primary text-white" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                            <td><div class="form-check form-switch">
            <input class="form-check-input status-toggle" type="checkbox" role="switch"  data-table="manage_media_categories" 
            data-column="status" data-id="<?php echo e($item->id); ?>" <?php echo e($item->status ? 'checked' : ''); ?>>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp5\htdocs\lbsnaa_website\resources\views/admin/manage_categories/index.blade.php ENDPATH**/ ?>