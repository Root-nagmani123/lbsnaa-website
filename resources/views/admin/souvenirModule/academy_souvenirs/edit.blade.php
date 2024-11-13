@extends('admin.layouts.master')

@section('title', 'Add Academy Souvenir')

@section('content')
<div class="container">
    <h2>Edit Academy Souvenir</h2>

    <form action="{{ route('academy_souvenirs.update', $souvenir->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="label" for="menutitle">Page Language :</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="radio" name="language" value="1" {{ $souvenir->language == '1' ? 'checked' : '' }}> English
                <input type="radio" name="language" value="2" {{ $souvenir->language == '2' ? 'checked' : '' }}> Hindi
            </div>
        </div>


        <div class="mb-3">
            <label for="product_category" class="form-label">Product Category</label>
            <select name="product_category" id="product_category" class="form-control" required>
                <!-- Options -->
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $souvenir->product_category == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" class="form-control" id="product_title" name="product_title" value="{{ $souvenir->product_title }}" required>
        </div>

        <div class="mb-3">
            <label for="product_type" class="form-label">Product Type</label>
            <select name="product_type" id="product_type" class="form-control" required>
                <option value="Sale" {{ $souvenir->product_type == 'Sale' ? 'selected' : '' }}>Sale</option>
                <option value="Download" {{ $souvenir->product_type == 'Download' ? 'selected' : '' }}>Download</option>
            </select>
        </div>

        <!-- Sale-specific fields -->
        <div id="sale_fields" style="display:none;">
            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="{{ $souvenir->product_price }}" step="0.01">
            </div>

            <div class="mb-3">
                <label for="product_discounted_price" class="form-label">Discounted Price</label>
                <input type="number" class="form-control" id="product_discounted_price" name="product_discounted_price" value="{{ $souvenir->product_discounted_price }}" step="0.01">
            </div>

            <div class="mb-3">
                <label for="contact_email_id" class="form-label">Contact Email</label>
                <input type="email" class="form-control" id="contact_email_id" name="contact_email_id" value="{{ $souvenir->contact_email_id }}">
            </div>
        </div>

        <!-- Download-specific fields -->
        <div id="download_fields" style="display:none;">
            <div class="mb-3">
                <label for="document_upload" class="form-label">Document Upload</label>
                <input type="file" class="form-control" id="document_upload" name="document_upload">
            <input type="hidden" class="form-control" id="old_document_upload" name="old_document_upload" value="{{ $souvenir->document_upload }}">

                <img src="{{ asset('AcademySouvenir/documents/' . $souvenir->document_upload) }}" alt="Souvenir Image" width="100" height="100">
            </div>
        </div>

        <div class="mb-3">
            <label for="upload_image" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="upload_image" name="upload_image">
            <input type="hidden" class="form-control" id="old_upload_image" name="old_upload_image" value="{{ $souvenir->upload_image }}">
            <img src="{{ asset('AcademySouvenir/images/' . $souvenir->upload_image) }}" alt="Souvenir Image" width="100" height="100">
        </div>

        <div class="mb-3">
            <label for="product_description" class="form-label">Product Description</label>
            <textarea class="form-control" id="product_description" name="product_description">{{ $souvenir->product_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="product_status" class="form-label">Product Status</label>
            <select name="product_status" id="product_status" class="form-control" required>
                <option value="1" {{ $souvenir->product_status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $souvenir->product_status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    document.getElementById('product_type').addEventListener('change', function() {
        if (this.value === 'Sale') {
            document.getElementById('sale_fields').style.display = 'block';
            document.getElementById('download_fields').style.display = 'none';
        } else if (this.value === 'Download') {
            document.getElementById('sale_fields').style.display = 'none';
            document.getElementById('download_fields').style.display = 'block';
        }
    });
    // On page load, set the correct fields
    document.getElementById('product_type').dispatchEvent(new Event('change'));
</script>
@endsection
