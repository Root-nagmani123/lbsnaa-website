@extends('admin.layouts.master')

@section('title', 'Add Academy Souvenir')

@section('content')
    <div class="container">
        <h2>Add Academy Souvenir</h2>

        <form action="{{ route('academy_souvenirs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="label" for="language">Page Language :</label>
                <span class="star">*</span>
                <div class="form-group position-relative">
                    <input type="radio" name="language" value="1">English
                    <input type="radio" name="language" value="2">Hindi
                </div>
            </div>


            <div class="mb-3">
                <label for="product_category" class="form-label">Product Category</label>
                <select name="product_category" id="product_category" class="form-control" required>
                    <!-- Options go here -->
                    <option value="" disabled selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" class="form-control" id="product_title" name="product_title"
                    value="{{ old('product_title') }}" required>
            </div>

            <div class="mb-3">
                <label for="product_type" class="form-label">Product Type</label>
                <select name="product_type" id="product_type" class="form-control" required>
                    <option value="">Select</option>
                    <option value="Sale">Sale</option>
                    <option value="Download">Download</option>
                </select>
            </div>

            <!-- Sale-specific fields -->
            <div id="sale_fields" style="display:none;">
                <div class="mb-3">
                    <label for="product_price" class="form-label">Product Price</label>
                    <input type="number" class="form-control" id="product_price" name="product_price" step="0.01">
                </div>

                <div class="mb-3">
                    <label for="product_discounted_price" class="form-label">Discounted Price</label>
                    <input type="number" class="form-control" id="product_discounted_price" name="product_discounted_price"
                        step="0.01">
                </div>

                <div class="mb-3">
                    <label for="contact_email_id" class="form-label">Contact Email</label>
                    <input type="email" class="form-control" id="contact_email_id" name="contact_email_id">
                </div>
            </div>

            <!-- Download-specific fields -->
            <div id="download_fields" style="display:none;">
                <div class="mb-3">
                    <label for="document_upload" class="form-label">Document Upload</label>
                    <input type="file" class="form-control" id="document_upload" name="document_upload">
                </div>
            </div>

            <div class="mb-3">
                <label for="upload_image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="upload_image" name="upload_image" required>
            </div>

            <div class="mb-3">
                <label for="product_description" class="form-label">Product Description</label>
                <textarea class="form-control" id="product_description" name="product_description">{{ old('product_description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="product_status" class="form-label">Product Status</label>
                <select name="product_status" id="product_status" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <script>
        // Show/hide sale or download fields based on product type
        document.getElementById('product_type').addEventListener('change', function() {
            if (this.value === 'Sale') {
                document.getElementById('sale_fields').style.display = 'block';
                document.getElementById('download_fields').style.display = 'none';
            } else if (this.value === 'Download') {
                document.getElementById('sale_fields').style.display = 'none';
                document.getElementById('download_fields').style.display = 'block';
            }
        });
    </script>
@endsection
