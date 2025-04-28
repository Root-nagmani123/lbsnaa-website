@include('user.pages.microsites.includes.header')
<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-9 mb-4 position-relative">
                <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel"
                    data-bs-interval="3000">
                    <div class="carousel-indicators">
                        @foreach ($sliders as $i => $slider)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $i }}"
                            class="{{ $i == 0 ? 'active' : '' }}" aria-label="{{ $slider->slider_text }}" tabindex="0">
                        </button>
                        @endforeach
                    </div>


                    <div class="carousel-inner">
                        @foreach ($sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $slider->slider_image) }}" class="d-block img-fluid"
                                alt="{{ $slider->slider_text }}"
                                style="width: 100%; height: 500px; object-fit: cover; border-radius: 10px;">
                            <div class="carousel-caption d-none d-md-block" style="bottom: 0 !important;">
                                <p class="text-white slider-caption">{{ $slider->slider_text }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Prev & Next Buttons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <!-- Play/Pause Button -->
                    <button id="playPauseBtn" class="btn btn-primary btn-sm" aria-label="Play/Pause button for Sliders">
                        <i class="bi bi-pause-fill"></i>
                        @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                            रोकें
                        @else
                            Pause
                        @endif
                    </button>
                </div>
            </div>


            <!-- What's New Section -->
            <div class="col-12 col-lg-3 mb-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color:#af2910">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2 class="text-white h4">
                                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        नया क्या है
                                    @else
                                        What's New
                                    @endif
                                </h2>
                                
                            </div>
                            <div class="col-lg-6 text-end">
                                <a href="{{ route('user.whatnewall', ['slug' => $slug]) }}" 
                                    style="text-decoration: none; color: #fff" 
                                    aria-label="view all for what's new">
                                    
                                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        सभी देखें
                                    @else
                                        View All
                                    @endif
                                    
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body" style="height:440px;overflow-y: scroll;">
                        <ul class="list-group list-group-flush">
                            @forelse($whatsNew as $news)
                            <li class="list-group-item">
                                @if($news->website_url)
                                <a href="{{ $news->website_url }}" class="text-primary" target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    {{ $news->txtename }}
                                </a>
                                @elseif($news->pdf_file)
                                <a href="{{ asset('storage/' . $news->pdf_file) }}" class="text-primary"
                                    target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    {{ $news->txtename }}
                                </a>
                                @endif
                            </li>
                            @empty
                            <li class="list-group-item text-primary">
                                @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                    कोई डेटा उपलब्ध नहीं है
                                @else
                                    No data available
                                @endif
                            </li>
                                                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-2" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="row">
            <!-- Research Centres -->
            <div class="col-12 col-lg-9 mb-4">
                @foreach($research_centres as $research_centre)
                <h3 class="text-center uppercase fw-bold" style="color:#af2910; font-size:24px;"><a href="#"
                        style="text-decoration: none;color:#af2910;">{{($research_centre->home_title) }}</a>
                    <br><span><img src="{{ asset('assets/images/devider.png') }}"
                            alt="{{ $research_centre->home_title }}"></span>
                </h3>
                <p style="text-align: justify;" class="mb-4">{!! $research_centre->description !!}</p>

                @endforeach

                <div class="d-flex flex-wrap gap-3">
                    @foreach ($research_centres as $research_centre)
                    <a href="{{ route('mediagallery', ['slug' => $research_centre->research_centre_slug]) }}"
                        class="card border shadow-sm text-center" style="width: 200px;">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/image (2).png') }}"
                                alt="{{ $research_centre->home_title }}" class="img-fluid">
                                <p class="mt-3">
                                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        गैलरी
                                    @else
                                        Gallery
                                    @endif
                                </p>
                                                        </div>
                    </a>
                    @endforeach

                    @foreach ($research_centres as $research_centre)
                    <a href="{{ route('news', ['slug' => $research_centre->research_centre_slug]) }}"
                        class="card border shadow-sm text-center" style="width: 200px;">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/newspaper (1).png') }}"
                                alt="{{ $research_centre->home_title }}" class="img-fluid">
                                <p class="mt-3">
                                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        ताज़ा खबर
                                    @else
                                        Latest News
                                    @endif
                                </p>
                                                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-12 col-lg-3 mb-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color:#af2910">
                        <h4 class="text-white h4">
                            @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                त्वरित लिंक
                            @else
                                Quick Links
                            @endif
                        </h4>
                                            </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: scroll;">
                        <ul class="list-group list-group-flush">
                            @forelse($quickLinks as $link)
                            <li class="list-group-item">
                                @if($link->website_url)
                                <a href="{{ $link->website_url }}" class="text-primary" target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    {{ $link->txtename }}
                                </a>
                                @elseif($link->pdf_file)
                                <a href="javascript:void(0)" 
                                    onclick="openPDFModal('{{ asset('storage/' . $link->pdf_file) }}')" 
                                    class="text-primary">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    {{ $link->txtename }}
                                </a>
                            @endif

                            </li>
                            @empty
                            <li class="list-group-item text-primary">
                                @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                    कोई डेटा उपलब्ध नहीं है
                                @else
                                    No data available
                                @endif
                            </li>
                                                        @endforelse
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">
                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                        पीडीएफ दृश्य
                    @else
                    PDF View
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 80vh; text-align: center;">
                <!-- Loading Spinner -->
                <div id="loader" class="text-center" style="display: block;">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p>
                        @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                            लोडिंग पीडीएफ...
                        @else
                        Loading PDF...
                        @endif
                    </p>
                </div>

                <!-- PDF container with scrolling enabled -->
                <div id="pdfContainer" style="width: 100%; height: 600px; overflow-y: scroll; display: none;background-color: darkgray;">
                    <!-- Pages will be appended here dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>
<style>.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.5); /* Adjust the rgba value to control the opacity */
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<script>
    $('#pdfModal').on('show.bs.modal', function () {
    // Set the backdrop color when the modal is shown
    $('.modal-backdrop').css('background-color', 'rgba(61, 56, 56, 0.5)');
});

    document.addEventListener('DOMContentLoaded', function() {
    // Jab modal khule
    $('#pdfModal').on('show.bs.modal', function() {
        document.addEventListener('contextmenu', disableRightClick);
    });

    // Jab modal band ho
    $('#pdfModal').on('hidden.bs.modal', function() {
        document.removeEventListener('contextmenu', disableRightClick);
    });

    function disableRightClick(e) {
        e.preventDefault();
    }
});

    // Function to open PDF in the modal using PDF.js
    function openPDFModal(pdfUrl) {
        const loader = document.getElementById('loader'); // Loading spinner element
        const pdfContainer = document.getElementById('pdfContainer'); // PDF container element

        // Show loader and hide PDF container initially
        loader.style.display = "block"; // Show the loader spinner
        pdfContainer.style.display = "none"; // Hide the PDF container

        const container = document.getElementById('pdfContainer');
        container.innerHTML = ""; // Clear the container before loading the PDF

        // Fetch the PDF document using PDF.js
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdfDoc_) {
            const pdfDoc = pdfDoc_;
            const totalPages = pdfDoc.numPages;

            let renderedPages = 0;

            // Loop through all pages and render them
            for (let pageNum = 1; pageNum <= totalPages; pageNum++) {
                pdfDoc.getPage(pageNum).then(function(page) {
                    const viewport = page.getViewport({
                        scale: 1.25
                    });

                    // Create a canvas element for each page
                    const canvas = document.createElement("canvas");
                    canvas.classList.add("pdf-canvas");
                    canvas.style.marginTop = "0px";  // Remove top margin
                canvas.style.marginBottom = "-25px"; // Remove bottom margin

                    container.appendChild(canvas);

                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    // Render the page into the canvas
                    page.render({
                        canvasContext: context,
                        viewport: viewport
                    }).promise.then(function() {
                        // Increment the rendered pages count
                        renderedPages++;

                        // If all pages are rendered, hide loader and show the PDF container
                        if (renderedPages === totalPages) {
                            loader.style.display = "none"; // Hide the loader
                            pdfContainer.style.display = "block"; // Show the PDF container
                        }
                    });
                });
            }

            // Show the modal with the rendered PDF
            $('#pdfModal').modal('show');
        }).catch(function(error) {
            console.error('Error loading PDF: ', error);
            loader.innerHTML =
            "<p>Error loading PDF. Please try again later.</p>"; // Show error if PDF fails to load
        });
    }
</script>
<!-- Block Ctrl+P -->
<script>
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 'p') {
        e.preventDefault();
        alert('Printing is disabled on this website.');
    }
});

// Detect if user tries to print (some browsers)
window.matchMedia('print').addListener(function(media) {
    if (media.matches) {
        alert('Printing is disabled on this website.');
    }
});
</script>

<!-- Make page blank during printing -->
<style>
@media print {
    body {
        display: none !important;
        visibility: hidden !important;
    }
}
</style>


@include('user.pages.microsites.includes.footer')