@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Structure</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Organization Structure</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">Add Organization Setup</h4>
            </div>

            <form action="{{ route('organization_setups.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="language" class="label">Page Language</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="radio" name="language" value="1" id="language_english"
                                    {{ old('language') == '1' ? 'checked' : '' }}>
                                <label for="language_english">English</label>

                                <input type="radio" name="language" value="2" id="language_hindi"
                                    {{ old('language') == '2' ? 'checked' : '' }}>
                                <label for="language_hindi">Hindi</label>
                            </div>
                            @error('language')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="research_centre_id" class="label">Select Research Centre</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="research_centre" id="research_centre_id"
                                    class="form-control text-dark ps-5 h-58">
                                    <option value="">Select Research Centre</option>
                                    @foreach ($researchCentres as $id => $name)
                                    <option value="{{ $id }}" {{ old('research_centre') == $id ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('research_centre')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="employee_name" class="label">Employee Name</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="employee_name" class="form-control text-dark ps-5 h-58"
                                    id="employee_name" value="{{ old('employee_name') }}">
                                @error('employee_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="designation" class="label">Designation</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="designation" class="form-control text-dark ps-5 h-58"
                                    id="designation" value="{{ old('designation') }}">
                                @error('designation')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="email" class="label">Email</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="email" name="email" class="form-control text-dark ps-5 h-58" id="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> -->

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="email" class="label">Email</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input 
                                    type="email" 
                                    name="email" 
                                    class="form-control text-dark ps-5 h-58" 
                                    id="email" 
                                    value="{{ old('email') }}"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}" 
                                    title="Please enter a valid email address.">
                                <small id="email-feedback" class="text-muted"></small>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label for="program_description" class="label">Program Description</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <textarea name="program_description" class="form-control text-dark ps-5 h-58"
                                    value="{{ old('program_description') }}" id="program_description"></textarea>
                                @error('program_description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="main_image" class="label">Main Image</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="file" name="main_image" class="form-control text-dark ps-5 h-58"
                                    id="main_image" value="{{ old('main_image') }}">
                                @error('main_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> -->

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="main_image" class="label">Main Image</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="file" name="main_image" class="form-control text-dark ps-5 h-58"
                                    id="main_image" accept=".jpg,.jpeg,.png">
                                <small id="file-name" class="text-muted"></small>
                                @error('main_image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="page_status" class="label">Page Status</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="page_status" class="form-control text-dark ps-5 h-58" id="page_status">
                                    <option value="" class="col">Select</option>
                                    <option value="1" class="col" {{ old('page_status') == '1' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" class="col" {{ old('page_status') == '0' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                                @error('page_status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex ms-sm-3 ms-md-0">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                        &nbsp;
                        <a href="{{ route('organization_setups.index') }}"
                            class="btn btn-secondary text-white">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- here this code use for the editer js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$('#program_description').summernote({
    tabsize: 2,
    height: 300
});
</script>  
<!-- here this code end of the editer js -->
<script>
    const fileInput = document.getElementById('main_image');
    const fileNameDisplay = document.getElementById('file-name');

    // Allowed file types
    const allowedExtensions = ['jpg', 'jpeg', 'png'];

    // Display file name and validate file type
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const fileName = file.name;
            const fileExtension = fileName.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                alert('Only JPG, JPEG, and PNG files are allowed.');
                fileInput.value = ''; // Reset file input
                fileNameDisplay.textContent = ''; // Clear display
            } else {
                fileNameDisplay.textContent = `Selected file: ${fileName}`;
            }
        } else {
            fileNameDisplay.textContent = "No file chosen";
        }
    });
</script>
<script>
    const emailInput = document.getElementById('email');
    const emailFeedback = document.getElementById('email-feedback');

    // Frontend validation for email format
    emailInput.addEventListener('input', () => {
        const emailValue = emailInput.value.trim();
        const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;

        if (emailValue === '') {
            emailFeedback.textContent = "Email is required.";
            emailFeedback.classList.add('text-danger');
            emailFeedback.classList.remove('text-muted');
        } else if (!emailRegex.test(emailValue)) {
            emailFeedback.textContent = "Please enter a valid email address.";
            emailFeedback.classList.add('text-danger');
            emailFeedback.classList.remove('text-muted');
        } else {
            emailFeedback.textContent = "Email looks good.";
            emailFeedback.classList.add('text-muted');
            emailFeedback.classList.remove('text-danger');
        }
    });
</script>
@endsection