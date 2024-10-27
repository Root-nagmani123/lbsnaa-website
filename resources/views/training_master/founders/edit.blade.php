@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Edit Founder</h2>
    <form action="{{ route('founders.update', $founder->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
	        <label>Page Language:</label>
	        <div>
		        <input type="radio" name="language" value="English" {{ $founder->language == 'English' ? 'checked' : '' }}> English
		        <input type="radio" name="language" value="Hindi" {{ $founder->language == 'Hindi' ? 'checked' : '' }}> Hindi<br><br>
		    </div>
		</div>

		<div class="mb-3">
	        <label>Founder Name:</label>
	        <input type="text" name="name" class="form-control" value="{{ $founder->name }}">
	    </div> 

	    <div class="mb-3">
	        <label>Status:</label>
	        <select name="status" class="form-control">
	            <option value="active" {{ $founder->status == 'active' ? 'selected' : '' }}>Active</option>
	            <option value="inactive" {{ $founder->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
	        </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('founders.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
