@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Coordinators</h2>
    <a href="{{ route('coordinators.create') }}" class="btn btn-primary">Add Coordinator</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th> <!-- Add this column for indexing -->
                <th>Page Language</th>
                <th>Coordinator Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coordinators as $coordinator)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                    <td>{{ $coordinator->page_language }}</td>
                    <td>{{ $coordinator->coordinator_name }}</td>
                    <td>{{ $coordinator->status }}</td>
                    <td>
                        <a href="{{ route('coordinators.edit', $coordinator->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('coordinators.destroy', $coordinator->id) }}" method="POST" style="display:inline;">
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
