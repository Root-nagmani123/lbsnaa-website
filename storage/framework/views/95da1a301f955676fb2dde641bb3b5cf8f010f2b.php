


<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h3 class="editprofile">Change Password</h3>
        <!-- Check for success message -->
        <?php if(session('success')): ?>
            <div id="success-alert" class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Check for error messages -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <form id="changepass" name="changepass" method="post" action="<?php echo e(route('update_password')); ?>" autocomplete="off">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="txtpwd">Enter Old Password:</label>
                <input type="password" name="old_password" class="form-control" id="txtpwd" required>
                <?php $__errorArgs = ['old_password'];
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
                <label for="txtnpwd">Enter New Password:</label>
                <input type="password" name="new_password" class="form-control" id="txtnpwd" required>
                <small>Password must be 8 characters, with at least 1 number, 1 lowercase, and 1 uppercase letter.</small>
                <?php $__errorArgs = ['new_password'];
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
                <label for="txtcpwd">Confirm Password:</label>
                <input type="password" name="confirm_password" class="form-control" id="txtcpwd" required>
                <?php $__errorArgs = ['confirm_password'];
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

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <!-- JavaScript to remove the success message after 10 seconds -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    // Fade out alert after 10 seconds
                    setTimeout(function () {
                        successAlert.style.transition = "opacity 1s ease";
                        successAlert.style.opacity = "0";
                    }, 4000); // 10 seconds
        
                    // Remove alert after fade-out
                    setTimeout(function () {
                        successAlert.remove();
                    }, 5000); // 11 seconds to complete fade-out
                }
            });
        </script>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp5\htdocs\lbsnaa_website\resources\views/admin/change_password/index.blade.php ENDPATH**/ ?>