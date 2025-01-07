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
            <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
                <h2 class="fw-semibold fs-18 mb-0">Sitemap</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="tree">
                        @foreach($menuTree as $menu)
                        <li>
                            <a href="{{ $menu['url'] ?? '#' }}">{{ $menu['title'] }}</a>
                            @if(!empty($menu['children']))
                            <ul>
                                @foreach($menu['children'] as $child)
                                <li>
                                    <a href="{{ $child['url'] ?? '#' }}">{{ $child['title'] }}</a>
                                    @if(!empty($child['children']))
                                    <ul>
                                        @foreach($child['children'] as $grandchild)
                                        <li>
                                            <a href="{{ $grandchild['url'] ?? '#' }}">{{ $grandchild['title'] }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Quick Links -->
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

                <!-- Footer Links -->
                <h3 class="mb-3 mt-3">Footer Links</h3>
                <ul class="list-group" style="margin-left:30px;">
                    @foreach($footerLinks as $footer_link)
                    <li>
                        @if($footer_link->texttype == 1)
                        <a href="{{ url('footer_menu/'.$footer_link->menu_slug) }}" class="text-dark">{{ $footer_link->menutitle }}</a>
                        @elseif($footer_link->texttype == 2)
                        <a href="{{ asset($footer_link->pdf_file) }}" target="_blank" class="text-dark">{{ $footer_link->menutitle }}</a>
                        @elseif($footer_link->texttype == 3)
                        <a href="{{ str_starts_with($footer_link->website_url, 'http') ? $footer_link->website_url : 'http://' . $footer_link->website_url }}"
                            target="_blank" class="text-dark">{{ $footer_link->menutitle }}</a>
                        @else
                        <a href="#">{{ $footer_link->menutitle }}</a>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
<style>
    .tree {
    list-style: none;
    padding-left: 20px;
    position: relative;
}

.tree li {
    margin: 0 0 10px 20px;
    position: relative;
    padding-left: 15px;
}

.tree li::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 10px;
    height: 100%;
    border-left: 2px solid #ccc;
}

.tree li::after {
    content: '';
    position: absolute;
    top: 10px;
    left: 0;
    width: 10px;
    height: 2px;
    background: #ccc;
}

.tree li:last-child::before {
    height: 10px;
}

.tree li a {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
}

.tree li a:hover {
    text-decoration: underline;
}

.tree ul {
    list-style: none;
    padding-left: 20px;
    margin-left: 10px;
    border-left: 2px solid #ccc;
}

</style>

@include('user.includes.footer')