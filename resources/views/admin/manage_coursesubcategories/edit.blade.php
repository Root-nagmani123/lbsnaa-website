@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="frm_row">
        <label for="txtlanguage">Page Language :</label>
        <input type="radio" name="language" value="1" {{ $subcategory->language == '1' ? 'checked' : '' }}> English
        <input type="radio" name="language" value="2" {{ $subcategory->language == '2' ? 'checked' : '' }}> Hindi
    </div>

    <div class="frm_row">
        <label for="category_name">Category Name:</label>
        <input type="text" name="category_name" id="category_name" value="{{ $subcategory->category_name }}" required>
    </div>

    <div class="frm_row">
        <label for="color_theme">Color Theme:</label>
        <input type="color" name="color_theme" id="color_theme" value="{{ old('color_theme', $subcategory->color_theme) }}">
    </div>
    
    <div class="frm_row">
        <label for="parent_id">Category:</label>
        <select name="parent_id" id="parent_id">
            <option value="0">Root Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $subcategory->parent_id == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>
    

    <div class="frm_row">
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ $subcategory->description }}</textarea>
    </div>

    <div class="frm_row">
        <label for="status">Page Status:</label>
        <select name="status" id="status">
            <option value="1" {{ $subcategory->status == '1' ? 'selected' : '' }}>Draft</option>
            <option value="2" {{ $subcategory->status == '2' ? 'selected' : '' }}>Approval</option>
            <option value="3" {{ $subcategory->status == '3' ? 'selected' : '' }}>Publish</option>
        </select>
    </div>

    <div class="frm_row">
        <button type="submit">Update</button>
        <button type="reset">Reset</button>
        <button type="button" onclick="window.location='{{ url('admin/coursesubcategory') }}'">Back</button>
    </div>
</form>
@endsection
