

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h2>Sliders List</h2>
        <a href="<?php echo e(route('admin.slider_create')); ?>" class="btn btn-primary mb-3">Add New Slider</a>
        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Text</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><img src="<?php echo e(asset('slider-images/' . $slider->image)); ?>" alt="slider image" width="100"></td>
                    <td><?php echo e($slider->text); ?></td>
                    <td><?php echo e($slider->description); ?></td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" class="status-toggle" data-id="<?php echo e($slider->id); ?>" <?php echo e($slider->status ? 'checked' : ''); ?>>
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.slider_edit', $slider->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('admin.slider_destroy', $slider->id)); ?>" method="POST" style="display:inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.status-toggle').change(function () {
            var sliderId = $(this).data('id');
            var url = '/admin/sliders/' + sliderId + '/toggle-status';

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function (response) {
                    alert(response.success);
                },
                error: function (xhr) {
                    alert('Error occurred while toggling status.');
                }
            });
        });
    });
</script>
<style>
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

/* Rounded slider */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/home/slider_list.blade.php ENDPATH**/ ?>