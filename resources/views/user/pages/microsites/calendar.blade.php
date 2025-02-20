    @include('user.pages.microsites.includes.header')
    <section class="py-4">
        <div class="container-fluid">
            <div class="row align-items-center pb-lg-2">
                <!-- Breadcrumb -->
                <div class="col-12 mb-4 bg-gray-200 rounded-4 py-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-2">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-danger">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Training Calendar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="py-6" id="skip_to_main_content">
        <div class="container-fluid">
            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-12 col-md-6">
                            <p>Test</p>
                        </div>
                        <!-- Right Column -->
                        <div class="col-12 col-md-6">
                            <div id="wrap">
                                <div id="calendar"></div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('user.pages.microsites.includes.footer')