 <!-- footer -->
 <footer class="pt-5 pb-3  mt-auto">
    <div class="container-fluid">

      <!-- Desc -->
      <hr class="mt-6 mb-3">
      <div class="row align-items-center">
        <!-- Desc -->
        <div class="col-12">
          <span>
            ©
            <span id="copyright4 text-center">
              <script>
                document.getElementById("copyright4").appendChild(document.createTextNode(new Date().getFullYear()));
              </script>
            </span>
            Copyright Ministry of Electronics & IT <a href="https://www.digitalindia.gov.in/" target="_blank" style="color: #af2910;">(NeGD)</a>, Government of India.</span> All Rights
            Reserved
          </span>
        </div>
      </div>

      <!-- Links -->
    </div>
  </footer>

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
  <script src="{{ asset('assets/libs/%40popperjs/core/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

  <!-- Theme JS -->
  <script src="{{ asset('assets/js/theme.min.js') }}"></script>


  <script src="{{ asset('assets/libs/tippy.js/dist/tippy-bundle.umd.min.js') }}"></script>

  <script src="{{ asset('assets/js/vendors/tooltip.js') }}"></script>
  <script src="{{ asset('assets/libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
  <script src="{{ asset('assets/js/vendors/tnsSlider.js') }}"></script>
  <script src="{{ asset('assets/libs/glightbox/dist/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/js/vendors/glight.js') }}"></script>
</body>

</html>