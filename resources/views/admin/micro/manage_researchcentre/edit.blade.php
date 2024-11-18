@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Edit Research Centre</h2>
    <form action="{{ route('researchcentres.update', $researchCentre->id) }}" method="POST">
        @csrf
        @method('POST') <!-- Use PUT method for update -->
        
        <div class="form-group">
            <label for="language">Language:</label>
            <span class="star">*</span>
            <div>
                <input type="radio" name="language" value="1" {{ old('language', $researchCentre->language) == 1 ? 'checked' : '' }}> English
                <input type="radio" name="language" value="2" {{ old('language', $researchCentre->language) == 2 ? 'checked' : '' }}> Hindi
            </div>
            @error('language')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="research_centre_name">Research Centre Name:</label>
            <span class="star">*</span>
            <input type="text" name="research_centre_name" class="form-control" value="{{ old('research_centre_name', $researchCentre->research_centre_name) }}">
            @error('research_centre_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <span class="star">*</span>
            <textarea name="description" class="form-control">{{ old('description', $researchCentre->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <span class="star">*</span>
            <select name="status" class="form-control">
                <option value="1" {{ old('status', $researchCentre->status) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $researchCentre->status) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
