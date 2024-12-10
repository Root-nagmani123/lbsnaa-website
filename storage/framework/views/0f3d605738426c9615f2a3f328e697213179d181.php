<div class="row">
    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Page Language:</label>
            <span class="star">*</span>

            <div class="form-group position-relative">
                <input type="radio" name="language" value="1"
                    <?php echo e(old('language', $manageTender->language ?? '') == 1 ? 'checked' : ''); ?>> English
                <input type="radio" name="language" value="2"
                    <?php echo e(old('language', $manageTender->language ?? '') == 2 ? 'checked' : ''); ?>> Hindi
            </div>

            <?php $__errorArgs = ['language'];
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
            <label class="label">Type:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <select name="type" class="form-control">
                    <option value="">Select</option>
                    <option value="Tender" <?php echo e(old('type', $manageTender->type ?? '') == 'Tender' ? 'selected' : ''); ?>>
                        Tender
                    </option>
                    <option value="Circular"
                        <?php echo e(old('type', $manageTender->type ?? '') == 'Circular' ? 'selected' : ''); ?>>
                        Circular
                    </option>
                </select>
            </div>
            <?php $__errorArgs = ['type'];
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

    <div class="col-lg-12">
        <div class="form-group mb-4">
            <label class="label">Title:</label>
            <div class="form-group positive-relative">
                <input type="text" name="title" class="form-control"
                    value="<?php echo e(old('title', $manageTender->title ?? '')); ?>">
            </div>
            <?php $__errorArgs = ['title'];
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

    <div class="col-lg-12">
        <div class="form-group mb-4">
            <label class="label">Description:</label>
            <div class="form-group position-relative">
                <textarea class="form-control" id="description" placeholder="Enter the Description" name="description"
                    rows="5"><?php echo e(old('description', $manageTender->description ?? '') ?? ''); ?></textarea>
            </div>
            <?php $__errorArgs = ['description'];
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

    <!-- <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Upload File (PDF, PNG, JPG):</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="file" name="file" class="form-control">
            </div>

            <?php if(isset($manageTender->file)): ?>
            <div class="mt-2">
                <?php if(in_array(pathinfo($manageTender->file, PATHINFO_EXTENSION), ['jpg', 'png', 'jpeg'])): ?>
                <label>Current File (Image):</label><br>
                <img src="<?php echo e(asset('storage/uploads/' . $manageTender->file)); ?>" alt="Uploaded Image"
                    style="width: 150px; height: auto;">
                <?php elseif(pathinfo($manageTender->file, PATHINFO_EXTENSION) == 'pdf'): ?>
                <label>Current File (PDF):</label><br>
                <a href="<?php echo e(asset('storage/uploads/' . $manageTender->file)); ?>" target="_blank">View PDF</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php $__errorArgs = ['file'];
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
    </div> -->

    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Upload File (PDF Only):</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="file" name="file" class="form-control" accept=".pdf">
            </div>

            <?php if(isset($manageTender->file)): ?>
            <div class="mt-2">
                <?php if(pathinfo($manageTender->file, PATHINFO_EXTENSION) == 'pdf'): ?>
                <label>Current File (PDF):</label><br>
                <a href="<?php echo e(asset('storage/uploads/' . $manageTender->file)); ?>" target="_blank">View PDF</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php $__errorArgs = ['file'];
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
            <label class="label">Publish Date:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="date" name="publish_date" class="form-control"
                    value="<?php echo e(old('publish_date', $manageTender->publish_date ?? '')); ?>">
            </div>
            <?php $__errorArgs = ['publish_date'];
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
            <label class="label">Expiry Date:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="date" name="expiry_date" class="form-control"
                    value="<?php echo e(old('expiry_date', $manageTender->expiry_date ?? '')); ?>">
            </div>
            <?php $__errorArgs = ['expiry_date'];
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
            <label class="label">Status:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <select name="status" class="form-control">
                    <option value="">Select</option>
                    <option value="1" <?php echo e(old('status', $manageTender->status ?? '') == '1' ? 'selected' : ''); ?>>Active
                    </option>
                    <option value="0" <?php echo e(old('status', $manageTender->status ?? '') == '0' ? 'selected' : ''); ?>>Inactive
                    </option>
                </select>
            </div>
            <?php $__errorArgs = ['status'];
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

</div><?php /**PATH C:\xampp11\htdocs\lbsnaa-website\resources\views/admin/manage_tender/form.blade.php ENDPATH**/ ?>