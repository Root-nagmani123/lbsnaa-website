@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1>Users List</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th> <!-- Added Status Column -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if($user->status == 1)
                    <span class="badge bg-success">Active</span>
                @elseif($user->status == 2)
                    <span class="badge bg-danger">Inactive</span>
                @else
                    <span class="badge bg-secondary">SuperAdmin</span>
                @endif
            </td>
            <td>
                @if($user->user_type == 2)
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>

                <!-- Status Change Buttons -->
                <form action="{{ route('users.updateStatus', $user->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @if($user->status == 1)
                        <button type="submit" name="status" value="2" class="btn btn-sm btn-warning">Set Inactive</button>
                    @else
                        <button type="submit" name="status" value="1" class="btn btn-sm btn-success">Set Active</button>
                    @endif
                </form>
                <a href="{{ route('users.permissions', $user->id) }}" class="btn btn-sm btn-primary">Set Permissions</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
