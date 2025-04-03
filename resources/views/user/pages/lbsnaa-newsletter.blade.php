@include('user.includes.header')

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-light rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">
                                @if (isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                    होम
                                @else
                                    Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @if (isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                संकाय
                            @else
                                Newsletter
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card bg-white border-0 rounded-10 mb-4" id="skip_to_main_content">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
                    <h3 class="fw-semibold fs-18 mb-0">
                        @if (isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                            इनहाउस फैकल्टी
                        @else
                            Newsletter
                        @endif
                    </h3>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="default-table-area members-list">
                    <div class="row">
                        @if ($newsletters)
                            @foreach ($newsletters as $val)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                                    <div class="card p-2 bg-light rounded-10 shadow-sm">
                                        <div class="content-with-images">
                                            <div class="images-container">
                                                <img src="{{ asset($val?->images) }}"
                                                    alt="Image" class="img-fluid rounded-10 mb-3"
                                                    style="width: 100vw; height: 17vw;" />
                                            </div>

                                            <p>{{ $val?->title }}</p>

                                            <div class="content d-flex justify-content-between">
                                                <!-- Display PDF Button (No download button) -->
                                                @if ($val?->pdf)
                                                    <a href="javascript:void(0)" class="btn btn-primary mt-3" onclick="openPDFModal('{{ asset($val->pdf) }}')">
                                                        @if (isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                                            देखें PDF
                                                        @else
                                                            View PDF
                                                        @endif
                                                    </a>
                                                @endif

                                                @if ($val?->ebook)
                                                    <a href="{{ route('newsletter-ebook', ['id' => encrypt($val->id)]) }}" class="btn btn-primary mt-3" >
                                                        @if (isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                                            देखें
                                                        @else
                                                            View ebook
                                                        @endif
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">No Newsletter Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal for displaying the PDF -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- PDF container with scrolling enabled -->
                <div id="pdfContainer" style="width: 100%; height: 600px; overflow-y: scroll;">
                    <!-- Pages will be appended here dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<script>
    // Function to open PDF in the modal using PDF.js
    function openPDFModal(pdfUrl) {
        const container = document.getElementById('pdfContainer');
        container.innerHTML = "";  // Clear the container before loading the PDF

        // Fetch the PDF document using PDF.js
        pdfjsLib.getDocument(pdfUrl).promise.then(function (pdfDoc_) {
            const pdfDoc = pdfDoc_;
            const totalPages = pdfDoc.numPages;

            // Loop through all pages and render them
            for (let pageNum = 1; pageNum <= totalPages; pageNum++) {
                pdfDoc.getPage(pageNum).then(function(page) {
                    const viewport = page.getViewport({ scale: 1.5 });

                    // Create a canvas element for each page
                    const canvas = document.createElement("canvas");
                    canvas.classList.add("pdf-canvas");
                    canvas.style.marginBottom = "20px";  // Add some spacing between pages
                    container.appendChild(canvas);

                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    // Render the page into the canvas
                    page.render({
                        canvasContext: context,
                        viewport: viewport
                    });
                });
            }

            // Show the modal with the rendered PDF
            $('#pdfModal').modal('show');
        }).catch(function(error) {
            console.error('Error loading PDF: ', error);
        });
    }
</script>

@include('user.includes.footer')
