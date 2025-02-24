@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{route('admin.index')}}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Change Password</span>
        </li>
    </ul>
</div>
@if(Cache::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Cache::get('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(Cache::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Cache::get('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(Cache::has('validation_errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach (Cache::get('validation_errors') as $field => $errors)
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row justify-content-center">
    <div class="col-xxl-9">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
             
                <form id="changepass" name="changepass" method="post" action="{{ route('update_password') }}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="txtpwd">Enter Current Password</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative">
                                        <input type="password" id="txtpwd" class="form-control h-58 text-dark" name="old_password">
                                        <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;" class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute" aria-hidden="true"></i>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="txtnpwd">Enter New Password</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative">
                                        <input type="password" id="txtnpwd" class="form-control h-58 text-dark" name="new_password">
                                        <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;" class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute" aria-hidden="true"></i>
                                        <small>Password must be 8 characters, with at least 1 number, 1 lowercase, and 1 uppercase letter.</small>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="txtcpwd">Confirm New Password</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative">
                                        <input type="password" id="txtcpwd" class="form-control h-58 text-dark" name="confirm_password">
                                        <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;" class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute" aria-hidden="true"></i>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group d-flex gap-3">
                                <button class="btn btn-primary py-3 px-5 fw-semibold text-white" type="submit">Change Password</button>
                            </div>
                        </div>
                    </div>     
                </form>
                  <!-- JavaScript to remove the success message after 10 seconds -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    setTimeout(function () {
                        successAlert.style.opacity = "0";
                        setTimeout(function () {
                            successAlert.remove();
                        }, 1000);
                    }, 4000);
                }
            });
        </script>
        <script>
    document.addEventListener("DOMContentLoaded", function () {
        const passwordFields = document.querySelectorAll(".password-wrapper");

        passwordFields.forEach(wrapper => {
            const input = wrapper.querySelector("input");
            const toggleIcon = wrapper.querySelector(".password-toggle-icon");

            toggleIcon.addEventListener("click", function () {
                if (input.type === "password") {
                    input.type = "text";
                    toggleIcon.classList.remove("ri-eye-off-line");
                    toggleIcon.classList.add("ri-eye-line");
                } else {
                    input.type = "password";
                    toggleIcon.classList.remove("ri-eye-line");
                    toggleIcon.classList.add("ri-eye-off-line");
                }
            });
        });
    });
</script>

            </div>
        </div>
    </div>
</div>
@endsection

