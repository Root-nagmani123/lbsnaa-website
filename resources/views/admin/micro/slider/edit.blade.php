@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h2>Edit Slider</h2>
<form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label" for="research_centre">Select Research Centre:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <select class="form-select form-control ps-5 h-58" name="research_centre" id="research_centre" required>
                    <option value="" disabled {{ is_null($slider->research_centre) ? 'selected' : '' }}>
                        Select Research Centre
                    </option>
                    @foreach($researchCentres as $id => $name)
                        <option value="{{ $id }}" {{ (string)$slider ->research_centre === (string)$id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="language">Page Language</label>
        <input type="radio" name="language" value="1" {{ $slider->language == '1' ? 'checked' : '' }}> English
        <input type="radio" name="language" value="2" {{ $slider->language == '2' ? 'checked' : '' }}> Hindi
    </div>
    
    <div class="form-group">
        <label for="slider_image">Slider Image *</label>
        <input type="file" name="slider_image" id="slider_image" class="form-control">
        <img src="{{ asset('storage/' . $slider->slider_image) }}" alt="Current Image" width="150" class="mt-2">
    </div>
    <div class="form-group mt-3">
        <label for="slider_text">Slider Text *</label>
        <input type="text" name="slider_text" id="slider_text" class="form-control" value="{{ $slider->slider_text }}" required>
    </div>
    <div class="form-group mt-3">
        <label for="slider_description">Slider Description *</label>
        <textarea name="slider_description" id="slider_description" class="form-control" required>{{ $slider->slider_description }}</textarea>
    </div>
    <div class="form-group mt-3">
        <label for="status">Status *</label>
        <select name="status" id="status" class="form-control" required>
            <option value="1" {{ $slider->status == '1' ? 'selected' : '' }}>Draft</option>
            <option value="2" {{ $slider->status == '2' ? 'selected' : '' }}>Approval</option>
            <option value="3" {{ $slider->status == '3' ? 'selected' : '' }}>Publish</option>
        </select>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('slider.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
@endsection
