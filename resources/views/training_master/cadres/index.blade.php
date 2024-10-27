@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h1>Cadres List</h1>
    <a href="{{ route('cadres.create') }}" class="btn btn-primary">Add Cadre</a>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Description</th>
            <th>Language</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach ($cadres as $cadre)
        <tr>
            <td>{{ $cadre->id }}</td>
            <td>{{ $cadre->code }}</td>
            <td>{{ $cadre->description }}</td>
            <td>{{ $cadre->language }}</td>
            <td>{{ ucfirst($cadre->status) }}</td>
            <td>
                <a href="{{ route('cadres.edit', $cadre->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('cadres.destroy', $cadre->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
