<li>
    {{ $menu['title'] }}
    @if (!empty($menu['children']))
        <ul>
            @foreach ($menu['children'] as $child)
                @include('user.pages.sitemap-menu-item', ['menu' => $child])
            @endforeach
        </ul>
    @endif
</li>
