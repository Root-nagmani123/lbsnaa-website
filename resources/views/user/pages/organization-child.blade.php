<style>
    .tree {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    margin-top: 20px;
}

.chart-box {
    background: #f4f4f4;
    padding: 15px 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    text-align: center;
    font-family: Arial, sans-serif;
    position: relative;
}

.chart-box strong {
    font-size: 16px;
    color: #333;
}

.chart-box small {
    font-size: 14px;
    color: #777;
    display: block;
    margin-top: 5px;
}

.branch {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 20px;
    position: relative;
}

.branch:before {
    content: "";
    position: absolute;
    top: -15px;
    left: 50%;
    width: 2px;
    height: 15px;
    background: #ccc;
}

.branch:after {
    content: "";
    position: absolute;
    top: -15px;
    left: 0;
    right: 0;
    height: 2px;
    background: #ccc;
}

</style>
@foreach ($children as $child)
    <div class="chart-box">
        <strong>{{ $child->employee_name }}</strong><br>
        <small>{{ $child->designation }}</small>

        <!-- Recursively render children -->
        @if (!empty($child->children))
            <div class="branch">
                @include('user.pages.organization-child', ['children' => $child->children])
            </div>
        @endif
    </div>
@endforeach
