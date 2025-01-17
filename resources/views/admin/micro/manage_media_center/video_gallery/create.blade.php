@extends('admin.layouts.master')
@section('title', 'Add Video Gallery')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Center</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Video Gallery</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div
                    class="d-sm-flex text-center justify-content-between align-items-center mb-4 border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-sm-0">Add Video Gallery</h4>
                </div>

                <form action="{{ route('micro-video-gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="select_research_centre" class="label">Select Research Centre:</label>
                                <span class="star">*</span>
                                <select id="select_research_centre" name="research_centre" class="form-control h-58 text-dark">
                                    <option value="" selected>Select Research Centre</option>
                                    @foreach ($researchCentres as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('research_centre')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="category_name" class="label">Media Category:</label>
                                <span class="star">*</span>
                                <select name="category_name" id="category_name" class="form-control h-58 text-dark">
                                    <option value="" selected>Select Media Category</option>
                                </select>
                                @error('category_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="video_title_en" class="label">Video Title (English) :</label>
                                <span class="star">*</span>
                                <input type="text" name="video_title_en" id="video_title_en" class="form-control h-58 text-dark"
                                    value="{{ old('video_title_en') }}">
                                @error('video_title_en')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="video_title_hi" class="label">Video Title (Hindi) :</label>
                                <input type="text" name="video_title_hi" id="video_title_hi" class="form-control h-58 text-dark"
                                    value="{{ old('video_title_hi') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="video_upload" class="label">YouTube Video Link :</label>
                                <span class="star">*</span>
                                <input type="url" name="video_upload" id="video_upload" class="form-control h-58 text-dark"
                                    value="{{ old('video_upload') }}" placeholder="Enter YouTube video URL">
                                @error('video_upload')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="page_status" class="label">Page Status :</label>
                                <span class="star">*</span>
                                <select name="page_status" id="page_status" class="form-control h-58 text-dark">
                                    <option value="" class="text-dark" selected>Select</option>
                                    <option value="1" {{ old('page_status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('page_status') == '0' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('page_status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button> &nbsp;
                            <a href="{{ route('micro-video-gallery.index') }}"
                                class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#category_name').change(function() {
        var categoryId = $(this).val();

        if (categoryId) {
            $.ajax({
                url: "{{ route('user.dropdowns.getResearchCentres') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category_id: categoryId
                },
                success: function(response) {
                    $('#research_centre').empty().append(
                        '<option value="">Select Research Centre</option>');
                    $.each(response.data, function(key, value) {
                        $('#research_centre').append('<option value="' + key +
                            '">' + value + '</option>');
                    });

                    @if(old('research_centre'))
                    $('#research_centre').val('{{ old('
                        research_centre ') }}');
                    @endif
                },
                error: function(xhr) {
                    alert('Error loading data.');
                }
            });
        } else {
            $('#research_centre').empty().append('<option value="">Select Research Centre</option>');
        }
    });
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#select_research_centre').on('change', function() {
        const researchCentreId = $(this).val();
        // alert(researchCentreId);

        $('#category_name').html('<option value="" selected>Select Media Category</option>');

        if (researchCentreId) {
            $.ajax({
                url: "{{ route('fetchMediaCategoriesvideo') }}",
                type: "GET",
                data: {
                    research_centre_id: researchCentreId
                },
                success: function(data) {
                    if (data.length > 0) {
                        data.forEach(function(category) {
                            $('#category_name').append(
                                `<option value="${category.id}">${category.name}</option>`
                            );
                        });
                    }
                },
                error: function() {
                    alert('Failed to fetch media categories. Please try again.');
                }
            });
        }
    });
});
</script>