@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Add Founders</h2>
    <form action="{{ route('founders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="language">Page Language:</label>
            <div>
                <label><input type="radio" name="language" value="English" required> English</label>
                <label><input type="radio" name="language" value="Hindi" required> Hindi</label>
                <!-- Add more languages as needed -->
            </div>
        </div>

        <div class="mb-3">
	        <label>Founder Name:</label>
	        <input type="text" name="name"  class="form-control" required>
    	</div>

    	<div class="mb-3">
	        <label>Status:</label>
	        <select name="status"  class="form-control" required>
	            <option value="1">Active</option>
	            <option value="2">Inactive</option>
	        </select>
	    </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-warning">Reset</button>
        <a href="{{ route('founders.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
