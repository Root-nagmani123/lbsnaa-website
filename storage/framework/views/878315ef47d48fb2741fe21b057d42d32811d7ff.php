<!DOCTYPE html>
<html lang="zxx">
<head>
    <?php echo $__env->make('admin.layouts.pre_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <title><?php echo $__env->yieldContent('title'); ?></title>
</head>
<body>
    <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid">
        <div class="main-content d-flex flex-column">
        <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>