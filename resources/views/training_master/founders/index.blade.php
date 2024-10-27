@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Founders List</h2>
    <a href="{{ route('founders.create') }}" class="btn btn-primary">Add New Founder</a>

    @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th> <!-- Add a header for index -->
                <th>Name</th>
                <th>Language</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($founders as $index => $founder) <!-- Use $index for the incrementing index -->
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index here -->
                    <td>{{ $founder->name }}</td>
                    <td>{{ $founder->language }}</td>
                    <td>{{ $founder->status }}</td>
                    <td> 
                        <a href="{{ route('founders.edit', $founder->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('founders.destroy', $founder->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
