<?php
$language = $_COOKIE['language'];
$footer_icons = DB::table('home_footer_images')->where('status',1)->when($language == 2, function
($query) use ($language) {
return $query->where('language', '2');
})
->when($language == 1, function ($query) use ($language) {
return $query->where('language', '1');
})->get();
$footer_links = DB::table('menus')->where('txtpostion',3)->where('menu_status',1)->when($language == 2, function
($query) use ($language) {
return $query->where('language', '2');
})
->when($language == 1, function ($query) use ($language) {
return $query->where('language', '1');
})->get();
?>
<!-- quick link section -->
<!-- card section end -->
<!-- footer -->
<style>
.logo-slider-container {
    display: flex;
    justify-content: center;
    /* Center the content horizontally */
    align-items: center;
    /* Center the content vertically */
    height: 100%;
    /* Adjust height as needed */
}

.logo-slider.single-logo {
    display: flex;
    justify-content: center;
    /* Center the single logo */
    align-items: center;
    /* Center vertically if needed */
}

.logo-slider.single-logo .logo-item {
    margin: 0 auto;
    /* Ensure the logo is centered */
}
</style>
</div>
<section class="py-4 bg-white mt-auto mb-4">
    <!-- container -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <!-- row -->
                <div class="row">
                    <div class="logo-slider-container">
                        <div class="logo-slider <?php echo e(count($footer_icons) === 1 ? 'single-logo' : ''); ?>">
                            <?php $__currentLoopData = $footer_icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $footer_icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="logo-item">
                                <a href="<?php echo e($footer_icon->link); ?>" target="_blank">
                                    <img src="<?php echo e(asset('footer-images/' . $footer_icon->image)); ?>"
                                        alt="Logo of <?php echo e($footer_icon->title); ?>"
                                        title="<?php echo e($footer_icon->title); ?>" class="img-fluid"
                                        style="max-width: 150px; max-height: 60px; object-fit: cover;">
                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="pt-2 pb-3">
        <div class="container-fluid">
            <div class="row justify-content-center text-center align-items-center">
                <div class="col-12 col-md-12 px-0">
                    <nav class="nav nav-footer justify-content-center">
                        <?php $__currentLoopData = $footer_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $footer_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($i > 0): ?>
                        <span class="my-2 vr opacity-50"></span>
                        <?php endif; ?>

                        <?php if($footer_link->texttype == 1): ?>
                        
                        <a class="nav-link"
                            href="<?php echo e(url('footer_menu/'.$footer_link->menu_slug)); ?>"><?php echo e($footer_link->menutitle); ?></a>
                        <?php elseif($footer_link->texttype == 2): ?>
                        
                        <a class="nav-link" href="<?php echo e(asset($footer_link->pdf_file)); ?>"
                            target="_blank"><?php echo e($footer_link->menutitle); ?></a>
                        <?php elseif($footer_link->texttype == 3): ?>
                        
                        <a class="nav-link" href="<?php echo e($footer_link->web_site_target == 1 
            ? url($footer_link->website_url) 
            : (str_starts_with($footer_link->website_url, 'http') 
                ? $footer_link->website_url 
                : 'http://' . $footer_link->website_url)); ?>"
                            target="<?php echo e($footer_link->web_site_target == 2 ? '_blank' : '_self'); ?>">
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
                <div class="col-lg-9 col-md-9 col-12">
                    <span>
                        ©
                        <span id="copyright4">
                            <script>
                            document.getElementById("copyright4").appendChild(document.createTextNode(new Date()
                                .getFullYear()));
                            </script>
                        </span>
                        <span>
                            <?php if($_COOKIE['language'] == '2'): ?>
                            लाल बहादुर शास्त्री राष्ट्रीय प्रशासन अकादमी मसूरी, भारत सरकार। सर्वाधिकार सुरक्षित
                            <?php else: ?>
                            Lal Bahadur Shastri National Academy of Administration Mussoorie,Govt of India. All Right
                            Reserved
                            <?php endif; ?>

                        </span>
                </div>

                <!-- Links -->
                <div class="col-lg-3 col-md-12 col-12 d-lg-flex justify-content-end">
                    <div>
                        <?php
                        $social_media_links = DB::table('social_media_links')->get();
                        ?>
                        <!--Facebook-->
                        <a href="<?php echo e($social_media_links[0]->facebook_url); ?>" class="me-2" target="_blank"
                            aria-label="Facebook">
                            <i class="bi bi-facebook fa-2x" style="color: #af2910;"></i>
                        </a>
                        <!--Twitter-->
                        <a href="<?php echo e($social_media_links[0]->twitter_url); ?>" class="me-2" target="_blank"
                            aria-label="Twitter">
                            <i class="bi bi-twitter-x" style="color: #af2910;"></i>
                        </a>

                        <!--GitHub-->
                        <a href="<?php echo e($social_media_links[0]->youtube_url); ?>" class="me-2" target="_blank"
                            aria-label="Youtube">
                            <i class="bi bi-youtube" style="color:#af2910;"></i>
                        </a>
                        <a href="<?php echo e($social_media_links[0]->linkedin_url); ?>" class="me-2" target="_blank"
                            aria-label="Linkedin">
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
<div class="btn-scroll-top" tabindex="0" role="button" aria-label="Go to Top">
    <svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
        <path
            d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z">
        </path>
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
    outline: 3px solid yellow;
    /* Improve focus visibility */
}

.btn-scroll-top.show {
    opacity: 1;
    transform: translateY(0);
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let scrollButton = document.querySelector(".btn-scroll-top");

    // Show button when scrolling down
    window.addEventListener("scroll", function() {
        if (window.scrollY > 200) {
            scrollButton.classList.add("show");
        } else {
            scrollButton.classList.remove("show");
        }
    });

    // Click or Enter/Space key to scroll to top
    scrollButton.addEventListener("click", scrollToTop);
    scrollButton.addEventListener("keydown", function(event) {
        if (event.key === "Enter" || event.key === " ") {
            scrollToTop();
        }
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.logo-slider');
    const sliderContainer = document.querySelector('.logo-slider-container');
    const sliderWidth = slider.scrollWidth;
    const containerWidth = sliderContainer.clientWidth;

    let scrollAmount = 0;
    const scrollStep = 160; // Adjust based on logo width + margin
    const intervalTime = 3000; // Time in milliseconds for each slide
    let autoSlide;

    const startAutoSlide = () => {
        autoSlide = setInterval(() => {
            scrollAmount += scrollStep;
            if (scrollAmount >= sliderWidth - containerWidth) {
                scrollAmount = 0; // Reset to the start
            }
            slider.style.transform = `translateX(-${scrollAmount}px)`;
        }, intervalTime);
    };

    const stopAutoSlide = () => clearInterval(autoSlide);

    // Start automatic sliding
    startAutoSlide();

    // Optional: Pause on hover
    sliderContainer.addEventListener('mouseenter', stopAutoSlide);
    sliderContainer.addEventListener('mouseleave', startAutoSlide);
});
</script>
<script>
// JavaScript to handle marquee play/pause
const marqueeContainer = document.getElementById('marqueeContainer');
const playPauseBtn = document.getElementById('playPauseBtn');
let isPaused = false;
let animationFrame;
let currentTransform = 0; // Keep track of the current position

// Marquee function
function startMarquee() {
    const marqueeSpeed = 2; // Speed in pixels per frame

    function animate() {
        currentTransform -= marqueeSpeed;

        // Reset position when the entire content scrolls out
        if (Math.abs(currentTransform) >= marqueeContainer.scrollWidth) {
            currentTransform = marqueeContainer.offsetWidth;
        }

        marqueeContainer.style.transform = `translateX(${currentTransform}px)`;

        if (!isPaused) {
            animationFrame = requestAnimationFrame(animate);
        }
    }

    animate();
}

// Start marquee on page load
startMarquee();

// Play/Pause functionality
playPauseBtn.addEventListener('click', () => {
    if (isPaused) {
        isPaused = false;
        playPauseBtn.innerHTML = '<i class="material-icons menu-icon">pause</i>';
        startMarquee();
    } else {
        isPaused = true;
        playPauseBtn.innerHTML = '<i class="material-icons menu-icon">play_arrow</i>';
        cancelAnimationFrame(animationFrame);
    }
});
</script>
<script>
// Tiny Slider Configuration for Three Items per Row, with first item larger
const slider = tns({
    container: '.sliderTestimonialFourth',
    items: 3, // Display three items at a time
    slideBy: 1,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayButtonOutput: false,
    controlsContainer: "#sliderTestimonialFourthControls",
    nav: false,
    gutter: 16, // Spacing between cards
    responsive: {
        0: {
            items: 1 // One item for small screens
        },
        768: {
            items: 2 // Two items for medium screens
        },
        1024: {
            items: 3 // Three items for large screens
        }
    },
    edgePadding: 0,
    loop: true
});

function set_font_size(action) {
    var body = document.body;
    var currentSize = window.getComputedStyle(body, null).getPropertyValue('font-size');
    var fontSize = parseFloat(currentSize);

    if (action === 'increase') {
        body.style.fontSize = (fontSize * 1.1) + 'px'; // Increase by 10%
    } else if (action === 'decrease') {
        body.style.fontSize = (fontSize * 0.9) + 'px'; // Decrease by 10%
    } else {
        body.style.fontSize = '16px'; // Reset to default size
    }
}

// Function to change the style (normal or high contrast)
function chooseStyle(action, value) {
    var body = document.body;

    if (action === 'change') {
        body.classList.add('high-contrast'); // Add high contrast class
        body.classList.remove('normal'); // Remove normal style class
    } else {
        body.classList.add('normal'); // Add normal style class
        body.classList.remove('high-contrast'); // Remove high contrast style
    }
}
</script>
<!-- Scripts file for home slider play/pause button -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var carousel = new bootstrap.Carousel(document.getElementById('carouselExampleCaptions'), {
            interval: 3000, // Default interval
            ride: 'carousel'
        });

        var playPauseBtn = document.getElementById("playPauseBtn");
        var isPlaying = true; // Track the state of the slider

        playPauseBtn.addEventListener("click", function () {
    if (isPlaying) {
        carousel.pause();
        playPauseBtn.innerHTML = '<i class="bi bi-play-fill"></i> ';
        playPauseBtn.classList.replace("btn-primary", "btn-success");
        playPauseBtn.setAttribute("aria-label", "Slider Paused"); // Update aria-label
    } else {
        carousel.cycle();
        playPauseBtn.innerHTML = '<i class="bi bi-pause-fill"></i>';
        playPauseBtn.classList.replace("btn-success", "btn-primary");
        playPauseBtn.setAttribute("aria-label", "Slider played"); // Update aria-label
    }
    isPlaying = !isPlaying; // Toggle state
});

    });
</script>
<!-- ✅ JavaScript for Play/Pause Marquee -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var marquee = document.getElementById("marqueeContainer");
    var playPauseBtn = document.getElementById("playPauseBtn1");
    var isPlaying = true; // Initially, marquee is running

    playPauseBtn.addEventListener("click", function() {
    if (isPlaying) {
        marquee.style.animationPlayState = "paused";
        playPauseBtn.innerHTML = '<i class="bi bi-play-fill"></i>';
        playPauseBtn.classList.replace("btn-primary", "btn-success");
        playPauseBtn.setAttribute("aria-label", "latest Updates paused"); // Update aria-label
    } else {
        marquee.style.animationPlayState = "running";
        playPauseBtn.innerHTML = '<i class="bi bi-pause-fill"></i>';
        playPauseBtn.classList.replace("btn-success", "btn-primary");
        playPauseBtn.setAttribute("aria-label", "Latest Updatesr played"); // Update aria-label
    }
    isPlaying = !isPlaying; // Toggle state
});

});
</script>

<script>
            document.addEventListener("DOMContentLoaded", function() {
                let dropdowns = document.querySelectorAll(".nav-item.dropdown");

                dropdowns.forEach((dropdown) => {
                    let toggle = dropdown.querySelector(".nav-link[data-bs-toggle='dropdown']");
                    let menu = dropdown.querySelector(".dropdown-menu");

                    if (toggle && menu) {
                        let bsDropdown = new bootstrap.Dropdown(toggle); // Bootstrap dropdown instance

                        // Ensure dropdown opens when toggle gets focus
                        toggle.addEventListener("focus", function() {
                            bsDropdown.show();
                        });

                        // Ensure dropdown closes when focus moves outside
                        menu.addEventListener("focusout", function() {
                            setTimeout(() => {
                                if (!menu.contains(document.activeElement) && !toggle
                                    .contains(document.activeElement)) {
                                    bsDropdown
                                        .hide(); // Bootstrap method to close dropdown
                                }
                            }, 150);
                        });
                    }
                });

                // Special handling for the search form dropdown
                let searchToggle = document.querySelector(".nav-item.dropdown .nav-link img[alt='search']");
                let searchDropdown = document.querySelector(".nav-item.dropdown .dropdown-menu form");

                if (searchToggle && searchDropdown) {
                    let searchDropdownInstance = new bootstrap.Dropdown(searchToggle);

                    // Open search dropdown when search icon is focused
                    searchToggle.addEventListener("focus", function() {
                        searchDropdownInstance.show();
                    });

                    // Close search dropdown when focus moves outside
                    searchDropdown.addEventListener("focusout", function() {
                        setTimeout(() => {
                            if (!searchDropdown.contains(document.activeElement) && !
                                searchToggle.contains(document.activeElement)) {
                                searchDropdownInstance.hide();
                            }
                        }, 150);
                    });
                }
            });
            </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submenus = document.querySelectorAll('.dynamic-direction');

        submenus.forEach(function(submenu) {
            submenu.addEventListener('mouseenter', function() {
                const dropdownMenu = submenu.querySelector('.dropdown-menu');
                if (!dropdownMenu) return;

                // Reset classes
                submenu.classList.remove('dropend', 'dropstart');

                // Get submenu and dropdown positions
                const submenuRect = submenu.getBoundingClientRect();
                const dropdownRect = dropdownMenu.getBoundingClientRect();
                const viewportWidth = window.innerWidth;

                // Check if the dropdown will overflow to the right
                if (submenuRect.right + dropdownRect.width > viewportWidth) {
                    submenu.classList.add('dropstart');
                } else {
                    submenu.classList.add('dropend');
                }
            });
        });
    });

    $(document).ready(function() {
        // Open dropdown on hover
        $(".dropdown, .dropdown-submenu").hover(
            function() {
                $(this).addClass("show");
                $(this).children(".dropdown-menu").addClass("show");
            },
            function() {
                $(this).removeClass("show");
                $(this).children(".dropdown-menu").removeClass("show");
            }
        );

        // Open dropdown when focused on
        $(".nav-link, .dropdown-item").on("focus", function() {
            let parent = $(this).closest(".dropdown, .dropdown-submenu");
            if (parent.length) {
                parent.addClass("show");
                parent.children(".dropdown-menu").addClass("show");
            }
        });

        // Close the dropdown when Escape key is pressed
        $(document).on("keydown", function(e) {
            if (e.key === "Escape" || e.keyCode === 27) {
                e.preventDefault(); // Prevent default action

                let focusedElement = $(document.activeElement);
                let parentDropdown = focusedElement.closest(".dropdown");

                if (parentDropdown.length) {
                    // Close the dropdown
                    parentDropdown.removeClass("show");
                    parentDropdown.children(".dropdown-menu").removeClass("show");
                    parentDropdown.find(".dropdown-menu")
                        .hide(); // Hide the dropdown to prevent it from showing up again
                }
            }
        });

        // Allow arrow keys to navigate within the dropdown
        $(".dropdown-menu").on("keydown", function(e) {
            let items = $(this).find(".dropdown-item");
            let index = items.index(document.activeElement);

            if (e.key === "ArrowDown") {
                e.preventDefault();
                let nextIndex = (index + 1) % items.length;
                items.eq(nextIndex).focus();
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                let prevIndex = (index - 1 + items.length) % items.length;
                items.eq(prevIndex).focus();
            }
        });
    });
    </script>
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
<script src="<?php echo e(asset('assets/js/vendors/glight.js')); ?>"></script>
<style>
.logo-slider-container {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.logo-slider {
    display: flex;
    transition: transform 0.3s ease-in-out;
    will-change: transform;
}

.logo-item {
    flex: 0 0 auto;
    width: 150px;
    /* Adjust width as needed */
    margin: 0 10px;
}

.slider-prev,
.slider-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
    z-index: 10;
}

.slider-prev {
    left: 0;
}

.slider-next {
    right: 0;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.logo-slider');
    const sliderContainer = document.querySelector('.logo-slider-container');
    const sliderWidth = slider.scrollWidth;
    const containerWidth = sliderContainer.clientWidth;

    let scrollAmount = 0;
    const scrollStep = 160; // Adjust based on logo width + margin
    const intervalTime = 3000; // Time in milliseconds for each slide
    let autoSlide;

    const startAutoSlide = () => {
        autoSlide = setInterval(() => {
            scrollAmount += scrollStep;
            if (scrollAmount >= sliderWidth - containerWidth) {
                scrollAmount = 0; // Reset to the start
            }
            slider.style.transform = `translateX(-${scrollAmount}px)`;
        }, intervalTime);
    };

    const stopAutoSlide = () => clearInterval(autoSlide);

    // Start automatic sliding
    startAutoSlide();

    // Optional: Pause on hover
    sliderContainer.addEventListener('mouseenter', stopAutoSlide);
    sliderContainer.addEventListener('mouseleave', startAutoSlide);
});
</script>
<script>
// Function to get the current language cookie value
function getLanguageCookie() {
    const name = 'language=';
    const decodedCookies = decodeURIComponent(document.cookie).split(';');
    for (let i = 0; i < decodedCookies.length; i++) {
        let cookie = decodedCookies[i].trim();
        if (cookie.indexOf(name) === 0) {
            return cookie.substring(name.length, cookie.length);
        }
    }
    return '1'; // Default to English (1) if no cookie exists
}

// Function to toggle the language cookie and update the text
function toggleLanguageCookie() {
    let currentLanguage = getLanguageCookie();
    let newLanguage = currentLanguage === '1' ? '2' : '1'; // Toggle between 1 (English) and 2 (Hindi)
    document.cookie =
        `language=${newLanguage}; path=/; expires=${new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toUTCString()}`;

    // Update the displayed language text
    updateLanguageText(newLanguage);

    // Optionally reload the page to apply changes
    location.reload();
}

// Function to update the displayed language text
function updateLanguageText(language) {
    const languageText = document.getElementById('language-text');
    if (language === '1') {
        languageText.textContent = 'English';
    } else {
        languageText.textContent = 'Hindi';
    }
}

// Initialize the displayed language text on page load
document.addEventListener('DOMContentLoaded', () => {
    const currentLanguage = getLanguageCookie();
    updateLanguageText(currentLanguage);
});

document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".set-language").forEach(function (el) {
            el.addEventListener("click", function (e) {
                e.preventDefault();

                let lang = this.getAttribute("data-lang");

                fetch("<?php echo e(url('/set-language')); ?>/" + lang, {
                    method: "GET",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // if (data.message === "Language Set") {
                        window.location.href = "<?php echo e(route('home')); ?>";
                        // location.reload(); // Refresh page to apply language change
                    // } else {
                    //     alert("Error changing language!");
                    // }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    });
</script>
</body>

</html><?php /**PATH C:\xampp1\htdocs\lbsnaa-website\resources\views/user/includes/footer.blade.php ENDPATH**/ ?>