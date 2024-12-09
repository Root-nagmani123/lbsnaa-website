

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Quick Links</h2>
    <a href="<?php echo e(route('admin.quick_links.create')); ?>" class="btn btn-primary">Add New Quick Link</a>

    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Quick Link Text</th>
                    <th>Type</th>
                    <th>URL / Document</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $quickLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quickLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($quickLink->text); ?></td>
                    <td><?php echo e($quickLink->url ? 'URL' : 'Document'); ?></td>
                    <td>
                        <?php if($quickLink->url): ?>
                            <a href="<?php echo e($quickLink->url); ?>" target="_blank"><?php echo e($quickLink->url); ?></a>
                        <?php elseif($quickLink->file): ?>
                            <a href="<?php echo e(asset('quick-links-files/' . $quickLink->file)); ?>" target="_blank">View Document</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" class="status-toggle" data-id="<?php echo e($quickLink->id); ?>" <?php echo e($quickLink->status ? 'checked' : ''); ?>>
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.quick_links.edit', $quickLink->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form action="<?php echo e(route('admin.quick_links.destroy', $quickLink->id)); ?>" method="POST" style="display: inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this link?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
</div>
<?php $__env->stopSection(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
$(document).ready(function () {
        $('.status-toggle').change(function () {
            var sliderId = $(this).data('id');
            var url = '/admin/footer-images/' + sliderId + '/status';

            $.ajax({
                url: url,
                type: 'put',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    status : 1,
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/home/quick_link_list.blade.php ENDPATH**/ ?>