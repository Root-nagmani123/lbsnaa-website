@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Whats New / Quick Link</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Quick Links</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Edit Quick Links</h4>
                </div>
                <form action="{{ route('microquicklinks.update', $quickLink->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group mb-4">
                                <label for="language" class="label">Page Language</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"
                                        {{ $quickLink->language == 1 ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2"
                                        {{ $quickLink->language == 2 ? 'checked' : '' }}> Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label for="research_centre_id" class="label">Select Research Centre</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="research_centre_id" id="research_centre_id" class="form-control">
                                        <option value="">Select Research Centre</option>
                                        @foreach ($researchCentres as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ $quickLink->research_centre_id == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('research_centre_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label for="category_type" class="label">Category Type</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="categorytype" id="categorytype"
                                        class="form-control text-dark ps-5 h-58">
                                        <option value="">Select Category</option>
                                        <option value="1" {{ $quickLink->categorytype == 1 ? 'selected' : '' }}>What's
                                            New
                                        </option>
                                        <option value="2" {{ $quickLink->categorytype == 2 ? 'selected' : '' }}>Quick
                                            Link
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="txtename" class="label">Name</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="txtename" id="txtename"
                                        class="form-control text-dark ps-5 h-58" value="{{ $quickLink->txtename }}">
                                        @error('txtename')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="menu_type" class="label">Menu Type</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="menu_type" id="menu_type" class="form-control text-dark ps-5 h-58">
                                        <option value="">Select</option>
                                        <option value="1" {{ $quickLink->menu_type == 1 ? 'selected' : '' }}>Content
                                        </option>
                                        <option value="2" {{ $quickLink->menu_type == 2 ? 'selected' : '' }}>PDF file
                                            Upload
                                        </option>
                                        <option value="3" {{ $quickLink->menu_type == 3 ? 'selected' : '' }}>Website URL
                                        </option>
                                    </select>
                                    @error('menu_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div id="meta-fields" style="display: {{ $quickLink->menu_type == 1 ? 'block' : 'none' }};">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="meta_title" class="label">Meta Title</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" name="meta_title" id="meta_title"
                                                class="form-control text-dark ps-5 h-58"
                                                value="{{ $quickLink->meta_title }}">
                                                @error('meta_title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="meta_keyword" class="label">Meta Keyword</label>
                                        <div class="form-group position-relative">
                                            <input type="text" name="meta_keyword" id="meta_keyword"
                                                class="form-control text-dark ps-5 h-58"
                                                value="{{ $quickLink->meta_keyword }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="meta_description" class="label">Meta Description</label>
                                        <div class="form-group position-relative">
                                            <textarea name="meta_description" id="meta_description" class="form-control"
                                                rows="5">{{ $quickLink->meta_description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="description" class="label">Description</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea name="description" id="description" class="form-control"
                                                rows="5">{{ $quickLink->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="pdf-field"
                            style="display: {{ $quickLink->menu_type == 2 ? 'block' : 'none' }};">
                            <div class="form-group">
                                <label for="pdf_file" class="label">Document Upload</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="pdf_file" id="pdf_file"
                                        class="form-control text-dark ps-5 h-58">
                                    @if ($quickLink->pdf_file)
                                    <small>Current file: <a href="{{ asset('storage/' . $quickLink->pdf_file) }}"
                                            target="_blank">View File</a></small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="website-field"
                            style="display: {{ $quickLink->menu_type == 3 ? 'block' : 'none' }};">
                            <div class="form-group mb-4">
                                <label for="website_url" class="label">Website URL</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="url" name="website_url" id="website_url"
                                        class="form-control text-dark ps-5 h-58" value="{{ $quickLink->website_url }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="start_date" class="label">Start Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="start_date" id="start_date"
                                        class="form-control text-dark ps-5 h-58"
                                        value="{{ old('start_date', $startDate) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="termination_date" class="label">Termination Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="termination_date" id="termination_date"
                                        class="form-control text-dark ps-5 h-58"
                                        value="{{ old('termination_date', $terminationDate) }}">
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="status" class="label">Page Status</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="status" id="status" class="form-control text-dark ps-5 h-58">
                                        <option value="1" {{ $quickLink->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $quickLink->status == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0 mt-4">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="{{ route('microquicklinks.index') }}" class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- jQuery (needed for Bootstrap Datepicker) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Datepicker -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">

<script>
$(document).ready(function() {
    // Initialize start_date and termination_date inputs with the datepicker
    $('#start_date').datepicker({
        format: 'dd-mm-yyyy', // Set format to DD-MM-YYYY
        autoclose: true // Auto-close the picker when a date is selected
    });

    $('#termination_date').datepicker({
        format: 'dd-mm-yyyy', // Set format to DD-MM-YYYY
        autoclose: true // Auto-close the picker when a date is selected
    });
});
</script>



<script>
document.getElementById('menu_type').addEventListener('change', function() {
    const value = this.value;
    document.getElementById('meta-fields').style.display = value === '1' ? 'block' : 'none';
    document.getElementById('pdf-field').style.display = value === '2' ? 'block' : 'none';
    document.getElementById('website-field').style.display = value === '3' ? 'block' : 'none';
});
</script>
@endsection