@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Edit Program</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('training-programs.update', $trainingProgram->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="col-lg-6">
            <div class="form-group mb-4">
                <label class="label" for="research_centre">Select Research Centre:</label>
                <span class="star">*</span>
                <div class="form-group position-relative">
                    <select class="form-select form-control ps-5 h-58" name="research_centre" id="research_centre" required>
                        <option value="" disabled {{ is_null($trainingProgram->research_centre) ? 'selected' : '' }}>
                            Select Research Centre
                        </option>
                        dd($researchCentres);
                        @foreach($researchCentres as $id => $name)
                            <option value="{{ $id }}" {{ (string)$trainingProgram->research_centre === (string)$id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>




        <div class="form-group">
            <label>Page Language *</label><br>
            <input type="radio" name="language" value="1" {{ $trainingProgram->language == '1' ? 'checked' : '' }} required> English
            <input type="radio" name="language" value="2" {{ $trainingProgram->language == '2' ? 'checked' : '' }}> Hindi
        </div>

        <div class="form-group">
            <label>Program Name *</label>
            <input type="text" name="program_name" class="form-control" value="{{ $trainingProgram->program_name }}" required>
        </div>

        <div class="form-group">
            <label>Venue *</label>
            <input type="text" name="venue" class="form-control" value="{{ $trainingProgram->venue }}" required>
        </div>

        <div class="form-group">
            <label>Program Co-ordinator</label>
            <input type="text" name="program_coordinator" class="form-control" value="{{ $trainingProgram->program_coordinator }}">
        </div>

        <div class="form-group">
            <label>Program Description *</label>
            <textarea name="program_description" class="form-control" required>{{ $trainingProgram->program_description }}</textarea>
        </div>

        <div class="form-group">
            <label>Start Date *</label>
            <input type="date" name="start_date" class="form-control" value="{{ $trainingProgram->start_date }}" required>
        </div>

        <div class="form-group">
            <label>End Date *</label>
            <input type="date" name="end_date" class="form-control" value="{{ $trainingProgram->end_date }}" required>
        </div>

        <div class="form-group">
            <label>Important Links</label>
            <textarea name="important_links" class="form-control">{{ $trainingProgram->important_links }}</textarea>
        </div>

        <div class="form-group">
            <label>Registration Status *</label><br>
            <input type="radio" name="registration_status" value="1" {{ $trainingProgram->registration_status == '1' ? 'checked' : '' }} required> ON
            <input type="radio" name="registration_status" value="2" {{ $trainingProgram->registration_status == '2' ? 'checked' : '' }}> OFF
        </div>

        <div class="form-group">
            <label>Page Status *</label>
            <select name="page_status" class="form-control" required>
                <option value="1" {{ $trainingProgram->page_status == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $trainingProgram->page_status == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('training-programs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4 p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Edit Training Program</h4>
        </div>
                <form action="{{ route('training-programs.update', $trainingProgram->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="language" class="label">Page Language</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="language" id="language" value="1" {{ $trainingProgram->language == '1' ? 'checked' : '' }}> English
                                    <input type="radio" name="language" id="language" value="2" {{ $trainingProgram->language == '2' ? 'checked' : '' }}> Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="program_name">Program Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" id="program_name" name="program_name" value="{{ $trainingProgram->program_name }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="venue">Venue :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" id="venue" name="venue" required value="{{ $trainingProgram->venue }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="program_coordinator">Program Co-ordinator :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" id="program_coordinator" name="program_coordinator" required value="{{ $trainingProgram->program_coordinator }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="program_description">Program Description :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea class="form-control" id="program_description" placeholder="Enter the Description" name="program_description" rows="5">{{ $trainingProgram->program_description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="start_date" class="label">start_date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" name="start_date" id="start_date" class="form-control text-dark ps-5 h-58" value="{{ $trainingProgram->start_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="end_date" class="label">end_date</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="date" name="end_date" id="end_date" class="form-control text-dark ps-5 h-58" value="{{ $trainingProgram->end_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="important_links">important_links :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <textarea class="form-control" id="important_links" placeholder="Enter the Description" name="important_links" rows="5">{{ $trainingProgram->important_links }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="registration_status" class="label">registration_status</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="registration_status" id="registration_status" value="1" {{ $trainingProgram->registration_status == '1' ? 'checked' : '' }}> ON
                                    <input type="radio" name="registration_status" id="registration_status" value="2" {{ $trainingProgram->registration_status == '2' ? 'checked' : '' }}> OFF
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="page_status">Status :</label>
                                <span class="star">*</span>
                                <select name="page_status" id="page_status" class="form-control" required>
                                    <option value="" selected>Select</option>
                                    <option value="1" {{ $trainingProgram->page_status == '1' ? 'selected' : '' }}>Draft</option>
                                    <option value="2" {{ $trainingProgram->page_status == '2' ? 'selected' : '' }}>Approval</option>
                                    <option value="3" {{ $trainingProgram->page_status == '3' ? 'selected' : '' }}>Publish</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button>
                            &nbsp;
                            <a href="{{ route('training-programs.index') }}" class="btn btn-secondary text-white">Cancel</a>
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
    ClassicEditor
    .create( document.querySelector( '#important_links' ) )
    .catch( error => {
    console.error( error );
    });
</script>

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
