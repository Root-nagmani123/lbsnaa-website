@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1>Add Organiser</h1>

    <form action="{{ route('organisers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Page Language:</label><br>
            <input type="radio" name="language" value="english" required> English<br>
            <input type="radio" name="language" value="hindi" required> Hindi
        </div>

        <div class="form-group">
            <label for="organiser_name">Organiser Name:</label>
            <input type="text" class="form-control" id="organiser_name" name="organiser_name" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-warning">Reset</button>
        <a href="{{ route('organisers.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
