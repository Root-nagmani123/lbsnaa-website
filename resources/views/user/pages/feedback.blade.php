@include('user.includes.header')
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
                        <li class="breadcrumb-item active" aria-current="page">Feedback</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-5 col-md-8 mb-3">
            <!-- Success message -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body p-6 d-flex flex-column gap-4">
                    <!-- Form -->
                    <form method="POST" action="{{ route('feedback.store') }}">
                        @csrf
                        <div class="mb-3 ">
                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name"
                                required />
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label" for="mobile">Mobile No. <span class="text-danger">*</span></label>
                            <input type="tel" id="mobile" name="mobile" class="form-control"
                                placeholder="Enter your Mobile No." required pattern="[6-9][0-9]{9}"
                                title="Enter a valid 10-digit mobile number starting with 6-9" />
                        </div>

                        <div class="mb-3 ">
                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your Email" required />
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label" for="category">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled selected>--Select--</option>
                                <option value="1">Signup/Login</option>
                                <option value="2">Task</option>
                                <option value="3">Discussion</option>
                                <option value="4">LBSNAA Content</option>
                                <option value="5">Others</option>
                            </select>
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label" for="comments">Comments <span class="text-danger">*</span></label>
                            <textarea name="comments" id="comments" class="form-control"
                                placeholder="Maximum 500 characters" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('user.includes.footer')