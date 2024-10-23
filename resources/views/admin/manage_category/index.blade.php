@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Category</h1>
    <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Category Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->section_title }}</td>
                <td>{{ $cat->category_description }}</td>
                <td>{{ $cat->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('category.destroy', $cat->id) }}" method="POST" style="display:inline;">
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
