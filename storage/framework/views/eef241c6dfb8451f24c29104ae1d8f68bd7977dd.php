<div class="form-group">
    <label>Page Language:</label>
    <div>
        <label><input type="radio" name="language" value="English" <?php echo e(old('language', $manageTender->language ?? '') == 'English' ? 'checked' : ''); ?>> English</label>
        <label><input type="radio" name="language" value="Hindi" <?php echo e(old('language', $manageTender->language ?? '') == 'Hindi' ? 'checked' : ''); ?>> Hindi</label>
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

<div class="form-group"> 
    <label>Type:</label>
    <select name="type" class="form-control">
        <option value="">Select</option>
        <option value="Tender" <?php echo e(old('type', $manageTender->type ?? '') == 'Tender' ? 'selected' : ''); ?>>Tender</option>
        <option value="Circular" <?php echo e(old('type', $manageTender->type ?? '') == 'Circular' ? 'selected' : ''); ?>>Circular</option>
    </select>
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

<div class="form-group">
    <label>Title:</label>
    <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $manageTender->title ?? '')); ?>">
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

<div class="form-group">
    <label>Description:</label>
    <textarea name="description" class="form-control ckeditor"><?php echo e(old('description', $manageTender->description ?? '')); ?></textarea>
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

<div class="form-group">
    <label>Upload File (PDF, PNG, JPG):</label>
    <input type="file" name="file" class="form-control">
    
    <?php if(isset($manageTender->file)): ?>
        <div class="mt-2">
            <?php if(in_array(pathinfo($manageTender->file, PATHINFO_EXTENSION), ['jpg', 'png', 'jpeg'])): ?>
                <label>Current File (Image):</label><br>
                <img src="<?php echo e(asset('storage/uploads/' . $manageTender->file)); ?>" alt="Uploaded Image" style="width: 150px; height: auto;">
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

<div class="form-group">
    <label>Publish Date:</label>
    <input type="date" name="publish_date" class="form-control" value="<?php echo e(old('publish_date', $manageTender->publish_date ?? '')); ?>">
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

<div class="form-group">
    <label>Expiry Date:</label>
    <input type="date" name="expiry_date" class="form-control" value="<?php echo e(old('expiry_date', $manageTender->expiry_date ?? '')); ?>">
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

<div class="form-group">
    <label>Status:</label>
    <select name="status" class="form-control">
        <option value="">Select</option>
        <option value="Draft" <?php echo e(old('status', $manageTender->status ?? '') == 'Draft' ? 'selected' : ''); ?>>Draft</option>
        <option value="Approval" <?php echo e(old('status', $manageTender->status ?? '') == 'Approval' ? 'selected' : ''); ?>>Approval</option>
        <option value="Publish" <?php echo e(old('status', $manageTender->status ?? '') == 'Publish' ? 'selected' : ''); ?>>Publish</option>
    </select>
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
<?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/manage_tender/form.blade.php ENDPATH**/ ?>