@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage State</h1>
    <a href="{{ route('state.create') }}" class="btn btn-primary">Add State</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>State Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($states as $state)
            <tr>
                <td>{{ $state->id }}</td>
                <td>{{ $state->state_name }}</td>
                <td>{{ $state->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('state.edit', $state->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('state.destroy', $state->id) }}" method="POST" style="display:inline;">
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
