@include('user.includes.header')

@if(isset($nav_page))

<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Home link -->
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Home</a>
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

<section class="py-2 bg-light">
    <div class="container">
        <div class="row gy-4 gy-xl-0">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="accordion" id="accordionExample">
                        <!-- Loop through parent menus -->
                        @foreach($menuItems as $menu)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{$menu->id}}">
                                <button
                                    class="accordion-button {{ $loop->first ? '' : 'collapsed' }} {{ $menu->children->isNotEmpty() ? '' : 'no-arrow' }}"
                                    type="button" data-bs-toggle="{{ $menu->children->isNotEmpty() ? 'collapse' : '' }}"
                                    data-bs-target="{{ $menu->children->isNotEmpty() ? '#collapse-' . $menu->id : '' }}"
                                    aria-expanded="{{ $loop->first && $menu->children->isNotEmpty() ? 'true' : 'false' }}"
                                    aria-controls="{{ $menu->children->isNotEmpty() ? 'collapse-' . $menu->id : '' }}">

                                    <!-- Add the anchor tag around the menu title -->
                                    <a href="{{ url('rti/' . $menu->menu_slug ?? '#') }}" class="text-decoration-none">
                                        {{ $menu->menutitle }}
                                    </a>
                                </button>
                            </h2>
                            @if($menu->children->isNotEmpty())
                            <div id="collapse-{{$menu->id}}"
                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                aria-labelledby="heading-{{$menu->id}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="accordion" id="nestedAccordion-{{$menu->id}}">
                                        @foreach($menu->children as $child)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading-{{$child->id}}">
                                                <button
                                                    class="accordion-button collapsed {{ $child->children->isNotEmpty() ? '' : 'no-arrow' }}"
                                                    type="button"
                                                    data-bs-toggle="{{ $child->children->isNotEmpty() ? 'collapse' : '' }}"
                                                    data-bs-target="{{ $child->children->isNotEmpty() ? '#collapse-' . $child->id : '' }}"
                                                    aria-expanded="false"
                                                    aria-controls="{{ $child->children->isNotEmpty() ? 'collapse-' . $child->id : '' }}">

                                                    <!-- Add anchor tag for child menu -->
                                                    <a href="{{ url('rti/' . $child->menu_slug ?? '#') }}"
                                                        class="text-decoration-none">
                                                        {{ $child->menutitle }}
                                                    </a>
                                                </button>
                                            </h2>
                                            @if($child->children->isNotEmpty())
                                            <div id="collapse-{{$child->id}}" class="accordion-collapse collapse"
                                                aria-labelledby="heading-{{$child->id}}"
                                                data-bs-parent="#nestedAccordion-{{$menu->id}}">
                                                <div class="accordion-body">
                                                    <div class="accordion" id="nestedAccordion-{{$child->id}}">
                                                        @foreach($child->children as $grandChild)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="heading-{{$grandChild->id}}">
                                                                <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapse-{{$grandChild->id}}"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapse-{{$grandChild->id}}">

                                                                    <!-- Add anchor tag for grandchild menu -->
                                                                    <a href="{{ url('rti/' . $grandChild->menu_slug ?? '#') }}"
                                                                        class="text-decoration-none">
                                                                        {{ $grandChild->menutitle }}
                                                                    </a>
                                                                </button>
                                                            </h2>
                                                            <div id="collapse-{{$grandChild->id}}"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="heading-{{$grandChild->id}}"
                                                                data-bs-parent="#nestedAccordion-{{$child->id}}">
                                                                <div class="accordion-body">
                                                                    <!-- You can add content for grandchild if needed -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="col-xl-9 col-lg-6 col-12">
                <div class="mb-6 mb-lg-8">
                    <h2 class="h1 fw-bold text-primary">
                        {{$nav_page->menutitle}}
                    </h2>
                </div>
                <p>{!! $nav_page->content !!}</p>
            </div>
        </div>
    </div>
</section>



@else
<h4>News does not exist</h4>
@endif


<style>
    .accordion-button.no-arrow::after {
        display: none;
    }
</style>
@include('user.includes.footer')