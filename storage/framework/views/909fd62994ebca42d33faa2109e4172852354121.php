<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<!-- Page Content -->
<section class="py-2">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="row align-items-center pb-lg-2 mb-4">
            <div class="col-12">
                <div class="bg-gray-200 rounded-4 py-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-2 mb-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('home')); ?>" style="color: #af2910;">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Archieve Tenders</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="contsearch">
            <form id="form2" method="GET" action="<?php echo e(route('user.tenders_archive')); ?>">
                <div class="row mb-4">
                    <div class="col-lg-4">
                        <label class="form-label" for="Keywords">Search :</label>
                            <input type="text" id="Keywords" name="keywords" value="<?php echo e(request('keywords')); ?>"
                                placeholder="Keywords Search" class="form-control text-dark ps-5 h-58">
                    </div>
                    <div class="col-lg-4">
                        <label for="year" class="form-label">Year</label>
                            <select name="year" id="year" class="form-select ps-5 text-dark h-58">
                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($year); ?>" <?php if($year==request('year')): ?> selected <?php endif; ?>><?php echo e($year); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                    </div>
                    <div class="col-lg-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-outline-primary fw-bold w-100">Submit</button>
                        <a href="<?php echo e(route('user.tenders_archive')); ?>"
                            class="btn btn-outline-warning fw-bold w-100">Reset</a>
                        
                    </div>
                </div>
                <fieldset>







                    
                </fieldset>
            </form>
        </div>
        <!-- Tenders Card -->
        <div class="card bg-white border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <h4 class="fw-semibold fs-18 mb-0">Tenders</h4>
                </div>

                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tender Title</th>
                                <th>Publish Date</th>
                                <th>Last Date</th>
                                <th>Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($query) > 0): ?>
                            <?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="text-center">
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($value->title); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($value->publish_date)->format('d F, Y, H:i A')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($value->expiry_date)->format('d F, Y, H:i A')); ?></td>
                                <td>
                                    <?php if(!empty($value->file)): ?>
                                    <a href="<?php echo e(asset('storage/tender/'.$value->file)); ?>"
                                        class="btn btn-sm btn-outline-primary" target="_blank">Download</a>
                                    <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">No records found</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>






<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/old_tenders.blade.php ENDPATH**/ ?>