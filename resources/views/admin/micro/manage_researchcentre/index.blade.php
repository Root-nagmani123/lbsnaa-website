@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Research Centres</h2>
    <a href="{{ route('researchcentres.create') }}" class="btn btn-primary mb-3">Add New</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Language</th>
                <th>Research Centre Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($researchCentres as $centre)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $centre->language == 1 ? 'English' : 'Hindi' }}</td>
                <td>{{ $centre->research_centre_name }}</td>
                <td>{{ $centre->description }}</td>
                <td>{{ $centre->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('researchcentres.edit', $centre->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('researchcentres.destroy', $centre->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
