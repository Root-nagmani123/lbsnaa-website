@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h2>Add New Slider</h2>
<form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="research_centre_id">Select Research Centre *</label>
        <select name="research_centre" id="research_centre_id" class="form-control" required>
            <option value="">Select Research Centre</option>
            @foreach ($researchCentres as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    
    <div class="form-group">
        <label>Page Language *</label><br>
        <input type="radio" name="language" value="1" required> English
        <input type="radio" name="language" value="2"> Hindi
    </div>
    
    <div class="form-group">
        <label for="slider_image">Slider Image *</label>
        <input type="file" name="slider_image" id="slider_image" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="slider_text">Slider Text *</label>
        <input type="text" name="slider_text" id="slider_text" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="slider_description">Slider Description *</label>
        <textarea name="slider_description" id="slider_description" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="status">Status *</label>
        <select name="status" id="status" class="form-control" required>
            <option value="1">Draft</option>
            <option value="2">Approval</option>
            <option value="3">Publish</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
    <a href="{{ route('slider.index') }}" class="btn btn-danger">Cancel</a>
</form>
@endsection
