@include('user.includes.header')
<section class="py-5">
            <!-- container -->
            <div class="container">
                <div class="row">
                    <!-- cols -->
                    <div class="col-md-12 col-lg-5">
                        <div class="mb-2">
                            <!-- title -->
                            <h1 class="display-4 mb-3 fw-bold">Media Gallery</h1>
                            <!-- text -->

                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <!-- form -->
                @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-4">
                                <!-- text -->
                                <p>here icon of Media Gallery</p>
                                <a href="" class="btn btn-primary">Academy Song</a>
                                <a href="{{ route('user.photogallery')}}" class="btn btn-primary">Photos Gallery</a>

                             
                            </div>
                        </div>
                     
                    </div>
            </div>
        </section>
        @include('user.includes.footer')