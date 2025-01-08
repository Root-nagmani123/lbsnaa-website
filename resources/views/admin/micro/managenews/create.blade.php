@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage News</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('Managenews.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">News</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add News</h4>
                </div>
                <form action="{{ route('Managenews.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Language -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1" {{ old('language') == 1 ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2" {{ old('language') == 2 ? 'checked' : '' }}> Hindi
                                </div>
                                @error('language')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Research Centre -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="select_research_centre">Select Research Centre:</label>
                                <span class="star">*</span>
                                <select name="research_centre" class="form-control">
                                    <option value="" selected>Select Research Centre</option>
                                    @foreach ($researchCentres as $id => $name)
                                        <option value="{{ $id }}" {{ old('research_centre') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('research_centre')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="title">Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="title" id="title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Short Description -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="short_description" class="label">Short Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="short_description" id="short_description" class="form-control  text-dark">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Meta Title -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_title">Meta Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="meta_title" id="meta_title" value="{{ old('meta_title') }}">
                                    @error('meta_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Meta Keywords -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_keywords">Meta Keywords :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Meta Description -->
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="meta_description" class="label">Meta Description</label>
                                <div class="form-group position-relative">
                                    <textarea name="meta_description" id="meta_description" class="form-control  text-dark">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description" class="label">Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="description" id="description" class="form-control  text-dark">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Main Image -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="main_image" class="label">Main Image</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="main_image" id="main_image" class="form-control text-dark  h-58">
                                    @error('main_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Multiple Images -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="multiple_images" class="label">Upload Multiple Image</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="multiple_images[]" id="multiple_images" class="form-control text-dark  h-58" multiple>
                                    @error('multiple_images')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Start Date -->
                        <!-- <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="start_date" class="label">Start Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="start_date" id="start_date" class="form-control text-dark  h-58" placeholder="DD-MM-YYYY" value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div> -->

                        <!-- End Date -->
                        <!-- <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="end_date" class="label">End Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="end_date" id="end_date" class="form-control text-dark  h-58" placeholder="DD-MM-YYYY" value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div> -->

                        <!-- Start Date -->
                        <!-- <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="start_date" class="label">Start Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" name="start_date" id="start_date" class="form-control text-dark  h-58" value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="end_date" class="label">End Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" name="end_date" id="end_date" class="form-control text-dark  h-58" value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-6">
    <div class="form-group mb-4">
        <label for="start_date" class="label">Start Date</label>
        <span class="star">*</span>
        <div class="form-group position-relative">
            <input 
                type="date" 
                name="start_date" 
                id="start_date" 
                class="form-control text-dark  h-58" 
                value="{{ old('start_date') }}" 
                onchange="setMinEndDate()"
            >
            @error('start_date')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="form-group mb-4">
        <label for="end_date" class="label">End Date</label>
        <span class="star">*</span>
        <div class="form-group position-relative">
            <input 
                type="date" 
                name="end_date" 
                id="end_date" 
                class="form-control text-dark  h-58" 
                value="{{ old('end_date') }}"
            >
            @error('end_date')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>



                        <!-- Status -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="status" id="status">
                                        <option value="" class="text-dark" selected>Select</option>
                                        <option value="1" class="text-dark" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Back Buttons -->
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Add News</button>
                            &nbsp;
                            <a href="{{ route('Managenews.index') }}" class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>
<!-- here this code use for the editer js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$('#description').summernote({
    tabsize: 2,
    height: 300
});
$('#meta_description').summernote({
    tabsize: 2,
    height: 300
});
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Initialize Flatpickr -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    // JavaScript to allow only today's date and future dates
    document.addEventListener('DOMContentLoaded', function () {
        const startDateInput = document.getElementById('start_date');
        const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
        startDateInput.setAttribute('min', today); // Set the min attribute to today's date
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        // Ensure end date is always after or equal to start date
        startDateInput.addEventListener('change', function () {
            const startDate = startDateInput.value;
            if (startDate) {
                // Set the min value of the end_date input to the selected start date
                endDateInput.setAttribute('min', startDate);
            } else {
                // Remove the min attribute if no start date is selected
                endDateInput.removeAttribute('min');
            }
        });
    });
</script>

@endsection