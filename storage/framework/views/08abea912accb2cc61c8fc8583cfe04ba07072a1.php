<?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Page Content -->


<!-- Page Content -->
<!-- slider start -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

    <div class="carousel-indicators">

        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($i == 0): ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to=<?php echo e($i); ?>

                    class="active" aria-current="true" aria-label=<?php echo e($slider->slider_text); ?>></button>
            <?php endif; ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo e($i); ?>"
                aria-label=<?php echo e($slider->slider_text); ?>></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Dynamic Slider -->
    <div class="carousel-inner">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                <img src="<?php echo e(asset('storage/' . $slider->slider_image)); ?>" class="d-block img-fluid"
                    alt="<?php echo e($slider->slider_text); ?>"
                    style="
  width: 100%;
  height: 600px; background-size: cover; background-position: center; border-radius: 10px;background-repeat: no-repeat;">
                
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<section class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div>
                    <h4 class="fw-bold text-primary">
                        The Ministry of Rural Development and Planning Commission assigned following objectives to B. N.
                        Yugandhar Centre for Rural Studies:
                    </h4>
                    <p class="mb-0" style="text-align: left;">Preparation and Canvassing of questionnaires on Tenancy,
                        Land Ceiling, Land Records, Land Consolidation, Government Waste Land, Homelessness, Rural
                        Development, including Poverty Alleviation Programmes and generation of empirical data on all
                        these programmes by the IAS Officer Trainees during their district training.</p>
                    <p class="mb-0 mt-2" style="text-align: left;">Preparation and Canvassing of questionnaires on
                        Tenancy, Land Ceiling, Land Records, Land Consolidation, Government Waste Land, Homelessness,
                        Rural Development, including Poverty Alleviation Programmes and generation of empirical data on
                        all these programmes by the IAS Officer Trainees during their district training.</p>
                    <p class="mb-0 mt-2" style="text-align: left;">Preparation and Canvassing of questionnaires on
                        Tenancy, Land Ceiling, Land Records, Land Consolidation, Government Waste Land, Homelessness,
                        Rural Development, including Poverty Alleviation Programmes and generation of empirical data on
                        all these programmes by the IAS Officer Trainees during their district training.</p>
                    <p class="mb-0 mt-2" style="text-align: left;">Preparation and Canvassing of questionnaires on
                        Tenancy, Land Ceiling, Land Records, Land Consolidation, Government Waste Land, Homelessness,
                        Rural Development, including Poverty Alleviation Programmes and generation of empirical data on
                        all these programmes by the IAS Officer Trainees during their district training.</p>
                </div>


                <div class="row pt15">
                    <div class="col-md-4">
                        <div class="event_box bg-red hvr-float-shadow">
                            <a href="<?php echo e(route('mediagallery')); ?>" target="_blank">
                                <span class=""><img src="images/gallery.png" alt="" title=""></span>
                                <h3 class="text-center">Photo Gallery</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="event_box bg-green hvr-float-shadow">
                            <a href="<?php echo e(route('calendar')); ?>">
                                <span class=""><img src="images/upcoming-event.png" alt="" title=""></span>
                                <h3 class="text-center">Training Calender</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="event_box bg-pink hvr-float-shadow">
                            <a href="<?php echo e(route('news')); ?>">
                                <span class=""><img src="images/latest.png" alt="" title=""></span>
                                <h3 class="text-center">Latest News</h3>
                            </a>
                        </div>
                    </div>
                </div>



            </div>
            <div class="col-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color: #af2910;">
                        <h5 class="text-white">Quick Links</h5>
                    </div>
                    <div class="card-body">
                        <ul class="mt-2 mb-2 list-group list-group-flush">
                            <?php $__currentLoopData = $quicklinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="text-start list-group-item">
                                    <?php if($link->website_url): ?>
                                        <!-- For website URL -->
                                        <a href="<?php echo e($link->website_url); ?>" class="text-primary" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                                                </svg>
                                            </span>
                                            <?php echo e($link->txtename); ?> <!-- Display the name of the link -->
                                        </a>
                                    <?php elseif($link->pdf_file): ?>
                                        <!-- For PDF URL -->
                                        
                                        <a href="<?php echo e(asset('storage/' . $link->pdf_file)); ?>" class="text-primary" target="_blank">
                                        

                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                                    <path d="M9 1H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7l-5-6zm0 1.5V6h5L9 2.5zM4 2h5v4H4V2zM3 12V4h5v4h5v4H3z"/>
                                                </svg>
                                            </span>
                                            <?php echo e($link->txtename); ?> <!-- Display the name of the link -->
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            
            
        </div>
    </div>
</section>

<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp11\htdocs\lbsnaa-website\resources\views/user/pages/microsites/index.blade.php ENDPATH**/ ?>