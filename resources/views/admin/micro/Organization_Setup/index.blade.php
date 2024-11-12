@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Organization Setup</h2>
    <a href="{{ route('organization_setups.create') }}" class="btn btn-primary">Add New Setup</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Research Centre</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Language</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($organizations as $org)
                <tr>
                    <td>{{ $org->research_centre }}</td>
                    <td>{{ $org->employee_name }}</td>
                    <td>{{ $org->designation }}</td>
                    <td>{{ ucfirst($org->language) }}</td>
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
