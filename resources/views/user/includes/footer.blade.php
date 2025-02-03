@php
$language = Cookie::get('language');
$footer_icons = DB::table('home_footer_images')->where('status',1)->get();
$footer_links = DB::table('menus')->where('txtpostion',3)->where('menu_status',1)->when($language == 2, function
($query) use ($language) {
return $query->where('language', '2');
})
->when($language == 1, function ($query) use ($language) {
return $query->where('language', '1');
})->get();
@endphp
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
                        <div class="logo-slider {{ count($footer_icons) === 1 ? 'single-logo' : '' }}">
                            @foreach($footer_icons as $footer_icon)
                            <div class="logo-item">
                                <a href="{{ $footer_icon->link }}" target="_blank">
                                    <img src="{{ asset('footer-images/' . $footer_icon->image) }}"
                                        alt="Logo of {{ $footer_icon->title }}" title="Logo of {{ $footer_icon->title }}"
                                        class="img-fluid"
                                        style="max-width: 150px; max-height: 60px; object-fit: cover;">
                                </a>
                            </div>
                            @endforeach
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
                        @foreach($footer_links as $i => $footer_link)
                        @if($i > 0)
                        <span class="my-2 vr opacity-50"></span>
                        @endif

                        @if($footer_link->texttype == 1)
                        {{-- Content --}}
                        <a class="nav-link"
                            href="{{ url('footer_menu/'.$footer_link->menu_slug) }}">{{ $footer_link->menutitle }}</a>
                        @elseif($footer_link->texttype == 2)
                        {{-- PDF File Upload --}}
                        <a class="nav-link" href="{{ asset($footer_link->pdf_file) }}"
                            target="_blank">{{ $footer_link->menutitle }}</a>
                        @elseif($footer_link->texttype == 3)
                        {{-- Website URL --}}
                        <a class="nav-link" href="{{ $footer_link->web_site_target == 1 
            ? url($footer_link->website_url) 
            : (str_starts_with($footer_link->website_url, 'http') 
                ? $footer_link->website_url 
                : 'http://' . $footer_link->website_url) }}"
                            target="{{ $footer_link->web_site_target == 2 ? '_blank' : '_self' }}">
                            {{ $footer_link->menutitle }}
                        </a>



                        @else
                        {{-- Default or Unhandled Type --}}
                        <a class="nav-link" href="#">{{ $footer_link->menutitle }}</a>
                        @endif
                        @endforeach
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
                            @if(Cookie::get('language') == '2')
                            लाल बहादुर शास्त्री राष्ट्रीय प्रशासन अकादमी मसूरी, भारत सरकार। सर्वाधिकार सुरक्षित
                            @else
                            Lal Bahadur Shastri National Academy of Administration Mussoorie,Govt of India. All Right
                            Reserved
                            @endif

                        </span>
                </div>

                <!-- Links -->
                <div class="col-lg-3 col-md-12 col-12 d-lg-flex justify-content-end">
                    <div>
                        @php
                        $social_media_links = DB::table('social_media_links')->get();
                        @endphp
                        <!--Facebook-->
                        <a href="{{ $social_media_links[0]->facebook_url; }}" class="me-2" target="_blank">
                            <i class="bi bi-facebook fa-2x" style="color: #af2910;"></i>
                        </a>
                        <!--Twitter-->
                        <a href="{{ $social_media_links[0]->twitter_url; }}" class="me-2" target="_blank">
                            <i class="bi bi-twitter-x" style="color: #af2910;"></i>
                        </a>

                        <!--GitHub-->
                        <a href="{{ $social_media_links[0]->youtube_url; }}" class="me-2" target="_blank">
                            <i class="bi bi-youtube" style="color:#af2910;"></i>
                        </a>
                        <a href="{{ $social_media_links[0]->linkedin_url; }}" class="me-2" target="_blank">
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
<script src="{{ asset('assets/js/vendors/glight.js') }}"></script>

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

setTimeout(function() {
        var searchResults = $(".gsc-results-wrapper-visible");
        var resultsContainer = $("#search-results-container");

        if (searchResults.length && resultsContainer.length) {
            // Move the results outside the modal
            resultsContainer.append(searchResults);
        }
    }, 3000); // Adjust the timing if necessary
</script>
</body>

</html>