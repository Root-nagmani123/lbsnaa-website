@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Whats New / Quick Link</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('Managenews.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Quick links</span>
        </li>
    </ul>
</div>
<div class="container">
    <form action="{{ route('microquicklinks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="research_centre_id">Select Research Centre</label>
            <select name="research_centre_id" id="research_centre_id" class="form-control" required>
                <option value="">Select Research Centre</option>
                @foreach ($researchCentres as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Page Language</label><br>
            <input type="radio" name="language" value="1" required> English
            <input type="radio" name="language" value="2"> Hindi
        </div>

        <div class="form-group">
            <label for="category_type">Category Type</label>
            <select name="category_type" id="category_type" class="form-control" required>
                <option value="">Select Category</option>
                <option value="1">What's New</option>
                <option value="2">Quick Link</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="menu_type">Menu Type</label>
            <select name="menu_type" id="menu_type" class="form-control" required>
                <option value="">Select</option>
                <option value="1">Content</option>
                <option value="2">PDF file Upload</option>
                <option value="3">Website URL</option>
            </select>
        </div>

        <div id="meta-fields" style="display: none;">
            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" class="form-control">
            </div>

            <div class="form-group">
                <label for="meta_keyword">Meta Keyword</label>
                <textarea name="meta_keyword" id="meta_keyword" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea name="meta_description" id="meta_description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
        </div>

        <div id="pdf-field" style="display: none;">
            <div class="form-group">
                <label for="pdf_file">Document Upload</label>
                <input type="file" name="pdf_file" id="pdf_file" class="form-control">
            </div>
        </div>

        <div id="website-field" style="display: none;">
            <div class="form-group">
                <label for="website_url">Website URL</label>
                <input type="url" name="website_url" id="website_url" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="termination_date">Termination Date</label>
            <input type="date" name="termination_date" id="termination_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="status">Page Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="">Select</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    document.getElementById('menu_type').addEventListener('change', function() {
        const value = this.value;
        document.getElementById('meta-fields').style.display = value === '1' ? 'block' : 'none';
        document.getElementById('pdf-field').style.display = value === '2' ? 'block' : 'none';
        document.getElementById('website-field').style.display = value === '3' ? 'block' : 'none';
    });
</script>
@endsection
