@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Edit Survey</h2>

    {{-- Form for editing the survey --}}
    <form action="{{ route('survey.update', $survey->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="survey_title">Survey Title </label>
            <span class="star">*</span>
            <input type="text" name="survey_title" id="survey_title" class="form-control" value="{{ old('survey_title', $survey->survey_title) }}">
            @error('survey_title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="startdate">Start Date </label>
            <span class="star">*</span>
            <input type="date" name="startdate" id="startdate" class="form-control" value="{{ old('startdate', $survey->start_date) }}">
            @error('startdate')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="expairydate">End Date </label>
            <span class="star">*</span>
            <input type="date" name="expairydate" id="expairydate" class="form-control" value="{{ old('expairydate', $survey->end_date) }}">
            @error('expairydate')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status </label>
            <span class="star">*</span>
            <select name="status" id="txt_status" class="form-control">
                <option value="">Select</option>
                <option value="1" {{ $survey->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $survey->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('txt_status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
