@extends('layouts.app')
@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
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
