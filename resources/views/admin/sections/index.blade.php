@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Sections</h1>
    <a href="{{ route('sections.create') }}" class="btn btn-primary">Add Section</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Section Title</th>
                <th>View</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sections as $section)
            <tr>
                <td>{{ $section->id }}</td>
                <td>{{ $section->title }}</td>
                <td><a href="{{ route('sections.edit', $section->id) }}" class="">Click Here</a></td>
                <td>{{ $section->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline;">
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
