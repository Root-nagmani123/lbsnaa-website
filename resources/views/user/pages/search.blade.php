@include('user.includes.header')

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Search</a>
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
                <h2 class="fw-semibold fs-18 mb-0">Search</h2>
            </div>
            <script async src="https://cse.google.com/cse.js?cx=92ab3f09e86df4584"></script>
    <style>
        .gcse-search {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Customize the appearance of the search results */
        .gsc-results .gsc-webResult {
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Google Custom Search Box -->
    <div class="gcse-search"></div>

    <!-- Results Container (will be populated with search results) -->
    <div id="search-results"></div>

   
        </div>
    </div>
</section>

@include('user.includes.footer')

