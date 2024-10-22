@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Add New Slider</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.slider_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="image">Slider Image:</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            <div class="form-group mb-3">
                <label for="text">Slider Text:</label>
                <input type="text" class="form-control" name="text" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Slider Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Add Slider</button>
        </form>
    </div>
</div>
@endsection