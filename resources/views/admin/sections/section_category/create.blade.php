@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Organization Module</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Sections</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Create Section Category</h4>
                </div>
                <form action="{{ route('admin.section_category.store') }}" method="POST">
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
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="name" class="label">Name</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" name="name" class="form-control text-dark  h-58" required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="section_id" value="{{ $id }}">
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="descripption" class="label">Description</label>
                                <div class="form-group position-relative">
                                    <textarea name="description" class="form-control  text-dark" id="descripption"
                                        rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="officer_incharge" class="label">Officer Incharge</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="officer_Incharge" id="officer_Incharge" class="form-control">
                                        <option value="">Select Officer Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}">
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_incharge_1st" class="label">Alternative Incharge 1st</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" name="alternative_incharge_1st" class="form-control text-dark  h-58"> -->
                                    <select name="alternative_incharge_1st" id="alternative_incharge_1st"
                                        class="form-control">
                                        <option value="">Select  Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}">
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_incharge_2st" class="label">Alternative Incharge 2nd</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" name="alternative_incharge_2st" class="form-control text-dark  h-58"> -->
                                    <select name="alternative_incharge_2st" id="alternative_incharge_2st"
                                        class="form-control">
                                        <option value="">Select  Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}">
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_incharge_3st" class="label">Alternative Incharge 3rd</label>
                                <div class="form-group position-relative">
                                    <!-- <input type="text" name="alternative_incharge_3st" class="form-control text-dark  h-58"> -->
                                    <select name="alternative_incharge_3st" id="alternative_incharge_3st"
                                        class="form-control">
                                        <option value="">Select  Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}">
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_incharge_4st" class="label">Alternative Incharge 4th</label>
                                <div class="form-group postion-relative">
                                    <!-- <input type="text" name="alternative_incharge_4st" class="form-control text-dark  h-58"> -->
                                    <select name="alternative_incharge_4st" id="alternative_incharge_4st"
                                        class="form-control">
                                        <option value="">Select  Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}">
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="alternative_incharge_5st" class="label">Alternative Incharge 5th</label>
                                <div class="form-group postion-relative">
                                    <!-- <input type="text" name="alternative_incharge_5st" class="form-control text-dark  h-58"> -->
                                    <select name="alternative_incharge_5st" id="alternative_incharge_5st"
                                        class="form-control">
                                        <option value="">Select  Incharge</option>
                                        @foreach ($officers as $officer)
                                        <option value="{{ $officer->email }}">
                                            {{ $officer->name }} {{-- Replace "name" with the actual column name --}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="section_head" class="label">Section Head</label>
                                <div class="form-group postion-relative">
                                    <input type="text" name="section_head" class="form-control text-dark  h-58">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_internal_office" class="label">Phone Internal Office</label>
                                <div class="form-group postion-relative">
                                    <input type="text" name="phone_internal_office"
                                        class="form-control text-dark  h-58">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_internal_residence" class="label">Phone Internal Residence</label>
                                <div class="form-group postion-relative">
                                    <input type="text" name="phone_internal_residence"
                                        class="form-control text-dark  h-58">
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_p_t_office" class="label">Phone P&T Office</label>
                                <div class="form-group postion-relative">
                                    <input type="text" name="phone_p_t_office" class="form-control text-dark  h-58">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="phone_p_t_residence" class="label">Phone P&T Residence</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="phone_p_t_residence"
                                        class="form-control text-dark  h-58">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="fax" class="label">Fax</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="fax" class="form-control text-dark  h-58">
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="email" class="label">Email</label>
                                <div class="form-group position-relative">
                                    <input type="email" name="email" class="form-control text-dark  h-58">
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="status" class="label">Status</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="status" class="form-control text-dark  h-58" required>
                                        <option value="" class="text-dark" selected>Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>&nbsp;
                            <a href="{{ route('admin.section_category', ['catid' => $id]) }}"
                                class="btn btn-secondary text-white">Back</a>
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
$('#descripption').summernote({
    tabsize: 2,
    height: 300,
    toolbar: [
        ['style', ['style']], // Heading styles (e.g., H1, H2)
        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript',
        'clear']], // Font options
        ['fontname', ['fontname']], // Font family selector
        ['fontsize', ['fontsize']], // Font size selector
        ['color', ['color']], // Font and background color
        ['para', ['ul', 'ol', 'paragraph', 'align']], // Lists and alignment
        ['height', ['height']], // Line height adjustment
        ['table', ['table']], // Table insertion
        ['insert', ['link', 'picture', 'video', 'hr']], // Insert elements
        ['view', ['fullscreen', 'codeview', 'help']], // Fullscreen, code view, and help
        ['misc', ['undo', 'redo']] // Undo and redo actions
    ]
});
</script>
<!-- here this code end of the editer js -->
@endsection