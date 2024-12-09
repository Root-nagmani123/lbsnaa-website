<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($news)): ?>

  <!-- Page Content -->
  <section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
                <!-- image -->
                <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                    <nav aria-label="breadcrumb ">
                        <ol class="breadcrumb p-2">
                          <li class="breadcrumb-item">
                          <a href="<?php echo e(route('home')); ?>" style="color: #af2910;">Home</a>
                          </li>
                          <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Academy News</a>
                          </li>
                          <li class="breadcrumb-item active" aria-current="page"><?php echo e($news->title); ?></li>
                        </ol>
                      </nav>
                </div>
        </div>
    </div>
</section>

<section class="py-1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="mb-6 mb-lg-8">
                    <h2 class="h1 fw-bold text-primary">
                    <?php echo e($news->title); ?>

                    </h2>
                    <p class="mb-0 lead">Posted On: <?php echo e(date('d M, Y',strtotime($news->start_date))); ?></p>
                </div>
            </div>
        </div>
      
        <p><?= $news->description;?></p>
    </div>
</section>


<?php else: ?>
    <h4>News does not exist</h4>
<?php endif; ?>


<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp5\htdocs\lbsnaa_website\resources\views/user/pages/newsbyslug.blade.php ENDPATH**/ ?>