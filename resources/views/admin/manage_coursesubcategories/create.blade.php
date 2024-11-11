@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
    <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="frm_row">
            <label for="txtlanguage">Page Language :</label>
            <input type="radio" name="language" value="1"> English
            <input type="radio" name="language" value="2"> Hindi
        </div>

        <div class="frm_row">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" id="category_name" required>
        </div>

        <div class="frm_row">
            <label for="color_theme">Color Theme:</label>
            <input type="color" name="color_theme" id="color_theme" value="#000000">
        </div>

        <div class="frm_row">
            <label for="parent_id">Parent Category:</label>
            <select name="parent_id" id="parent_id">
                <option value="0">It is Root Category</option>
                {!! buildCategoryOptions($subcategories) !!}
            </select>
        </div>

        <div class="frm_row">
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <div class="frm_row">
            <label for="status">Page Status:</label>
            <select name="status" id="status">
                <option value="1">Draft</option>
                <option value="2">Approval</option>
                <option value="3">Publish</option>
            </select>
        </div>

        <div class="frm_row">
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
            <button type="button" onclick="window.location='{{ url('admin/coursesubcategory') }}'">Back</button>
        </div>
    </form>

    <script>
        document.getElementById('color_theme').addEventListener('input', function() {
            var color = this.value;
            document.getElementById('color_preview').style.backgroundColor = color;
        });
    </script>

    @php
        function buildCategoryOptions($categories, $parentId = 0, $prefix = '')
        {
            $html = '';
            foreach ($categories as $category) {
                if ($category->parent_id == $parentId) {
                    $html .=
                        '<option value="' . $category->id . '">' . $prefix . $category->category_name . '</option>';
                    $html .= buildCategoryOptions($categories, $category->id, $prefix . '-');
                }
            }
            return $html;
        }
    @endphp

@endsection
