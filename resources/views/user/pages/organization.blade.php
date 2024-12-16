@include('user.includes.header')
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
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Organizational Structure</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-5">
    <!-- container -->
    <div class="container">
        <div class="row">
            <!-- cols -->
            <div class="col-md-12 col-lg-5">
                <div class="mb-2">
                    <!-- title -->
                    <h1 class="display-4 mb-3 fw-bold">Organizational Chart</h1>
                    <!-- text -->

                </div>
            </div>
        </div>
        <hr class="my-4">


        <div class="row">
        <div class="tree">
    @if (!empty($hierarchy))
        @foreach ($hierarchy as $node)
            <div class="chart-box">
                <strong>{{ $node->employee_name }}</strong><br>
                <small>{{ $node->designation }}</small>

                <!-- Render children recursively -->
                @if (!empty($node->children))
                    <div class="branch">
                        @include('user.pages.organization-child', ['children' => $node->children])
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>


    </div>
</section>

@include('user.includes.footer')