@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit District</h1>
    <form action="{{ route('district.update', $districts->id) }}" method="POST">
        @csrf
        @method('post')
        <div class="form-group">
            <label for="district_name">District Name *</label>
            <input type="text" name="district_name" class="form-control" value="{{ $districts->district_name }}"required>
        </div>
        
        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $districts->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$districts->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('district.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

