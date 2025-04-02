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
                            <a href="{{ route('home')}}" style="color: #af2910;">@if($_COOKIE['language'] ==
                                '2')घर
                                @else
                                Home
                                @endif</a>
                        </li>
                        <li class="breadcrumb-item">
                            @if($_COOKIE['language'] ==
                            '2')साइट मैप
                            @else
                            Sitemap
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-2" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
                <h2 class="fw-semibold fs-18 mb-0">@if($_COOKIE['language'] ==
                    '2')साइट मैप
                    @else
                    Sitemap
                    @endif</h2>
            </div>
            <div class="row">
                @foreach($menuTree as $menu)
                @include('user.pages.sitemap-menu-item', ['menu' => $menu])
                @endforeach
                @if($_COOKIE['language'] ==
                    '2')<h3 class="mb-3 mt-3">त्वरित लिंक्स</h3>
                    @else
                    <h3 class="mb-3 mt-3">Quick Links</h3>
                    @endif
                
                <ul class="list-group" style="margin-left:30px;">
                    @foreach($quickLinks as $quick_link)
                    <li class="me-2">
                        @if(!empty($quick_link->url))
                        <a href="{{ $quick_link->url_type == 'external' ? (str_starts_with($quick_link->url, 'http') ? $quick_link->url : 'http://' . $quick_link->url) : url($quick_link->url) }}"
                            target="_blank">
                            {{ $quick_link->text }}
                        </a>
                        @elseif(!empty($quick_link->file))
                        <a href="{{ asset('quick-links-files/'.$quick_link->file) }}" target="_blank">

                            {{ $quick_link->text }}
                        </a>
                        @else
                        {{ $quick_link->text }}
                        @endif
                    </li>
                    @endforeach
                </ul>
                <h3 class="mb-3 mt-3">@if($_COOKIE['language'] ==
                    '2')पाद लिंक
                    @else
                    Footer Links
                    @endif
                </h3>
                <ul class="list-group" style="margin-left:30px;">
                    @foreach($footerLinks as $i => $footer_link)
                    <li>
                        @if($footer_link->texttype == 1)
                        {{-- Content --}}
                        <a href="{{ url('footer_menu/'.$footer_link->menu_slug) }}">{{ $footer_link->menutitle }}</a>
                        @elseif($footer_link->texttype == 2)
                        {{-- PDF File Upload --}}
                        <a href="{{ asset($footer_link->pdf_file) }}" target="_blank">{{ $footer_link->menutitle }}</a>
                        @elseif($footer_link->texttype == 3)
                        {{-- Website URL --}}
                        <a href="{{ str_starts_with($footer_link->website_url, 'http') ? $footer_link->website_url : 'http://' . $footer_link->website_url }}"
                            target="_blank">{{ $footer_link->menutitle }}</a>
                        @else
                        {{-- Default or Unhandled Type --}}
                        <a href="#">{{ $footer_link->menutitle }}</a>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

@include('user.includes.footer')