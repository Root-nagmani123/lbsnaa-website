<?php echo $__env->make('user.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($nav_page)): ?>

<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Home link -->
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>">Home</a>
                        </li>

                        <!-- Dynamic breadcrumbs -->
                        <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!$loop->last): ?>
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('user.get_rti_page_details', $crumb['slug'])); ?>"><?php echo e($crumb['title']); ?></a>
                        </li>
                        <?php else: ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($crumb['title']); ?></li>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </nav>


            </div>
        </div>
    </div>
</section>

<section class="py-2 bg-light">
    <div class="container">
        <div class="row gy-4 gy-xl-0">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="accordion" id="accordionExample">
                        <!-- Loop through parent menus -->
                        <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-<?php echo e($menu->id); ?>">
                                <button
                                    class="accordion-button <?php echo e($loop->first ? '' : 'collapsed'); ?> <?php echo e($menu->children->isNotEmpty() ? '' : 'no-arrow'); ?>"
                                    type="button" data-bs-toggle="<?php echo e($menu->children->isNotEmpty() ? 'collapse' : ''); ?>"
                                    data-bs-target="<?php echo e($menu->children->isNotEmpty() ? '#collapse-' . $menu->id : ''); ?>"
                                    aria-expanded="<?php echo e($loop->first && $menu->children->isNotEmpty() ? 'true' : 'false'); ?>"
                                    aria-controls="<?php echo e($menu->children->isNotEmpty() ? 'collapse-' . $menu->id : ''); ?>">

                                    <!-- Add the anchor tag around the menu title -->
                                    <a href="<?php echo e(url('rti/' . $menu->menu_slug ?? '#')); ?>" class="text-decoration-none">
                                        <?php echo e($menu->menutitle); ?>

                                    </a>
                                </button>
                            </h2>
                            <?php if($menu->children->isNotEmpty()): ?>
                            <div id="collapse-<?php echo e($menu->id); ?>"
                                class="accordion-collapse collapse <?php echo e($loop->first ? 'show' : ''); ?>"
                                aria-labelledby="heading-<?php echo e($menu->id); ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="accordion" id="nestedAccordion-<?php echo e($menu->id); ?>">
                                        <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading-<?php echo e($child->id); ?>">
                                                <button
                                                    class="accordion-button collapsed <?php echo e($child->children->isNotEmpty() ? '' : 'no-arrow'); ?>"
                                                    type="button"
                                                    data-bs-toggle="<?php echo e($child->children->isNotEmpty() ? 'collapse' : ''); ?>"
                                                    data-bs-target="<?php echo e($child->children->isNotEmpty() ? '#collapse-' . $child->id : ''); ?>"
                                                    aria-expanded="false"
                                                    aria-controls="<?php echo e($child->children->isNotEmpty() ? 'collapse-' . $child->id : ''); ?>">

                                                    <!-- Add anchor tag for child menu -->
                                                    <a href="<?php echo e(url('rti/' . $child->menu_slug ?? '#')); ?>"
                                                        class="text-decoration-none">
                                                        <?php echo e($child->menutitle); ?>

                                                    </a>
                                                </button>
                                            </h2>
                                            <?php if($child->children->isNotEmpty()): ?>
                                            <div id="collapse-<?php echo e($child->id); ?>" class="accordion-collapse collapse"
                                                aria-labelledby="heading-<?php echo e($child->id); ?>"
                                                data-bs-parent="#nestedAccordion-<?php echo e($menu->id); ?>">
                                                <div class="accordion-body">
                                                    <div class="accordion" id="nestedAccordion-<?php echo e($child->id); ?>">
                                                        <?php $__currentLoopData = $child->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grandChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="heading-<?php echo e($grandChild->id); ?>">
                                                                <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapse-<?php echo e($grandChild->id); ?>"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapse-<?php echo e($grandChild->id); ?>">

                                                                    <!-- Add anchor tag for grandchild menu -->
                                                                    <a href="<?php echo e(url('rti/' . $grandChild->menu_slug ?? '#')); ?>"
                                                                        class="text-decoration-none">
                                                                        <?php echo e($grandChild->menutitle); ?>

                                                                    </a>
                                                                </button>
                                                            </h2>
                                                            <div id="collapse-<?php echo e($grandChild->id); ?>"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="heading-<?php echo e($grandChild->id); ?>"
                                                                data-bs-parent="#nestedAccordion-<?php echo e($child->id); ?>">
                                                                <div class="accordion-body">
                                                                    <!-- You can add content for grandchild if needed -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
            </div>
            <div class="col-xl-9 col-lg-6 col-12">
                <div class="mb-6 mb-lg-8">
                    <h2 class="h1 fw-bold text-primary">
                        <?php echo e($nav_page->menutitle); ?>

                    </h2>
                </div>
                <p><?php echo $nav_page->content; ?></p>
            </div>
        </div>
    </div>
</section>



<?php else: ?>
<h4>News does not exist</h4>
<?php endif; ?>


<style>
    .accordion-button.no-arrow::after {
        display: none;
    }
</style>
<?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/rti_page.blade.php ENDPATH**/ ?>