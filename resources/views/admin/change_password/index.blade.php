@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Change Password</h3>
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
<div class="row justify-content-center">
    <div class="col-xxl-9">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
            @if (session('success'))
<div id="success-alert" class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Check for error messages -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
                <form id="changepass" name="changepass" method="post" action="{{ route('update_password') }}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="txtpwd">Enter Old Password</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative">
                                        <input type="password" id="txtpwd" class="form-control h-58 text-dark" name="old_password">
                                        <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;" class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute" aria-hidden="true"></i>
                                        @error('old_password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="txtnpwd">Enter New Password</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative">
                                        <input type="password" id="txtnpwd" class="form-control h-58 text-dark" name="new_password">
                                        <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;" class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute" aria-hidden="true"></i>
                                        <small>Password must be 8 characters, with at least 1 number, 1 lowercase, and 1 uppercase letter.</small>
                                        @error('new_password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="txtcpwd">Confirm Password</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative">
                                        <input type="password" id="txtcpwd" class="form-control h-58 text-dark" name="confirm_password">
                                        <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;" class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute" aria-hidden="true"></i>
                                        @error('confirm_password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                    // Fade out alert after 10 seconds
                    setTimeout(function () {
                        successAlert.style.transition = "opacity 1s ease";
                        successAlert.style.opacity = "0";
                    }, 4000); // 10 seconds
        
                    // Remove alert after fade-out
                    setTimeout(function () {
                        successAlert.remove();
                    }, 5000); // 11 seconds to complete fade-out
                }
            });
        </script>
            </div>
        </div>
    </div>
</div>
@endsection
