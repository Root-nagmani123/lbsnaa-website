<?php
    $submenus = DB::table('menus')->where('menu_status',1)->where('txtpostion',1)->where('parent_id', $menu->id)->get();
?>

<li class="dropdown-submenu dropend">
    <a class="dropdown-item dropdown-list-group-item <?php echo e(count($submenus) > 0 ? 'dropdown-toggle' : ''); ?>"
        href="<?php echo e($submenu->parent_id == 27 ? '#' : route('user.navigationpagesbyslug', $submenu->menu_slug)); ?>"><?php echo e($submenu->menutitle); ?></a>

    <?php if(count($submenus) > 0): ?>
        <ul class="dropdown-menu">
            <?php $__currentLoopData = $submenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('user.components.menu-item', ['menu' => $submenu], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>

    <?php endif; ?>
</li><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/components/menu-item.blade.php ENDPATH**/ ?>