<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>News</h1>
    <ul>
        <?php $__currentLoopData = $newsItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <p><img src="<?php echo e(asset($news->main_image)); ?>" style="width: 300px; height: 300px; object-fit: cover;"></p>
                <h3><?php echo e($news->title); ?></h3>
                <p><em>Posted On:</em> <?php echo e($news->created_at); ?></p>
                <p><?php echo e($news->meta_title); ?></p>                
                <a href="<?php echo e(route('news.details', $news->id)); ?>" class="btn btn-primary">Read More</a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</body>
</html>
<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp11\htdocs\lbsnaa-website\resources\views/user/pages/microsites/news.blade.php ENDPATH**/ ?>