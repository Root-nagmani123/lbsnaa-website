<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($menu->id); ?>" <?php echo e(isset($selected) && $selected == $menu->id ? 'selected' : ''); ?>><?php echo e($menu->name); ?></option>
    
    <?php if($menu->children->count()): ?>
        <?php echo $__env->make('admin.menus.partials.menu_options', ['menus' => $menu->children, 'selected' => $selected], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Recursive call for children -->
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/menus/partials/menu_options.blade.php ENDPATH**/ ?>