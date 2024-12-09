<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e('--' . $menu->name); ?></td>
        <td><?php echo e($menu->order); ?></td>
        <td>
            <a href="<?php echo e(route('admin.menus.edit', $menu->id)); ?>" class="btn btn-warning">Edit</a>
            <form action="<?php echo e(route('admin.menus.destroy', $menu->id)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    <?php if($menu->children->count()): ?>
        <?php echo $__env->make('admin.menus.partials.menu_row', ['menus' => $menu->children], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/menus/partials/menu_row.blade.php ENDPATH**/ ?>