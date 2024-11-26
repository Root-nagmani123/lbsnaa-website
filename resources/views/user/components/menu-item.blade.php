@php
    $submenus = DB::table('menus')->where('menu_status',1)->where('txtpostion',1)->where('parent_id', $menu->id)->get();
@endphp

<li class="dropdown-submenu dropend">
    <a class="dropdown-item dropdown-list-group-item {{count($submenus) > 0 ? 'dropdown-toggle' : ''}}"
        href="{{$submenu->parent_id == 27 ? '#' : route('user.navigationpagesbyslug', $submenu->menu_slug)}}">{{$submenu->menutitle}}</a>

    @if(count($submenus) > 0)
        <ul class="dropdown-menu">
            @foreach($submenus as $submenu)
                @include('user.components.menu-item', ['menu' => $submenu])
            @endforeach

        </ul>

    @endif
</li>