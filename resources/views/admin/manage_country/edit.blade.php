@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Country</h1>
    <form action="{{ route('country.update', $country->id) }}" method="POST">
        @csrf
        @method('post')
        <div class="form-group">
            <label for="country_name">Country Name *</label>
            <input type="text" name="country_name" class="form-control" value="{{ $country->country_name }}"required>
        </div>
        
        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $country->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$country->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('country.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

