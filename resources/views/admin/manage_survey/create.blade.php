@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Create Survey</h2>

   
    <form action="{{ route('survey.store') }}" method="POST" enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <label for="language">Page language :</label>
            <span class="star">*</span>
            <input type="radio" name="language" value="1">English
            <input type="radio" name="language" value="2">Hindi            @error('survey_title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div> 

        <div class="form-group">
            <label for="survey_title">Survey Title </label>
            <span class="star">*</span>
            <input type="text" name="survey_title" id="survey_title" class="form-control" value="{{ old('survey_title') }}">
            @error('survey_title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="startdate">Start Date </label>
            <span class="star">*</span>
            <input type="date" name="startdate" id="startdate" class="form-control" >
            @error('startdate')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="expairydate">End Date </label>
            <span class="star">*</span>
            <input type="date" name="expairydate" id="expairydate" class="form-control" >
            @error('expairydate')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status </label>
            <span class="star">*</span>
            <select name="status" id="txt_status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            @error('txt_status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
