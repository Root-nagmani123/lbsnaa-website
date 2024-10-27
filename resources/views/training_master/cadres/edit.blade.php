@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Edit Cadre</h2>

<form action="{{ route('cadres.update', $cadre->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
    	<label for="page_language">Page Language:</label>
    	<div>
		    <input type="radio" name="language" value="English" {{ $cadre->language == 'English' ? 'checked' : '' }}> English
		    <input type="radio" name="language" value="Hindi" {{ $cadre->language == 'Hindi' ? 'checked' : '' }}> Hindi
    	</div>
    </div>

	<div class="mb-3">
	    <label for="cadres_code">Cadres Code:</label><br>
	    <input type="text" name="code" class="form-control" value="{{ $cadre->code }}">
    </div>

    <div class="mb-3">
	    <label for="cadres_desc">Cadres Desc:</label><br>
	    <input type="text" name="description" class="form-control" value="{{ $cadre->description }}" required>
    </div>

    <div class="mb-3">
	    <label for="status">Status:</label><br>
	    <select name="status" class="form-control" required>
	        <option value="active" {{ $cadre->status == 'active' ? 'selected' : '' }}>Active</option>
	        <option value="inactive" {{ $cadre->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
	    </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('cadres.index') }}" class="btn btn-danger">Cancel</a>
</form>
</div>
@endsection 
