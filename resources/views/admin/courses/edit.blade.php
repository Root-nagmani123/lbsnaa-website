@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Course</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Course</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-sm-0">Add New Course</h4>
                </div>
                <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1" {{ $course->language == '1' ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2" {{ $course->language == '2' ? 'checked' : '' }}> Hindi
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label class="label" for="course_name">Course Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="course_name"
                                        id="course_name" value="{{ $course->course_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label class="label" for="abbreviation">Abbreviation :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="abbreviation"
                                        id="abbreviation" value="{{ $course->abbreviation }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_title">Meta Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="meta_title"
                                        id="meta_title" value="{{ $course->meta_title }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_keyword">Meta Keyword :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="meta_keyword"
                                        id="meta_keyword" value="{{ $course->meta_keyword }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="meta_description">Meta Description:</label>
                                <div class="form-group position-relative">
                                    <textarea class="form-control" id="meta_description" placeholder="Enter the Meta Description" name="meta_description" rows="5">{{ $course->meta_description }}</textarea>
                                </div>


                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="description">Description:</label>
                                <div class="form-group position-relative">
                                    <textarea class="form-control" id="description" placeholder="Enter the Description" name="description" rows="5">{{ $course->description }}</textarea>
                                </div>


                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="course_start_date">Course Start Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark ps-5 h-58" name="course_start_date"
                                        id="course_start_date" value="{{ $course->course_start_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="course_end_date">Course End Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" class="form-control text-dark ps-5 h-58" name="course_end_date"
                                        id="course_end_date" value="{{ $course->course_end_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="support_section">Support Section :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="support_section"
                                        id="support_section" required>
                                        <option value="" class="text-dark" selected>Select Section</option>
                                        <option value="1" class="text-dark">First</option>
                                        <option value="2" class="text-dark">Second</option>
                                        <option value="3" class="text-dark">Tgird</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="coordinator_id">Coordinator ID :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="coordinator_id"
                                        id="coordinator_id" value="{{ $course->coordinator_id }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="asst_coordinator_1_id">1st Asst. Co-ordinator :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="asst_coordinator_1_id" id="asst_coordinator_1_id" value="{{ $course->asst_coordinator_1_id }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="asst_coordinator_2_id">2nd Asst. Co-ordinator :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="asst_coordinator_2_id" id="asst_coordinator_2_id" value="{{ $course->asst_coordinator_2_id }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="asst_coordinator_3_id">3rd Asst. Co-ordinator :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="asst_coordinator_3_id" id="asst_coordinator_3_id" value="{{ $course->asst_coordinator_3_id }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="asst_coordinator_4_id">4th Asst. Co-ordinator :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="asst_coordinator_4_id" id="asst_coordinator_4_id" value="{{ $course->asst_coordinator_4_id }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="asst_coordinator_5_id">5th Asst. Co-ordinator :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="asst_coordinator_5_id" id="asst_coordinator_5_id" value="{{ $course->asst_coordinator_5_id }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="label" for="important_links">Order Notes :</label>
                                <div class="form-group position-relative">
                                    <textarea class="form-control ps-5 text-dark" id="important_links"
                                        name="important_links">{{ $course->important_links }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="course_type">Course Type:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="course_type"
                                        id="course_type" required>
                                        <option value="" class="text-dark" selected>Select Type</option>
                                        <option value="1" class="text-dark">First</option>
                                        <option value="2" class="text-dark">Second</option>
                                        <option value="3" class="text-dark">Tgird</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="venue_id">Venue:</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="venue_id" id="venue_id"
                                        required>
                                        <option value="" class="text-dark" selected>Select Venue</option>
                                        <option value="1" class="text-dark">First</option>
                                        <option value="2" class="text-dark">Second</option>
                                        <option value="3" class="text-dark">Tgird</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="registration_on">Registration on :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input class="form-check-input" type="radio" value="1" id="registration_on"
                                        name="registration_on" {{ $course->registration_on == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="registration_on">
                                        On
                                    </label>
                                </div>
                                <div class="form-group position-relative">
                                    <input class="form-check-input" type="radio" value="0" id="registration_on"
                                        name="registration_on" {{ $course->registration_on == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="registration_on">
                                        Off
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="page_status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="page_status"
                                        id="page_status" required>
                                        <option value="" class="text-dark" selected>Select Status</option>
                                        <option value="1" class="text-dark"  {{ $course->page_status == 1 ? 'checked' : '' }}>Active</option>
                                        <option value="0" class="text-dark"  {{ $course->page_status == 0 ? 'checked' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button>&nbsp;
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-primary text-white fw-semibold">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin_assets/js/ckeditor.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
ClassicEditor
.create( document.querySelector( '#meta_description' ) )
.then( editor => {
window.editor = editor;
} )
.catch( error => {
console.error( error );
} );

ClassicEditor
.create( document.querySelector( '#description' ) )
.then( editor => {
window.editor = editor;
} )
.catch( error => {
console.error( error );
} );
</script>
@endsection