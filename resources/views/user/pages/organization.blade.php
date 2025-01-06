@include('user.includes.header')
<section class="py-4">
    <div class="container-fluid">
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
<section class="py-5 bg-light">
    <div class="container-fluid">
        <div class="tree">
            @if (!empty($hierarchy))
                @foreach ($hierarchy as $node)
                    @include('partials.organization-node', ['node' => $node])
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
    margin: 20px;
    text-align: center;
    border: 2px solid #af2910;
    border-radius: 10px;
    padding: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 200px; /* Adjust width based on content */
}

.branch {
    display: flex;
    justify-content: center;
    position: relative;
}

.branch::before {
    content: '';
    position: absolute;
    top: -20px; /* Adjust to position the arrow correctly */
    left: 50%;
    width: 2px;
    height: 20px;
    background-color: #af2910; /* Color for the line */
}

.node {
    position: relative;
    display: inline-block;
    margin: 20px;
    padding: 10px;
}

.node::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    width: 2px;
    height: 20px; /* Length of the arrow */
    background-color: #af2910;
}

.node > .branch::before {
    content: '';
    position: absolute;
    top: -20px; /* Adjust the positioning to match the vertical distance */
    left: 50%;
    width: 2px;
    height: 20px;
    background-color: #af2910;
}

/* Optional: Add styling for the arrow to make it look more like a line */
.arrow {
    border-left: 2px solid #af2910; /* Line connecting parent to child */
    position: absolute;
    top: 0;
    left: 50%;
    width: 0;
    height: 20px; /* Adjust arrow length */
}

.card-body {
    padding: 15px;
}

.card-title {
    font-size: 18px;
    font-weight: bold;
    color: #af2910;
}

small {
    font-size: 14px;
    color: #555;
}


</style>
@include('user.includes.footer')