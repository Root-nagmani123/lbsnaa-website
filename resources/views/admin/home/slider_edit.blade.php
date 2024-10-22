@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Edit Slider</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.slider_update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="image">Slider Image:</label>
                <input type="file" class="form-control" name="image">
                <small>Current Image:</small> <img src="{{ asset('slider-images/' . $slider->image) }}" width="100">
            </div>

            <div class="form-group mb-3">
                <label for="text">Slider Text:</label>
                <input type="text" class="form-control" name="text" value="{{ $slider->text }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Slider Description:</label>
                <textarea name="description" class="form-control" required>{{ $slider->description }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $slider->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$slider->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Slider</button>
        </form>
    </div>
</div>
@endsection