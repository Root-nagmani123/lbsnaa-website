@include('user.includes.header')
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
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
    <div class="container">
        <div class="tree">
            @if (!empty($hierarchy))
            @foreach ($hierarchy as $node)
            @include('partials.organization-node', ['child' => $node])
            @endforeach
            @endif
        </div>
    </div>
</section>
<style>
.tree {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    position: relative;
}

.chart-box {
    display: inline-block;
    margin: 20px auto;
    text-align: center;
}

.branch {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    position: relative;
}

/* Connecting Lines */
.branch::before {
    content: '';
    position: absolute;
    top: -15px;
    left: 50%;
    width: 2px;
    height: 15px;
    background-color: #fff;
}
.branch > .node:not(:first-child)::before {
    content: '';
    position: absolute;
    top: -10px;
    left: -50%;
    width: 100%;
    height: 2px;
    background-color: #ffffff;
}

.node::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    width: 2px;
    height: 20px;
    background-color: #ffffff;
}

</style>
@include('user.includes.footer')