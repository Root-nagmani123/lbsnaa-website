@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit category</h1>
    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        @method('post')
        <div class="form-group">
            <label for="section_title">Section Title *</label>
            <input type="text" name="section_title" class="form-control" value="{{ $category->section_title }}"required>
        </div>
        
        <div class="form-group">
            <label for="category_description">Category Description </label>
            <input type="text" name="category_description" class="form-control" value="{{ $category->category_description }}">
        </div>



        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $category->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$category->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

