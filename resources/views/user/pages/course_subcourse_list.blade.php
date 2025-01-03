@include('user.includes.header')

@if(isset($category))
<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-light rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.navigationpagesbyslug', ['slug' => 'training']) }}"
                                class="text-danger">Training Courses</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #af2910;">
                            {{ $category->category_name }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>


<section class="py-1">
    <div class="container-fluid">
        <!-- Section Header -->
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <h2 class="h1 fw-bold text-primary">
                        {{ $category->category_name }}
                    </h2>
                </div>
                <p class="text-muted"><?=$category->description;?></p>
            </div>
        </div>

        <!-- Current Courses Section -->
        <section class="py-4">
            <div class="container">
                <h4 class="mb-3">List Courses:</h4>
                @if(count($sub_category) >0)
                 @foreach($sub_category as $currentCourse)
                    <div class="current-course-box mb-3 p-3 border rounded bg-light">
                    <a href="{{ route('user.courseslug', ['slug' => $currentCourse->slug]) }}"><h5 class="fw-bold">{{ $currentCourse->category_name }}</h5></a>
                     
                    </div>
                    @endforeach
                @else
                    <p class="text-muted">No current courses available for this category.</p>
                @endif
            </div> 
        </section>

    </div>
</section>



@else
    <h4>Does not exist</h4>
@endif

@include('user.includes.footer')

