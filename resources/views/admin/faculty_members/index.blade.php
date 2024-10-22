@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Faculty Members</h2>
            <a href="{{ route('admin.faculty.create') }}" class="btn btn-primary mb-3">Add Faculty Member</a>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                       
                        <th>Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Mobile</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facultyMembers as $faculty)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                       
                        <td>{{ $faculty->name }}</td>
                        <td>{{ $faculty->email }}</td>
                        <td>{{ $faculty->designation }}</td>
                        <td>{{ $faculty->mobile }}</td>
                        <td>{{ $faculty->category }}</td>
                        <td>
                            @if($faculty->image)
                                <img src="{{ asset($faculty->image) }}" alt="Faculty Image" width="50" height="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            @if($faculty->page_status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.faculty.edit', $faculty->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.faculty.destroy', $faculty->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this faculty member?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
