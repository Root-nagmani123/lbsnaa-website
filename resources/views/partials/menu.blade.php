@if (!empty($menuHierarchy))
    <ul>
        @foreach ($menuHierarchy as $menu)
            <li>
                {{ $menu['name'] }}
                @if (!empty($menu['children']))
                    @include('partials.menu', ['menuHierarchy' => $menu['children']])
                @endif
            </li>
        @endforeach
    </ul>
@endif
