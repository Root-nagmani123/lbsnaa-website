@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Manage Organisers</h2>

    <a href="{{ route('organisers.create') }}" class="btn btn-primary">Add Organiser</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th> <!-- Updated to reflect the index -->
                <th>Section Name</th>
                <th>Language</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($organisers as $organiser)
            <tr>
                <!-- Use $loop->iteration to auto-increment the index -->
                <td>{{ $loop->iteration }}</td> 
                <td>{{ $organiser->organiser_name }}</td>
                <td>{{ ucfirst($organiser->language) }}</td>
                <td>
                    @if ($organiser->status == 1)
                        Active
                    @elseif ($organiser->status == 2)
                        Inactive
                    @else
                        Unknown
                    @endif
                </td>
                <td>
                    <a href="{{ route('organisers.edit', $organiser->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('organisers.destroy', $organiser->id) }}" method="POST" style="display:inline-block;">
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
