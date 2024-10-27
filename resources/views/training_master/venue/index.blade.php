@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Manage Venues</h2>

    <a href="{{ route('venues.create') }}" class="btn btn-primary">Add Venue</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th> <!-- Index column for auto-incrementing -->
                <th>Page Language</th>
                <th>Venue Title</th>
                <th>Venue Detail</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venues as $index => $venue) <!-- Use $index to generate the auto-incrementing value -->
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Display auto-incremented index (starts from 1) -->
                    <td>{{ $venue->page_language }}</td>
                    <td>{{ $venue->venue_title }}</td>
                    <td>{{ $venue->venue_detail }}</td>
                    <td>{{ $venue->status }}</td>
                    <td>
                        <a href="{{ route('venues.edit', $venue->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" style="display:inline;">
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
