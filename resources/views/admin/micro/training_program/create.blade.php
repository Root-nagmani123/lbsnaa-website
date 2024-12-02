@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Training Program</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('Managenews.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Training Program - Micro</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">Add Training Program</h4>
            </div>
            <form action="{{ route('training-programs.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="language" class="label">Page Language</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="radio" name="language" value="1" id="language_english"
                                    {{ old('language') == '1' ? 'checked' : '' }}>
                                <label for="language_english">English</label>

                                <input type="radio" name="language" value="2" id="language_hindi"
                                    {{ old('language') == '2' ? 'checked' : '' }}>
                                <label for="language_hindi">Hindi</label>
                            </div>
                            @error('language')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="research_centre_id" class="label">Select Research Centre</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="research_centre" id="research_centre_id"
                                    class="form-control text-dark ps-5 h-58">
                                    <option value="">Select Research Centre</option>
                                    @foreach ($researchCentres as $id => $name)
                                    <option value="{{ $id }}" {{ old('research_centre') == $id ? 'selected' : '' }}>
                                        {{ $name }}</option>
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
                            <label for="program_name" class="label">Program Name</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="program_name" class="form-control text-dark ps-5 h-58"
                                    value="{{ old('program_name') }}">
                                @error('program_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="venue" class="label">Venue</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="venue" class="form-control text-dark ps-5 h-58"
                                    value="{{ old('venue') }}">
                                @error('venue')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="program_coordinator" class="label">Program Coordinator</label>
                            <div class="form-group position-relative">
                                <input type="text" name="program_coordinator" class="form-control text-dark ps-5 h-58"
                                    value="{{ old('program_coordinator') }}">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="program_description" class="label">Program Description</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="text" name="program_description" class="form-control text-dark ps-5 h-58"
                                    value="{{ old('program_description') }}">
                                @error('program_description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="start_date" class="label">Start Date</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="date" name="start_date" class="form-control text-dark ps-5 h-58"
                                    value="{{ old('start_date') }}">
                                @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="end_date" class="label">End Date</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="date" name="end_date" class="form-control text-dark ps-5 h-58"
                                    value="{{ old('end_date') }}">
                                @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="important_links" class="label">Important Links</label>
                            <div class="form-group position-relative">
                                <input type="text" name="important_links" class="form-control text-dark ps-5 h-58"
                                    value="{{ old('important_links') }}">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="registration_status" class="label">Registration Status</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="registration_status" id="registration_status"
                                    class="form-control text-dark ps-5 h-58">
                                    <option value="" selected>Select</option>
                                    <option value="1" class="text-dark"
                                        {{ old('registration_status') == '1' ? 'selected' : '' }}>On</option>
                                    <option value="2" class="text-dark"
                                        {{ old('registration_status') == '2' ? 'selected' : '' }}>Off</option>
                                </select>
                                @error('registration_status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label for="page_status" class="label">Status</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <select name="page_status" class="form-control">
                                    <option value="" class="text-dark" selected>Select</option>
                                    <option value="1" class="text-dark"
                                        {{ old('page_status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" class="text-dark"
                                        {{ old('page_status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('page_status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="d-flex ms-sm-3 ms-md-0">
                        <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                        &nbsp;
                        <a href="{{ route('training-programs.index') }}" class="btn btn-secondary text-white">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    let today = new Date().toISOString().split('T')[0];

    const startDateInput = document.querySelector('input[name="start_date"]');
    const endDateInput = document.querySelector('input[name="end_date"]');

    // Set min date for both start and end date on page load
    startDateInput.setAttribute('min', today);
    endDateInput.setAttribute('min', today);

    // Update end date min whenever start date is changed
    startDateInput.addEventListener('change', function() {
        endDateInput.setAttribute('min', this.value);
    });
});
</script>