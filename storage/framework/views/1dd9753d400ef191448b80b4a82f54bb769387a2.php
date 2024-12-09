<?php 
    $footer_icons =  DB::table('home_footer_images')->where('status',1)->get();
    $footer_links =  DB::table('menus')->where('txtpostion',3)->where('menu_status',1)->get();
?>
<!-- quick link section -->
  <!-- card section end -->
  <!-- footer -->
  <section class="py-4 bg-white mt-auto">
    <!-- container -->
    <div class="container">
      <div class="row">
        <div class="offset-xl-1 col-xl-10 col-md-12 col-12">
          <!-- row -->
          <div class="row">
            <?php $__currentLoopData = $footer_icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $footer_icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col d-flex justify-content-center align-items-center">
              <div class="mb-3 mt-3">
                <img src="<?php echo e(asset('footer-images/' . $footer_icon->image)); ?>" alt="logo" class="img-fluid" style=" max-width: 150px; max-height: 60px; object-fit: contain;">
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              
          </div>
        </div>
      </div>
    </div>
      <!-- footer -->
  <footer class="pt-2 pb-3">
    <div class="container">
      <div class="row justify-content-center text-center align-items-center">
        <div class="col-12 col-md-12 px-0">
          <!-- <div class="mb-4">
            <a href="index.html">
              <img src="assets/images/lbsnaa_logo_new.png" alt="logo" class="mb-4 logo-inverse" width="200">
            </a>
          </div> -->
          <nav class="nav nav-footer justify-content-center">
    <?php $__currentLoopData = $footer_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $footer_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($i > 0): ?>
            <span class="my-2 vr opacity-50"></span>
        <?php endif; ?>

        <?php if($footer_link->texttype == 1): ?> 
            
            <a class="nav-link" href="<?php echo e(url('footer_menu/'.$footer_link->menu_slug)); ?>"><?php echo e($footer_link->menutitle); ?></a>
        <?php elseif($footer_link->texttype == 2): ?> 
            
            <a class="nav-link" href="<?php echo e(asset('uploads/menus/' . $footer_link->pdf_file)); ?>" target="_blank"><?php echo e($footer_link->menutitle); ?></a>
        <?php elseif($footer_link->texttype == 3): ?> 
            
            <a class="nav-link" href="<?php echo e(str_starts_with($footer_link->website_url, 'http') ? $footer_link->website_url : 'http://' . $footer_link->website_url); ?>" target="_blank">
                <?php echo e($footer_link->menutitle); ?>

            </a>
        <?php else: ?>
            
            <a class="nav-link" href="#"><?php echo e($footer_link->menutitle); ?></a>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</nav>

        </div>
      </div>
      <!-- Desc -->
      <hr class="mt-6 mb-3">
      <div class="row align-items-center">
        <!-- Desc -->
        <div class="col-lg-6 col-md-6 col-12">
          <span>
            ©
            <span id="copyright4">
              <script>
                document.getElementById("copyright4").appendChild(document.createTextNode(new Date().getFullYear()));
              </script>
            </span>
            <span style="color: #af2910;">Lal Bahadur Shastri National Academy of Administration</span>. All Rights
            Reserved
          </span>
        </div>

        <!-- Links -->
        <div class="col-lg-6 col-md-12 col-12 d-lg-flex justify-content-end">
          <div>
          <?php
          $social_media_links = DB::table('social_media_links')->get();
          ?>
            <!--Facebook-->
            <a href="<?php echo e($social_media_links[0]->facebook_url); ?>" class="me-2" target="_blank">
              <i class="bi bi-facebook fa-2x" style="color: #af2910;"></i>
            </a>
            <!--Twitter-->
            <a href="<?php echo e($social_media_links[0]->twitter_url); ?>" class="me-2" target="_blank">
              <i class="bi bi-twitter" style="color: #af2910;"></i>
            </a>

            <!--GitHub-->
            <a href="<?php echo e($social_media_links[0]->youtube_url); ?>" class="me-2" target="_blank">
              <i class="bi bi-youtube" style="color:#af2910;"></i>
            </a>
            <a href="<?php echo e($social_media_links[0]->linkedin_url); ?>" class="me-2" target="_blank">
              <i class="bi bi-linkedin" style="color:#af2910;"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Links -->
    </div>
  </footer>
  </section>


  <!-- Scroll top -->
  <div class="btn-scroll-top">
    <svg class="progress-square svg-content" width="100%" height="100%" viewbox="0 0 40 40">
      <path
        d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z">
      </path>
    </svg>
  </div>

  <!-- Scripts -->
  <!-- Libs JS -->
  <script src="<?php echo e(asset('assets/libs/%40popperjs/core/dist/umd/popper.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/libs/simplebar/dist/simplebar.min.js')); ?>"></script>

  <!-- Theme JS -->
  <script src="<?php echo e(asset('assets/js/theme.min.js')); ?>"></script>


  <script src="<?php echo e(asset('assets/libs/tippy.js/dist/tippy-bundle.umd.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/js/vendors/tooltip.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/libs/tiny-slider/dist/min/tiny-slider.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/vendors/tnsSlider.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/libs/glightbox/dist/js/glightbox.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/vendors/glight.js')); ?>"></script>

</body>
</html>
<?php /**PATH C:\xampp6\htdocs\lbsnaa_website\resources\views/user/includes/footer.blade.php ENDPATH**/ ?>