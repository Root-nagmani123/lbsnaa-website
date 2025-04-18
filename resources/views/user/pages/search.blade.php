@include('user.includes.header')

<style>
    .gcse-search {
        z-index: 9999 !important;
        position: relative !important;
    }

    /* Google Search results ko modal se bahar lane ke liye */
    #search-results-container {
        margin-top: 20px;
    }

    /* Customize the appearance of search results */
    .gsc-results .gsc-webResult {
        border-bottom: 1px solid #ddd;
        margin-bottom: 15px;
    }
    #search-results-container {
    display: block;
    margin-top: 20px;
}

.gsc-webResult {
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
}

</style>

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">
                                @if($_COOKIE['language'] == '2')होम @else Home @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            @if($_COOKIE['language'] == '2')खोज @else Search @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-2">
    <div class="container-fluid">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
                <h1 class="fw-semibold fs-18 mb-0 text-primary">Search</h1>
            </div>

            <!-- Google Custom Search Box -->
            <div class="google-search-box">
                <script async src="https://cse.google.com/cse.js?cx=92ab3f09e86df4584"></script>
                <div class="gcse-search" data-resultsUrl="" data-newWindow="false" data-queryParameterName="q"></div>
            </div>

            <!-- Search Results Modal se Bahar -->
            <div id="search-results-container"></div>

        </div>
    </div>
</section>

<script>
   document.addEventListener("DOMContentLoaded", function() {
    // Wait for Google Custom Search to load the close button
    const observer = new MutationObserver(function(mutationsList) {
        mutationsList.forEach(function(mutation) {
            // Check if the close button is added to the DOM
            const closeButton = document.querySelector(".gsc-results-close-btn");
            if (closeButton) {
                // Add the aria-label attribute to the close button
                closeButton.setAttribute("aria-label", "Close search results");
                // Optionally, you can stop observing after the button is found and modified
                observer.disconnect();
            }
        });
    });

    // Observe the DOM for changes to catch when the close button is added
    observer.observe(document.body, { childList: true, subtree: true });
});

   document.addEventListener("DOMContentLoaded", function() {
    const resultsContainer = document.getElementById("search-results-container");

    if (resultsContainer) {
        // Use MutationObserver to detect when results are loaded
        const observer = new MutationObserver(function(mutationsList) {
            mutationsList.forEach(function(mutation) {
                if (mutation.type === 'childList') {
                    let searchResults = document.querySelector(".gsc-results-wrapper-visible");
                    if (searchResults) {
                        // Remove the results from the modal if inside
                        if (searchResults.closest('.modal')) {
                            searchResults.closest('.modal').remove();
                        }

                        // Append search results to the container outside the modal
                        resultsContainer.appendChild(searchResults);
                        observer.disconnect(); // Stop observing once the results are appended
                    }
                }
            });
        });

        // Start observing the body for added nodes
        observer.observe(document.body, { childList: true, subtree: true });
    }
});

</script>

@include('user.includes.footer')
