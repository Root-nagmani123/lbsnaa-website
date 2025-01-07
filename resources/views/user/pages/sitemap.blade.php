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
                            <a href="#" style="color: #af2910;">Sitemap</a>
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
                <h2 class="fw-semibold fs-18 mb-0">Sitemap</h2>
            </div>
            <div class="row">
                @foreach($menuTree as $menu)
                @include('user.pages.sitemap-menu-item', ['menu' => $menu])
                @endforeach
                <h3 class="mb-3 mt-3">Quick Links</h3>
                <ul class="list-group" style="margin-left:30px;">
                    @foreach($quickLinks as $quick_link)
                    <li class="me-2">
                        @if(!empty($quick_link->url))
                        <a href="{{ $quick_link->url_type == 'external' ? (str_starts_with($quick_link->url, 'http') ? $quick_link->url : 'http://' . $quick_link->url) : url($quick_link->url) }}"
                            target="_blank" class="text-decoration-none text-dark">
                            {{ $quick_link->text }}
                        </a>
                        @elseif(!empty($quick_link->file))
                        <a href="{{ asset('quick-links-files/'.$quick_link->file) }}" target="_blank"
                            class="text-decoration-none text-dark">

                            {{ $quick_link->text }}
                        </a>
                        @else
                        {{ $quick_link->text }}
                        @endif
                    </li>
                    @endforeach
                </ul>
                <h3 class="mb-3 mt-3">Footer Links</h3>
                <ul class="list-group" style="margin-left:30px;">
                    @foreach($footerLinks as $i => $footer_link)
                    <li>
                        @if($footer_link->texttype == 1)
                        {{-- Content --}}
                        <a href="{{ url('footer_menu/'.$footer_link->menu_slug) }}" class="text-dark">{{ $footer_link->menutitle }}</a>
                        @elseif($footer_link->texttype == 2)
                        {{-- PDF File Upload --}}
                        <a href="{{ asset($footer_link->pdf_file) }}" target="_blank" class="text-dark">{{ $footer_link->menutitle }}</a>
                        @elseif($footer_link->texttype == 3)
                        {{-- Website URL --}}
                        <a href="{{ str_starts_with($footer_link->website_url, 'http') ? $footer_link->website_url : 'http://' . $footer_link->website_url }}"
                            target="_blank" class="text-dark">{{ $footer_link->menutitle }}</a>
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