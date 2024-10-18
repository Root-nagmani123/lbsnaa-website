@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Staff Members</h2>
        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary mb-3">Add New Staff</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffMembers as $staff)
                    <tr>
                        <td>{{ $staff->name }}</td>
                        <td>{{ $staff->email }}</td>
                        <td>{{ $staff->designation }}</td>
                        <td>
                            <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
