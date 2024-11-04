@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Add Venue</h2>

    <form action="{{ route('venues.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="page_language">Page Language:</label>
            <input type="radio" name="page_language" value="English"> English
            <input type="radio" name="page_language" value="Hindi"> Hindi
        </div>
        <div>
            <label for="venue_title">Venue Title:</label>
            <input type="text" name="venue_title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="venue_detail">Venue Detail:</label>
            <textarea name="venue_detail"  class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="status">Status:</label>
            <select name="status" class="form-control" required>
                <option value="1">Active</option>
                <option value="2">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-warning">Reset</button>
        <a href="{{ route('venues.index') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
    </form>
</div>
@endsection