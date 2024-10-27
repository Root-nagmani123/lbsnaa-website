@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1>Edit Organiser</h1>

    <form action="{{ route('organisers.update', $organiser->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Page Language:</label><br>
            <input type="radio" name="language" value="english" {{ $organiser->language == 'english' ? 'checked' : '' }} required> English<br>
            <input type="radio" name="language" value="hindi" {{ $organiser->language == 'hindi' ? 'checked' : '' }} required> Hindi
        </div>

        <div class="form-group">
            <label for="organiser_name">Organiser Name:</label>
            <input type="text" class="form-control" id="organiser_name" name="organiser_name" value="{{ $organiser->organiser_name }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active" {{ $organiser->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $organiser->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('organisers.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
