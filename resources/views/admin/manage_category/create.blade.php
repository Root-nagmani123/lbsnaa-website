@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Manage Category</h2>
            <form action="{{ route('category.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="section_title">Support Section Title *</label>
                    <input type="text" name="section_title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="category_description">Category Description *</label>
                    <input type="text" name="category_description" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>

            </form>
        </div>
    </div>
</div>
@endsection



{{-- @extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Add Section</h1>
    <form action="{{ route('sections.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Section Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-control" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Section</button>
        <a href="{{ route('sections.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection --}}
