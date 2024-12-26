@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">User Management</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Users</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Edit User</h4>
                </div>
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="name" class="label">Name</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="name" class="form-control ps-5 h-58 text-dark"
                                        value="{{ $user->name }}">
                                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="email" class="label">Email</label>
                                <div class="form-group position-relative">
                                    <input type="email" name="email" class="form-control ps-5 h-58 text-dark"
                                        value="{{ $user->email }}">
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="password" class="label">Password (Leave blank to keep current
                                    password)</label>
                                <div class="fomr-group position-relative">
                                    <input type="password" name="password" class="form-control ps-5 h-58 text-dark">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0 gap-2">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection