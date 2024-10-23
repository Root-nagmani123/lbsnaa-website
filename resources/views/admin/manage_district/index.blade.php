@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage District</h1>
    <a href="{{ route('district.create') }}" class="btn btn-primary">Add District</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>District Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($districts as $district)
            <tr>
                <td>{{ $district->id }}</td>
                <td>{{ $district->district_name }}</td>
                <td>{{ $district->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('district.edit', $district->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('district.destroy', $district->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
