<div class="level">
    @if (!empty($node->children))
    @foreach ($node->children as $child)
    @include('partials.organization-node', ['node' => $child])
    <!-- Recursive call if there are further children -->
    @if (!empty($child->children))
    @include('partials.organization-recursive', ['node' => $child])
    @endif
    @endforeach
    @endif
</div>
