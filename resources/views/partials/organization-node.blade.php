<div class="chart-box w-100 h-100 d-flex flex-column align-items-center justify-content-center gap-2 p-2">
    <div class="card gap-3">
        <div class="card-body text-center">
        <strong class="card-title text-primary">{{ $child->employee_name }}</strong><br>
            <!-- <span class="badge bg-success">Management</span><br> -->
            <small>{{ $child->designation }}</small>
        </div>
    </div>

    @if (!empty($node->children))
        <div class="branch">
            @foreach ($node->children as $child)
                @include('partials.organization-node', ['node' => $child])
            @endforeach
        </div>
    @endif
</div>

