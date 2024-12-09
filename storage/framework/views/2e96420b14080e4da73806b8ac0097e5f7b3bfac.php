<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



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
                            <a href="#" style="color: #af2910;">Tenders</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 content-area">
            <h2 class="heading">Tenders</h2>
            <p></p>



            <table width="100%" border="0" cellspacing="0" align="center" cellpadding="4" class="dataTable">
                <thead>
                    <tr class="even">
                        <th width="5%">S. No.</th>
                        <th width="20%">Tender Title</th>
                        <th width="20%">Publish Date</th>
                        <th width="20%">Last Date</th>
                        <th width="15%">Document</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($query) > 0): ?>
                    <?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="padding-left:10px;"><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($value->title); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($value->publish_date)->format('d F, Y, H:i A')); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($value->expiry_date)->format('d F, Y, H:i A')); ?></td>
                        <td>
                            <?php if(!empty($value->file)): ?>
                            <a href="<?php echo e(asset('tender/'.$value->file)); ?>" target="_blank">Download</a>


                            <?php else: ?>
                            N/A
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No records found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>


    </div>
</section>





<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp5\htdocs\lbsnaa_website\resources\views/user/pages/tenders.blade.php ENDPATH**/ ?>