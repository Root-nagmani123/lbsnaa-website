<style>
    #pdf-container {
        width: 90%;
        margin: 0px auto;
        background-color: #f0f0f0;
        padding: 10px;
    }
    canvas {
        border: 1px solid black;
        width: 100%;
        height: auto;
        display: block;
        margin-bottom: 0px;
        background-color: white;
    }
</style>

<div id="pdf-container"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<script>
    var url = '{{ url("quick-links-files/$path") }}';

    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

    var pdfContainer = document.getElementById('pdf-container');

    pdfjsLib.getDocument(url).promise.then(function(pdfDoc) {
        for (let pageNum = 1; pageNum <= pdfDoc.numPages; pageNum++) {
            pdfDoc.getPage(pageNum).then(function(page) {
                var viewport = page.getViewport({ scale: 1 });

                // Adjust scale to fit container width
                var desiredWidth = pdfContainer.clientWidth - 20;
                var scale = desiredWidth / viewport.width;
                var scaledViewport = page.getViewport({ scale: scale });

                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                canvas.height = scaledViewport.height;
                canvas.width = scaledViewport.width;

                var renderContext = {
                    canvasContext: ctx,
                    viewport: scaledViewport
                };
                page.render(renderContext);

                pdfContainer.appendChild(canvas);
            });
        }
    }).catch(function(error) {
        console.error('Error loading PDF:', error);
    });

    // Block Ctrl+P (Print)
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            alert('Printing is disabled on this website.');
        }
    });

    // Block print media query
    window.matchMedia('print').addListener(function(media) {
        if (media.matches) {
            alert('Printing is disabled on this website.');
        }
    });
</script>
