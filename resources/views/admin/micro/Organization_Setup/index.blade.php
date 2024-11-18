@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Organization Structure Management</h2>
    <a href="{{ route('organization_setups.create') }}" class="btn btn-primary">Add New Setup</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th> <!-- Index Column -->
                <th>Research Centre</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Email</th>
                <th>Picture</th>
                <th>Language</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($organizations as $loopIndex => $org)
                <tr>
                    <td>{{ $loopIndex + 1 }}</td> <!-- Displaying the Index -->
                    <td>{{ $org->research_centre }}</td>
                    <td>{{ $org->employee_name }}</td>
                    <td>{{ $org->designation }}</td>
                    <td>{{ $org->email }}</td>
                    <th>
                        <img src="{{ asset('images/' . basename($org->main_image)) }}" alt="Image" style="width: 100px; height: auto;">
                    </th>

                    <td>
                        @if ($org->language == 1)
                            English
                        @else ($org->language == 2)
                            Hindi
                        @endif
                    </td>
                    <td>
                        @if ($org->page_status == 1)
                            Draft
                        @elseif ($org->page_status == 2)
                            Approval
                        @elseif ($org->page_status == 3)
                            Publish
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('organization_setups.edit', $org->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('organization_setups.destroy', $org->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
