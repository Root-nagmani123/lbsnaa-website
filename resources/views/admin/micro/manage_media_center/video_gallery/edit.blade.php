@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

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
                    <h4 class="fw-semibold fs-18 mb-sm-0">Edit Video Gallery</h4>
                </div>

                <form action="{{ route('micro-video-gallery.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- This will force the form to send a PUT request -->
                    <div class="row">

                    
                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label for="research_centre_id" class="label">Select Research Center</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="research_centre" id="research_centre_id" class="form-control text-dark  h-58">
                                        <option value="">Select Research Centre</option>
                                        @foreach ($researchCentres as $id => $name)
                                            <option value="{{ $id }}" {{ old('research_centre', $video->research_centre) == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('research_centre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="category_name" class="label">Category Name</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="category_name" id="category_name" class="form-control text-dark  h-58">
                                        <option value="">Select Category Name</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ (old('category_name', $video->category_name) == $category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="video_title_en">Video Title (English) :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="video_title_en"
                                        id="video_title_en" value="{{ $video->video_title_en }}">
                                    @error('video_title_en')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="video_title_hi">Audio Title (Hindi) :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="video_title_hi"
                                        id="video_title_hi" value="{{ $video->video_title_hi }}">
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="video_upload">YouTube Video Link :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="url" name="video_upload" id="video_upload" class="form-control"
                                        value="{{ $video->video_upload }}" >
                                    @error('video_upload')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="page_status">Page Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="page_status"
                                        id="page_status">
                                        <option value="1" class="text-dark"
                                            {{ $video->page_status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark"
                                            {{ $video->page_status == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="{{ route('micro-video-gallery.index') }}"
                                class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $('#category_name').change(function () {
        var categoryId = $(this).val();

        if (categoryId) {
            $.ajax({
                url: "{{ route('user.dropdowns.getResearchCentres') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { category_id: categoryId },
                success: function (response) {
                    $('#research_centre').empty().append('<option value="">Select Research Centre</option>');
                    $.each(response.data, function (key, value) {
                        $('#research_centre').append('<option value="' + key + '">' + value + '</option>');
                    });

                    @if(old('research_centre'))
                        $('#research_centre').val('{{ old('research_centre') }}');
                    @endif
                },
                error: function (xhr) {
                    alert('Error loading data.');
                }
            });
        } else {
            $('#research_centre').empty().append('<option value="">Select Research Centre</option>');
        }
    });
});


</script>
@endsection