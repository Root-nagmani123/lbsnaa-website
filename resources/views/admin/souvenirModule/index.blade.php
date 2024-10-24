@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1>Master Categories</h1>

    <a href="{{ route('souvenir.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Category Name</th>
                <th>Category Name (Hindi)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->type }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->category_name_hindi }}</td>
                    <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('souvenir.edit', $category->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('souvenir.destroy', $category->id) }}" method="POST" style="display:inline-block;">
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
