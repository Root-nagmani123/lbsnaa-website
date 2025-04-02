@include('user.includes.header')
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="col-12 mb-4 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-danger">
                                @if($_COOKIE['language'] ==
                                '2')होम
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@if($_COOKIE['language'] ==
                            '2')प्रतिक्रिया
                            @else
                            Feedback
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="container d-flex flex-column" id="skip_to_main_content">
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
                            <label class="form-label" for="name">@if($_COOKIE['language'] ==
                                '2')नाम
                                @else
                                Name
                                @endif
                                <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" 
                            
                            placeholder="@if(isset($_COOKIE['language']) && $_COOKIE['language'] =='2')अपना नाम दर्ज करें @else Enter your Name @endif"
                                required />
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label" for="mobile">
                                @if($_COOKIE['language'] ==
                                '2')मोबाइल नंबर
                                @else
                                Mobile No.
                                @endif
                                <span class="text-danger">*</span></label>
                            <input type="tel" id="mobile" name="mobile" class="form-control"
                                placeholder="@if(isset($_COOKIE['language']) && $_COOKIE['language'] =='2')अपना मोबाइल नम्बर दर्ज करें। @else Enter your Mobile No. @endif" required pattern="[6-9][0-9]{9}"
                                title="Enter a valid 10-digit mobile number starting with 6-9" />
                        </div>

                        <div class="mb-3 ">
                            <label class="form-label" for="email"> @if($_COOKIE['language'] ==
                                '2')ईमेल
                                @else
                                Email
                                @endif
                                <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="@if(isset($_COOKIE['language']) && $_COOKIE['language'] =='2')अपना ईमेल दर्ज करें @else Enter your Email @endif" required />
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label" for="category">
                                @if($_COOKIE['language'] ==
                                '2')वर्ग
                                @else
                                Category
                                @endif
                                <span class="text-danger">*</span></label>
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
                            <label class="form-label" for="comments">
                                @if($_COOKIE['language'] ==
                                '2')टिप्पणियाँ
                                @else
                                Comments
                                @endif
                                <span class="text-danger">*</span></label>
                            <textarea name="comments" id="comments" class="form-control"
                                placeholder="@if(isset($_COOKIE['language']) && $_COOKIE['language'] =='2')अधिकतम 500 अक्षर @else Maximum 500 characters @endif" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                            @if($_COOKIE['language'] ==
                                '2')जमा करना
                                @else
                                Submit
                                @endif
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('user.includes.footer')