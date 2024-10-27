@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>All Events</h2>
    <a href="{{ route('manage_events.create') }}" class="btn btn-primary">Add Event</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th> <!-- New column for index -->
                <th>Language</th>
                <th>Title</th>
                <th>Course</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $index => $event) <!-- Use $index to track the iteration -->
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Display the index + 1 for human-readable numbering -->
                    <td>{{ $event->language }}</td>
                    <td>{{ $event->event_title }}</td>
                    <td>{{ $event->course->name ?? 'N/A' }}</td>
                    <td>{{ $event->start_date }}</td>
                    <td>{{ $event->end_date }}</td>
                    <td>{{ $event->status }}</td>
                    <td>
                        <a href="{{ route('manage_events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('manage_events.destroy', $event->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
