@extends('admin.layouts.master')

@section('title', 'Academy Souvenir')

@section('content')
<div class="container">
    <h2>Academy Souvenirs List</h2>
    
    <a href="{{ route('academy_souvenirs.create') }}" class="btn btn-primary mb-3">Add Academy Souvenir</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Category</th>
                <th>Product Title</th>
                <th>Product Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($souvenirs as $souvenir)
            <tr>
                <td>{{ $souvenir->id }}</td>
                <td>{{ $souvenir->product_category }}</td>
                <td>{{ $souvenir->product_title }}</td>
                <td>{{ $souvenir->product_type }}</td>
                <td>{{ $souvenir->product_status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('academy_souvenirs.edit', $souvenir->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('academy_souvenirs.destroy', $souvenir->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
