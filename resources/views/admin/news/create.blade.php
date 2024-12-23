@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<!-- here this code use for the editer css-->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<!-- here this code use end of editer css-->

 

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage News</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
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
                
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1"> English
                                    <input type="radio" name="language" value="2"> Hindi
                                </div>
                                @error('language')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="title">Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="title" id="title">
                                    @error('title')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="short_description" class="label">Short Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="short_description" id="short_description"
                                        class="form-control ps-5 text-dark"></textarea>
                                        @error('short_description')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_title">Meta Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="meta_title"
                                        id="meta_title">
                                        @error('meta_title')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_keywords">Meta Keywords :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="meta_keywords"
                                        id="meta_keywords">
                                        @error('meta_keywords')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="meta_description" class="label">Meta Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="meta_description" id="meta_description"
                                        class="form-control ps-5 text-dark"></textarea>
                                        @error('meta_description')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description" class="label">Description</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea name="description" id="description"
                                        class="form-control ps-5 text-dark"></textarea>
                                        @error('description')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="main_image" class="label">Main Image</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="main_image" id="main_image"
                                        class="form-control text-dark ps-5 h-58">
                                        @error('main_image')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="multiple_images" class="label">Upload Multiple Image</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="file" name="multiple_images[]" id="multiple_images"
                                        class="form-control text-dark ps-5 h-58" multiple>
                                        @error('multiple_images')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="start_date" class="label">Start Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" name="start_date" id="start_date"
                                        class="form-control text-dark ps-5 h-58">
                                        @error('start_date')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="end_date" class="label">End Date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" name="end_date" id="end_date"
                                        class="form-control text-dark ps-5 h-58">
                                        @error('end_date')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status">
                                        <option value="" class="text-dark" selected>Select</option>
                                        <option value="1" class="text-dark">Active</option>
                                        <option value="0" class="text-dark">Inactive</option>
                                    </select>
                                    @error('status')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                            &nbsp;
                            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary text-white">Back</a>
                        </div>

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
    placeholder: 'description...',
    tabsize: 2,
    height: 300
});
</script>  
<!-- here this code end of the editer js -->

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