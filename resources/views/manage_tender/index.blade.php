@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>All Tenders / Circulars</h2>
    <a href="{{ route('manage_tender.create') }}" class="btn btn-primary">Add New Tender/Circular</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th> <!-- Index column -->
                <th>Title</th>
                <th>Type</th>
                <th>Language</th>
                <th>Publish Date</th>
                <th>Expiry Date</th>
                <th>Status</th>
                <th>File</th> <!-- Add a column for the file -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenders as $tender)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                    <td>{{ $tender->title }}</td>
                    <td>{{ $tender->type }}</td>
                    <td>{{ $tender->language }}</td>
                    <td>{{ $tender->publish_date }}</td>
                    <td>{{ $tender->expiry_date }}</td>
                    <td>{{ $tender->status }}</td>
                    <td>
                        <!-- Display image if the file exists -->
                        @if($tender->file && in_array(pathinfo($tender->file, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg']))
                            <img src="{{ asset('/storage/uploads/' . $tender->file) }}" alt="Uploaded File" width="100">
                        @elseif($tender->file)
                            <a href="{{ asset('/storage/uploads/' . $tender->file) }}" target="_blank">View File</a>
                        @else
                            No file uploaded
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('manage_tender.edit', $tender->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('manage_tender.destroy', $tender->id) }}" method="POST" style="display:inline;">
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
