@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
                    <h3 class="mb-sm-0 mb-1 fs-18">Profile</h3>
                    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
                        <li>
                            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">View Profile</span>
                        </li>
                    </ul>
                </div>

                
<div class="container">
    <div class="cpanel-left">
        <div class="cpanel-right_heading">
            <h3 class="editprofile">View Profile</h3>
        </div>
        
        <!-- Login ID Field -->
        <div class="frm_row">
            <div class="clear"></div>
            <div class="frm_row"> 
                <span class="label1">
                    <label>Login ID:</label>
                </span> 
                <span class="input1">
                    <label class="label1">
                        {{ $user->name ?? 'N/A' }}
                    </label>
                </span>
                <div class="clear"></div>
            </div>
            
            <!-- Email Field -->
            <div class="frm_row"> 
                <span class="label1">
                    <label>Email:</label>
                    <span class="star"></span>
                </span> 
                <span class="input1">
                    <label class="label1">
                        {{ $user->email ?? 'N/A' }}
                    </label>
                </span>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

@endsection
