@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')


@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Structure</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Organization Structure</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">Edit Organization Setup</h4>
            </div>

            <form action="{{ route('organization_setups.update', $organizationSetup->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="language" class="label">Language</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="radio" name="language" value="1" {{ $organizationSetup->language == '1' ? 'checked' : '' }}> English
                                <input type="radio" name="language" value="2" {{ $organizationSetup->language == '2' ? 'checked' : '' }}> Hindi
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="research_centre" class="label">Research Centre</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                            <select class="form-select form-control ps-5 h-58" name="research_centre" id="research_centre" required>
                        <option value="" disabled {{ is_null($organizationSetup->research_centre) ? 'selected' : '' }}>
                            Select Research Centre
                        </option>
                        dd($researchCentres);
                        @foreach($researchCentres as $id => $name)
                            <option value="{{ $id }}" {{ (string)$organizationSetup ->research_centre === (string)$id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="employee_name" class="label">Employee Name</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="employee_name" class="form-control text-dark ps-5 h-58"
                                    id="employee_name" required value="{{ old('employee_name', $organizationSetup->employee_name) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="designation" class="label">Designation</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="designation" class="form-control text-dark ps-5 h-58"
                                    id="designation" required value="{{ old('designation', $organizationSetup->designation) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="email" class="label">Email</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="email" name="email" class="form-control text-dark ps-5 h-58" id="email"
                                    value="{{ old('email', $organizationSetup->email) }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="program_description" class="label">Program Description</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <textarea name="program_description" class="form-control text-dark ps-5 h-58"
                                    required>{{ old('program_description', $organizationSetup->program_description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="main_image" class="label">Main Image</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="file" name="main_image" class="form-control text-dark ps-5 h-58"
                                    id="main_image" >
                                    <small class="form-text text-muted">Leave blank to keep the current image.</small>
                            </div>
                            @if ($organizationSetup->main_image)
                                <!-- Display image from public/images -->
                                <img src="{{ asset('images/' . basename($organizationSetup->main_image)) }}" alt="Current Image" width="100" height="100"><br>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="page_status" class="label">Page Status</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="page_status" class="form-control text-dark ps-5 h-58" id="page_status">
                                    <option value="1" class="text-dark" {{ $organizationSetup->page_status == 1? 'selected' : '' }}>Active</option>
                                    <option value="0" class="text-dark" {{ $organizationSetup->page_status == 0? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex ms-sm-3 ms-md-0">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Update</button>
                        &nbsp;
                        <a href="{{ route('organization_setups.index') }}"
                            class="btn btn-secondary text-white">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('admin_assets/js/ckeditor.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
    .create( document.querySelector( '#program_description' ) )
    .catch( error => {
    console.error( error );
    });
</script>
@endsection
