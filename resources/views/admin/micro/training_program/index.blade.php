@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')


@section('content')
<div class="container">
    <h2>Programs List</h2>
    <a href="{{ route('training-programs.create') }}" class="btn btn-primary mb-3">Add New Program</a>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Research Centre</th>
                <th>Program Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Language</th>
                <th>Page Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programs as $program)
                <tr>
                    <td>{{ $program->id }}</td>
                    <td>{{ $program->research_centre }}</td>
                    <td>{{ $program->program_name }}</td>
                    <td>{{ $program->start_date }}</td>
                    <td>{{ $program->end_date }}</td>
                    <td>{{ $program->language }}</td>
                    <td>
                        @if ($program->page_status == 1)
                            Draft
                        @elseif ($program->page_status == 2)
                            Approval
                        @elseif ($program->page_status == 3)
                            Publish
                        @else
                            Unknown
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('training-programs.edit', $program->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('training-programs.destroy', $program->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
