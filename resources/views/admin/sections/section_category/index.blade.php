@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container"> 
    <h1>Sections</h1>
    <a href="{{ route('admin.section_category.create',$id) }}" class="btn btn-primary">Add Section</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>description</th>
                <th>officer_Incharge</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sections as $section)
            <tr>
                <td>{{ $section->name }}</td>
                <td>{{ $section->description }}</td>
                <td>{{ $section->officer_Incharge }}</td>
                
                <td>{{ $section->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('admin.section_category.edit', $section->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.section_category.destroy', $section->id, $id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
