@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <h1>Permissions Management</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Permission Form -->
    <form action="{{ route('permissions.store') }}" method="POST" class="mb-3">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <input type="text" name="name" class="form-control" placeholder="Permission Name" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="description" class="form-control" placeholder="Permission Description">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Add</button>
            </div>
        </div>
    </form>

    <!-- Permissions List -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->description }}</td>
                <td>
                    <!-- Edit Form -->
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="text" name="name" value="{{ $permission->name }}" required>
                        <input type="text" name="description" value="{{ $permission->description }}">
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </form>

                    <!-- Delete Form -->
                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection