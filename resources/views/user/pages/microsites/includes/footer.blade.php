</div>
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
                     <span id="copyright4">
                         <script>
                         document.getElementById("copyright4").appendChild(document.createTextNode(new Date()
                             .getFullYear()));
                         </script>
                     </span>
                     Lal Bahadur Shastri National Academy of Administration Mussoorie,Govt of India. All Right Reserved
                 </span>
             </div>
         </div>

         <!-- Links -->
     </div>
 </footer>

 <!-- Scroll top -->
 <div class="btn-scroll-top" tabindex="0" role="button" aria-label="Go to Top">
    <svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
        <path d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z"></path>
    </svg>
</div>
<style>
    .btn-scroll-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background-color: #fff;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: opacity 0.3s, transform 0.3s;
    opacity: 0;
    transform: translateY(100px);
    outline: none;
}
.btn-scroll-top:focus {
    outline: 3px solid #af2910; /* Improve focus visibility */
}
.btn-scroll-top.show {
    opacity: 1;
    transform: translateY(0);
}

</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let scrollButton = document.querySelector(".btn-scroll-top");

    // Show button when scrolling down
    window.addEventListener("scroll", function () {
        if (window.scrollY > 200) {
            scrollButton.classList.add("show");
        } else {
            scrollButton.classList.remove("show");
        }
    });

    // Click or Enter/Space key to scroll to top
    scrollButton.addEventListener("click", scrollToTop);
    scrollButton.addEventListener("keydown", function (event) {
        if (event.key === "Enter" || event.key === " ") {
            scrollToTop();
        }
    });

    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: "smooth" });
    }
});
</script>

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
 </body>

 </html>