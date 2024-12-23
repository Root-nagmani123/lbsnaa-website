@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Faculty</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Faculty Member</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add Faculty Member</h4>
                </div>

                <form action="{{ route('admin.faculty.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" value="1" {{ old('language') == '1' ? 'checked' : '' }}> English
                                    <input type="radio" name="language" value="2" {{ old('language') == '2' ? 'checked' : '' }}> Hindi
                                </div>
                                @error('language')
                                    <div style="color: red;">{{ $message }}</div>  <!-- Display error if any -->
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="category">Category :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="category" id="category">
                                        <option value="" class="text-dark" selected>Select Category</option>
                                        <option value="1" class="text-dark" {{ old('category') == '1' ? 'checked' : '' }}>Inhouse</option>
                                        <option value="0" class="text-dark" {{ old('category') == '0' ? 'checked' : '' }}>Visiting</option>
                                    </select>
                                    @error('category')
                                    <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="name">Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="name" id="name" value="{{ old('name')}}">
                                    @error('name')
                                    <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="name_in_hindi">Name in Hindi :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="name_in_hindi"
                                        id="name_in_hindi" value="{{ old('name_in_hindi')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="email">Email :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="email" class="form-control text-dark ps-5 h-58" name="email"
                                        id="email" value="{{ old('email')}}">
                                    @error('email')
                                    <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="image">Upload Image :</label>
                                <div class="form-group position-relative">
                                    <input type="file" class="form-control text-dark ps-5 h-58" name="image" id="image" value="{{ old('image')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description" class="label">Description</label>
                                <div class="form-group position-relative">
                                    <textarea name="description" id="description"
                                        class="form-control ps-5 text-dark" value="{{ old('description')}}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="description_in_hindi" class="label">Description in Hindi</label>
                                <div class="form-group position-relative">
                                    <textarea name="description_in_hindi" id="description_in_hindi"
                                        class="form-control ps-5 text-dark" value="{{ old('description_in_hindi')}}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="designation">Designation :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="designation"
                                        id="designation" value="{{ old('designation')}}">
                                    @error('designation')
                                    <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="designation_in_hindi">Designation in Hindi :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="designation_in_hindi" id="designation_in_hindi" value="{{ old('designation_in_hindi')}}">
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="cadre">Cadre :</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="cadre" id="cadre">
                                        <option value="" class="text-dark">Select Cadre</option>
                                        @foreach ($cadres as $id => $code)
                                            <option value="{{ $id }}" class="text-dark">{{ $code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="batch">Batch :</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="batch" id="batch">
                                        <option value="" class="text-dark">Select Batch</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="service">Service :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="service"
                                        id="service" value="{{ old('service')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="country_code">Country Code :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="country_code"
                                        id="country_code" value="{{ old('country_code')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="std_code">STD Code :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="std_code"
                                        id="std_code" value="{{ old('std_code')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_internal_office">Phone Internal Office :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="phone_internal_office" id="phone_internal_office" value="{{ old('phone_internal_office')}}">
                                    @error('phone_internal_office')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_internal_residence">Phone Internal Residence :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="phone_internal_residence" id="phone_internal_residence" value="{{ old('phone_internal_residence')}}">
                                    @error('phone_internal_residence')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_pt_office">Phone P&T Office :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="phone_pt_office"
                                        id="phone_pt_office" value="{{ old('phone_pt_office')}}">
                                    @error('phone_pt_office')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="phone_pt_residence">Phone P&T Residence :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="phone_pt_residence" id="phone_pt_residence" value="{{ old('phone_pt_residence')}}">
                                    @error('phone_pt_residence')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="mobile">Mobile :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="mobile"
                                        id="mobile" value="{{ old('mobile')}}">
                                    @error('mobile')
                                        <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="abbreviation">Abbreviation :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="abbreviation"
                                        id="abbreviation" value="{{ old('abbreviation')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="rank">Rank :</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="rank" id="rank">
                                        <option value="1" class="text-dark">1</option>
                                        <option value="2" class="text-dark">2</option>
                                        <option value="3" class="text-dark">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="present_at_station">Present at Station :</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="present_at_station"
                                        id="present_at_station" value="{{ old('category')}}">
                                        <option value="1" class="text-dark">Yes</option>
                                        <option value="0" class="text-dark">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="acm_member">ACM Member :</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="acm_member" id="acm_member">
                                        <option value="1" class="text-dark">Yes</option>
                                        <option value="0" class="text-dark">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="acm_status_in_committee">ACM Status in Committee :</label>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58"
                                        name="acm_status_in_committee" id="acm_status_in_committee" value="{{ old('acm_status_in_committee')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="co_opted_member">Co-Opted Member :</label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="co_opted_member"
                                        id="co_opted_member">
                                        <option value="1" class="text-dark">Yes</option>
                                        <option value="0" class="text-dark">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="page_status">Page Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="page_status"
                                        id="page_status">
                                        <option value="" class="text-dark" selected>Select</option>
                                        <option value="1" class="text-dark">Active</option>
                                        <option value="0" class="text-dark">Inactive</option>
                                    </select>
                                    @error('page_status')
                                    <div style="color: red;">{{ $message }}</div> <!-- Display error if any -->
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>&nbsp;
                            <a href="{{ route('admin.faculty.index') }}"
                                class="btn btn-secondary text-white fw-semibold">Back</a>
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
$('#description_in_hindi').summernote({
    tabsize: 2,
    height: 300
});
</script>  
<!-- here this code end of the editer js -->

@endsection