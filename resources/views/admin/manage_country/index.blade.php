@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Country</h1>
    <a href="{{ route('country.create') }}" class="btn btn-primary">Add Country</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Contry Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($country as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->country_name }}</td>
                <td>{{ $cat->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('country.edit', $cat->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('country.destroy', $cat->id) }}" method="POST" style="display:inline;">
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
