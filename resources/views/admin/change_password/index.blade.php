@extends('layouts.app')
@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">
        <h3 class="editprofile">Change Password</h3>
        <!-- Check for success message -->
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
            <div class="form-group">
                <label for="txtpwd">Enter Old Password:</label>
                <input type="password" name="old_password" class="form-control" id="txtpwd" required>
                @error('old_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="txtnpwd">Enter New Password:</label>
                <input type="password" name="new_password" class="form-control" id="txtnpwd" required>
                <small>Password must be 8 characters, with at least 1 number, 1 lowercase, and 1 uppercase letter.</small>
                @error('new_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="txtcpwd">Confirm Password:</label>
                <input type="password" name="confirm_password" class="form-control" id="txtcpwd" required>
                @error('confirm_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
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
@endsection
