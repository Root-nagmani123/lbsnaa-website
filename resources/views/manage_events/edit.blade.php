@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4  border-bottom">
            <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Edit Event</h4>
            </div>
                @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

                <form action="{{ route('manage_events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
        @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="page_language" class="label">Page Language</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                        <input class="form-check-input" type="radio" name="page_language" id="page_language" value="English" {{ old('language', $event->language) == 'English' ? 'checked' : '' }}> English
                                        <input class="form-check-input" type="radio" name="page_language" id="page_language" value="Hindi" {{ old('language', $event->language) == 'Hindi' ? 'checked' : '' }}> Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="event_title">Event Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="event_title" id="event_title" value="{{ old('event_title', $event->event_title) }}">
                                </div>
                                @error('event_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label" for="description">Description :</label>
                                <span class="star">*</span>
                                <div id="standalone-container">
                                    <div id="toolbar-container">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                        </span>
                                    </div>
                                    <div id="editor-container" style="height: 250px;">{{ old('description', $event->description) }}</div>
                                </div>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="course">Course :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="course" id="course" required>
                                        @foreach($courses as $course)
                                        <option class="text-dark" value="{{ $course->id }}" {{ old('course_id', $event->course_id) == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                                @error('course_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="start_date">Start Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="start_date" id="start_date" value="{{ old('start_date', $event->start_date) }}">
                                </div>
                                @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="end_date">End Date :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="end_date" id="end_date" value="{{ old('end_date', $event->end_date) }}">
                                </div>
                                @error('end_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status" required>
                                        <option value="Draft" class="text-dark" {{ old('status', $event->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="Approval" class="text-dark" {{ old('status', $event->status) == 'Approval' ? 'selected' : '' }}>Approval</option>
                                        <option value="Publish" class="text-dark" {{ old('status', $event->status) == 'Publish' ? 'selected' : '' }}>Publish</option>
                                    </select>
                                </div>
                                @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="{{ route('manage_events.index') }}" class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection

<!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->
<script>
    CKEDITOR.replace('description');
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="start_date"]').setAttribute('min', today);
        document.querySelector('input[name="end_date"]').setAttribute('min', today);
    });
</script>
