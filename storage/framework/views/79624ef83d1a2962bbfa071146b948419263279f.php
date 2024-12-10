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
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="#" style="color: #af2910;">Faculty</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-header">
            <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
                    <h3 class="fw-semibold fs-18 mb-0">Inhouse Faculty</h3>
                    <div class="contsearch">
                        <form id="form2" action="<?php echo e(url()->current()); ?>" method="GET">
                            <fieldset>
                                <label for="keywords">
                                    <input type="text" id="Keywords" name="keywords" value="<?php echo e(request('keywords')); ?>"
                                        placeholder="Search Faculty" fdprocessedid="79mcc"
                                        class="form-control form-control-sm">
                                </label>

                                <label for="btn2">
                                    <input id="btn2" type="submit" value="Submit" class="btn btn-outline-primary btn-sm"
                                        fdprocessedid="6rx09">
                                    <input type="hidden" name="action" value="submit" class="form-control fw-bold">
                                </label>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="default-table-area members-list">
                    <div class="table-responsive">
                        <table class="table align-middle" id="myTable">
                            <thead>
                                <tr class="even">
                                    <th class="col">#</th>
                                    <th class="col">Name</th>
                                    <th class="col">Designation</th>
                                    <th class="col">Email</th>
                                    <th class="col">Office</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($faculty) > 0): ?>
                                <?php $__currentLoopData = $faculty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($value->name); ?></td>
                                    <td><?php echo e($value->designation); ?></td>
                                    <td><?php echo e($value->email); ?></td>
                                    <td><?php echo e($value->mobile); ?></td>
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
            </div>
        </div>

    </div>
</section>





<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/faculty.blade.php ENDPATH**/ ?>