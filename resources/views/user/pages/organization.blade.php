@include('user.includes.header')
<section class="py-2">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">
                                @if(Cookie::get('language') ==
                                '2')घर
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            @if(Cookie::get('language') ==
                            '2')संगठनात्मक संरचना
                            @else
                            Organizational Structure
                            @endif

                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-2">
    <div class="container-fluid">
        <h1 class="h1 fw-bold text-primary">Organization Structure</h1>
        <div class="org-chart">
            <!-- Render the top level (First Layer) -->
            @if (!empty($hierarchy))
            <div class="level" style="margin:0;">
                @foreach ($hierarchy as $node)
                @include('partials.organization-node', ['node' => $node])
                @endforeach
            </div>
            @endif

            <!-- Render the second layer -->
            @if (!empty($hierarchy))
            @foreach ($hierarchy as $node)
            @if (!empty($node->children)) 
            <div class="line"></div>
            <div class="level" style="margin:0;">
                @foreach ($node->children as $child)
                @include('partials.organization-node', ['node' => $child])
                @endforeach
            </div>

            <!-- Render the third layer (children of second-layer nodes) -->
            @if (!empty($child->children))
            <div class="line"></div>
            <div class="level" style="margin:0;">
                @foreach ($child->children as $grandchild)
                @include('partials.organization-node', ['node' => $grandchild])
                @endforeach
            </div>
            @endif
            @endif
            @endforeach
            @endif
        </div>
    </div>
</section>






<style>
.org-chart {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.level {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    flex-wrap: wrap;
}

.card {
    background-color: #2c2c3e;
    border: 1px solid #444;
    border-radius: 8px;
    padding: 15px;
    margin: 10px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    min-width: 150px;
    max-width: 200px;
}

.line {
    width: 2px;
    height: 20px;
    background-color: #444;
    margin: 0 auto;
}

.org-chart {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.level {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    margin: 20px 0;
}

.card {
    background-color: #dcdcdc;
    border: 1px solid #dcdcdc;
    border-radius: 8px;
    padding: 15px;
    margin: 10px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    min-width: 150px;
    max-width: 200px;
}

.card h3 {
    margin-bottom: 10px;
    font-size: 16px;
}

.card p {
    margin-bottom: 5px;
    font-size: 14px;
}

.card a {
    display: inline-block;
    margin: 5px 0;
    padding: 5px 10px;
    background-color: #af2910;
    border-radius: 4px;
    text-decoration: none;
    color: #fff;
    font-size: 12px;
    transition: background-color 0.3s;
}

.card a:hover {
    background-color: #fff;
    color: #af2910;
    border: 1px solid #af2910;
}

.line {
    width: 2px;
    height: 20px;
    background-color: #af2910;
    margin: 0 auto;
}

.connector {
    display: flex;
    justify-content: center;
    align-items: center;
}

.connector::before,
.connector::after {
    content: '';
    width: 50px;
    height: 2px;
    background-color: #444;
}

.connector::before {
    margin-right: 10px;
}

.connector::after {
    margin-left: 10px;
}

@media (max-width: 768px) {
    .card {
        min-width: 120px;
    }

    .connector::before,
    .connector::after {
        width: 25px;
    }
}
</style>
@include('user.includes.footer')