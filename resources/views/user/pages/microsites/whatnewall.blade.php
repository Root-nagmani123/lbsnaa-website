@include('user.pages.microsites.includes.header')

@if(isset($whatnewalls))
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.micrositebyslug', ['slug' => $slug]) }}"
                                style="color: #af2910;">Home</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">What's New Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>



<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-12">
                <ul class="list-group list-group-flush">
                    @foreach($whatnewalls as $news)
                    <li class="list-group-item">
                        @if($news->website_url)
                        <a href="{{ $news->website_url }}" class="text-primary" target="_blank">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                    </path>
                                </svg>
                            </span>
                            {{ $news->txtename }}
                        </a>
                        @elseif($news->pdf_file)
                        <a href="{{ asset('storage/' . $news->pdf_file) }}" class="text-primary" target="_blank">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                    </path>
                                </svg>
                            </span>
                            {{ $news->txtename }}
                        </a>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 col-12">
            <div class="card card-hover border">
                    <div class="card-header bg-danger">
                        <h5 class="text-white">Quick Links</h5>
                    </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: scroll;">
                        <ul class="list-group list-group-flush">
                            <!-- @foreach($quickLinks as $link) -->
                            <li class="list-group-item">
                                <!-- @if($link->website_url) -->
                                <a href="{{ $link->website_url }}" class="text-primary" target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    <!-- {{ $link->txtename }} -->
                                </a>
                                <!-- @elseif($link->pdf_file) -->
                                <a href="" class="text-primary"
                                    target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </span>
                                    <!-- {{ $link->txtename }} -->
                                </a>
                                <!-- @endif -->
                            </li>
                            <!-- @endforeach -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</section>







@include('user.pages.microsites.includes.footer')
@endif