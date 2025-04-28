<!-- Container to display PDF -->
<div id="pdfContainer" style="width: 100%; height: 600px; overflow-y: scroll; display: none; background-color: darkgray; text-align: center;">
    <!-- PDF pages will be rendered here -->
</div>

<!-- Loading Spinner (This will be shown while PDF is loading) -->
<div id="loader" class="text-center" style="display: block;">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <p>Loading PDF...</p>
</div>
<!-- Include PDF.js from a CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<script>
// Disable right-click on the PDF container
document.getElementById('pdfContainer').addEventListener('contextmenu', function(e) {
    e.preventDefault();
    // alert('Right-click is disabled on this page.');
});


    // Set the worker source for PDF.js (required for background processing)
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

    window.onload = function() {
        // Replace this with your PDF URL (it should be an accessible URL)
        const pdfUrl = '{{ url("quick-links-files/$path") }}'; // Example URL from backend
        openPDF(pdfUrl);
    }

    function openPDF(pdfUrl) {
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
        }).catch(function(error) {
            console.error('Error loading PDF: ', error);
            loader.innerHTML =
            "<p>Error loading PDF. Please try again later.</p>"; // Show error if PDF fails to load
        });
    }
  
</script>
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
<style>
@media print {
    body {
        display: none !important;
        visibility: hidden !important;
    }
}
</style>
