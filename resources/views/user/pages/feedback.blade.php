@include('user.includes.header')
<section class="py-5">
    <!-- container -->
    <div class="container">
        <div class="row">
            <!-- title column -->
            <div class="col-md-12 col-lg-5">
                <div class="mb-2">
                    <!-- title -->
                    <h1 class="display-4 mb-3 fw-bold">Feedback</h1>
                    <!-- description text -->
                </div>
            </div>
        </div>
        <hr class="my-4">

        <!-- Success message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="mb-4">
                    <!-- Feedback text content -->
                    <p>Thank you for visiting LBSNAA   and becoming a stakeholder in the governance procedure of the country. We would like to hear from you about your experience and get your valued feedback on how we can make your participation in the governance process better.</p>
                    <p>If you are facing any issues with the registration or login process, please do not hesitate to contact us through this form. We are happy to assist you with any challenges you might face while browsing and/or participating on LBSNAA  , as we value your contribution.</p>
                    <p>Did not find your suggestions on the platform? Feel free to reach out to us, and we will address your issue as soon as possible. Your participation in LBSNAA  is important to us.</p>
                    <p>For more information, please visit our FAQ page.</p>
                </div>
            </div>

            <!-- Feedback form -->
            <div class="offset-lg-1 col-lg-7 col-md-8 col-12">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <form method="POST" action="{{ route('feedback.store') }}">
                                    @csrf
                                    <div class="mb-3 col-12">
                                        <label class="form-label" for="name">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Enter your Name" required />
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label class="form-label" for="mobile">Mobile No. <span
                                                class="text-danger">*</span></label>
                                        <input type="tel" id="mobile" name="mobile" class="form-control"
                                            placeholder="Enter your Mobile No." required pattern="[6-9][0-9]{9}"
                                            title="Enter a valid 10-digit mobile number starting with 6-9" />
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label class="form-label" for="email">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="Enter your Email" required />
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label class="form-label" for="category">Category <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="category" name="category" required>
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="1">Signup/Login</option>
                                            <option value="2">Task</option>
                                            <option value="3">Discussion</option>
                                            <option value="4">LBSNAA Content</option>
                                            <option value="5">Others</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label class="form-label" for="comments">Comments <span
                                                class="text-danger">*</span></label>
                                        <textarea name="comments" id="comments" class="form-control"
                                            placeholder="Maximum 500 characters" rows="5" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('user.includes.footer')