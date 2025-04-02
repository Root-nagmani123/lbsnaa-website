@php
$Research_Center_list = DB::table('research_centres')
->where('status', 1)
->get(); @endphp

<li>
    <a href="{{route('user.navigationpagesbyslug', $menu['menu_slug'])}}">{{ $menu['title'] }}</a>
    @if($menu['title'] == 'Research Centers'|| $menu['menu_slug'] === 'research-centers_hi')
    
    <ul>
        @foreach($Research_Center_list as $reserch_c)
        <li>
            <a class="" href="{{ url('lbsnaa-sub') }}/{{ $reserch_c->research_centre_slug }}">
                {{ $reserch_c->research_centre_name }}
            </a> 
        </li>
        @endforeach
    </ul>
    @endif
    @if (!empty($menu['children']))
    <ul>
        @foreach ($menu['children'] as $child)
        @include('user.pages.sitemap-menu-item', ['menu' => $child])
        @endforeach
    </ul>
    @endif
</li>