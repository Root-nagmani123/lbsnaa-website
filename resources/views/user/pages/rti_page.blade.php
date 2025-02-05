@include('user.includes.header')

@if(isset($nav_page))

<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Home link -->
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">@if(Cookie::get('language') ==
                                '2')घर
                                @else
                                Home
                                @endif
                            </a>
                        </li>

                        <!-- Dynamic breadcrumbs -->
                        @foreach ($breadcrumb as $crumb)
                        @if (!$loop->last)
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.get_rti_page_details', $crumb['slug']) }}">{{ $crumb['title'] }}</a>
                        </li>
                        @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $crumb['title'] }}</li>
                        @endif
                        @endforeach
                    </ol>
                </nav>


            </div>
        </div>
    </div>
</section>

<section class="py-2">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 card">
            <ul class="nav nav-pills flex-column">
                @foreach($menuItems as $menu)
                <li class="nav-item">
                    @if($menu->children->isNotEmpty())
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse"
                        data-bs-target="#menu-{{$menu->id}}" aria-expanded="false">
                        {{ $menu->menutitle }}
                    </a>
                    <div class="collapse" id="menu-{{$menu->id}}">
                        <ul class="nav flex-column ms-3">
                            @foreach($menu->children as $child)
                            <li>
                                @if($child->children->isNotEmpty())
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#menu-{{$child->id}}" aria-expanded="false">
                                    {{ $child->menutitle }}
                                </a>
                                <div class="collapse" id="menu-{{$child->id}}">
                                    <ul class="nav flex-column ms-3">
                                        @foreach($child->children as $subChild)
                                        <li><a class="nav-link" href="{{ url('rti/' . $subChild->menu_slug ?? '#') }}">{{ $subChild->menutitle }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <a class="nav-link" href="{{ url('rti/' . $child->menu_slug ?? '#') }}">{{ $child->menutitle }}</a>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                    <a class="nav-link" href="{{ url('rti/' . $menu->menu_slug ?? '#') }}">{{ $menu->menutitle }}</a>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-xl-9 col-lg-6 col-12">
                <div class="mb-4">
                    <h1 class="h1 fw-bold text-primary">
                        {{$nav_page->menutitle}}
                    </h1>
                </div>
                <p>{!! $nav_page->content !!}</p>
            </div>
    </div>
</div>

</section>



@else
<h4>RTI does not exist</h4>
@endif


<style>
.accordion-button.no-arrow::after {
    display: none;
}
</style>
<script>
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>
@include('user.includes.footer')