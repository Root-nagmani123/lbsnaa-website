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
                            <a href="#" style="color: #af2910;">Staff</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 content-area">
            <h2 class="heading">Staff</h2>
            <p></p>

            <div class="contsearch">
                <form id="form2" action="<?php echo e(url()->current()); ?>" method="GET">
                    <fieldset>
                        <label class="txt">Search by Keywords:</label>
                        <label for="keywords">
                            <input type="text" id="Keywords" name="keywords" value="<?php echo e(request('keywords')); ?>"
                                placeholder="Search Staff" fdprocessedid="79mcc">
                        </label>

                        <label for="btn2">
                            <input id="btn2" type="submit" value="Submit" class="btn" fdprocessedid="6rx09">
                            <input type="hidden" name="action" value="submit">
                        </label>
                    </fieldset>
                </form>
            </div>

            <table width="100%" border="0" cellspacing="0" align="center" cellpadding="4" class="dataTable">
                <thead>
                    <tr class="even">
                        <th width="5%">Serial</th>
                        <th width="20%">Name</th>
                        <th width="20%">Designation</th>
                        <th width="20%">Email</th>
                        <th width="15%">Office</th>
                        <th width="15%">Residence</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($staff) > 0): ?>
                    <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="padding-left:10px;"><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($value->name); ?></td>
                        <td><?php echo e($value->designation); ?></td>
                        <td><?php echo e($value->email); ?></td>
                        <td><?php echo e($value->mobile); ?></td>
                        <td><?php echo e($value->phone_internal_residence); ?></td>
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





<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp5\htdocs\lbsnaa_website\resources\views/user/pages/staff.blade.php ENDPATH**/ ?>