

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Manage News</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="<?php echo e(route('Managenews.index')); ?>" class="text-decoration-none">
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
                        <h4 class="fw-semibold fs-18 mb-0">Add News</h4>
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

                    <form action="<?php echo e(route('Managenews.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="language">Page Language :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="radio" name="language" value="1"> English
                                        <input type="radio" name="language" value="2"> Hindi
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="select_research_centre">Select Research Centre:</label>
                                    <span class="star">*</span>
                                    <select name="research_centre" class="form-control">
                                        <option value="" disabled selected>Select Research Centre</option>
                                        <?php $__currentLoopData = $researchCentres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['select_research_centre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>



                            <div class="col-lg-6">


                                <div class="form-group mb-4">
                                    <label class="label" for="title">Title :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="title"
                                            id="title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="short_description" class="label">Short Description</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <textarea name="short_description" id="short_description" class="form-control ps-5 text-dark"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="meta_title">Meta Title :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="meta_title"
                                            id="meta_title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="meta_keywords">Meta Keywords :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="meta_keywords"
                                            id="meta_keywords">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label for="meta_description" class="label">Meta Description</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <textarea name="meta_description" id="meta_description" class="form-control ps-5 text-dark"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label for="description" class="label">Description</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <textarea name="description" id="description" class="form-control ps-5 text-dark"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="main_image" class="label">Main Image</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="file" name="main_image" id="main_image"
                                            class="form-control text-dark ps-5 h-58">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="multiple_images" class="label">Upload Multiple Image</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="file" name="multiple_images" id="multiple_images"
                                            class="form-control text-dark ps-5 h-58">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="start_date" class="label">Start Date</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="date" name="start_date" id="start_date"
                                            class="form-control text-dark ps-5 h-58">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="end_date" class="label">End Date</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="date" name="end_date" id="end_date"
                                            class="form-control text-dark ps-5 h-58">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="status">Status :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" name="status" id="status"
                                            required>
                                            <option value="" class="text-dark" selected>Select</option>
                                            <option value="1" class="text-dark">Active</option>
                                            <option value="0" class="text-dark">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex ms-sm-3 ms-md-0">
                                <button class="btn btn-success text-white fw-semibold" type="submit">Add News</button>

                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('admin_assets/js/ckeditor.js')); ?>"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
    .create( document.querySelector( '#meta_description' ) )
    .catch( error => {
    console.error( error );
    });
    ClassicEditor
    .create( document.querySelector( '#description' ) )
    .catch( error => {
    console.error( error );
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/micro/managenews/create.blade.php ENDPATH**/ ?>