@include('user.pages.microsites.includes.header')

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                @if(count($breadcrumb) > 0)
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <!-- Home link -->
                            <li class="breadcrumb-item"> 
                                <a href="{{ route('user.micrositebyslug', ['slug' => $slug]) }}" style="color: #af2910;">Home</a>
                            </li>
                            <!-- Dynamic breadcrumbs --> 
                            @foreach ($breadcrumb as $crumb)
                                @if (!$loop->last)
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('user.navigationmenubyslug', $crumb['slug']) }}?slug={{ request()->query('slug') ?: $crumb['slug'] }}" style="color: #af2910;">{{ $crumb['title'] }}</a>
                                    </li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">{{ $crumb['title'] }}</li>
                                @endif
                            @endforeach

                        </ol>
                    </nav>
                @else
                    <!-- Optionally display a message if breadcrumb is empty -->
                    <p>No breadcrumbs available.</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Page Content -->
<section class="py-2">
    <div class="container-fluid">
        <h2 class="text-primary mb-4"><a href="#" class="text-primary">{{ $nav_page->menutitle }}</a></h2>
        <div class="row">
            <div class="col-8">
                <div>
                    @if(!empty($nav_page->content))
                        <div style="text-align: left;">
                            {!! $nav_page->content !!}
                        </div>
                    @else
                        <p>No content available for this page.</p>
                    @endif
                </div>
            </div>
            <div class="col-4">
                <div class="card card-hover border">
                    <div class="card-header" style="background-color: #af2910;">
                        <h3 class="text-white">Quick Links</h3>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        <ul class="mt-2 mb-2 list-group list-group-flush">
                            @forelse($quickLinks as $link)
                                <li class="text-start list-group-item">
                                    @if($link->website_url)
                                        <!-- For website URL -->
                                        <a href="{{ $link->website_url }}" class="text-primary" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                                                </svg>
                                            </span>
                                            {{ $link->txtename }}
                                        </a>
                                    @elseif($link->pdf_file)
                                        <a href="{{ asset('storage/' . $link->pdf_file) }}" class="text-primary" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                                    <path d="M9 1H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7l-5-6zm0 1.5V6h5L9 2.5zM4 2h5v4H4V2zM3 12V4h5v4h5v4H3z"/>
                                                </svg>
                                            </span>
                                            {{ $link->txtename }}
                                        </a>
                                    @endif
                                </li>
                            @empty
                                <li class="text-start list-group-item text-danger">No data available</li>
                            @endforelse
                        </ul>

                    </div>
                </div>

            </div>
            
          
            
        </div>
    </div>
</section>

@include('user.pages.microsites.includes.footer')
