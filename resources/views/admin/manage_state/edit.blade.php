@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1>Edit State</h1>
    <form action="{{ route('state.update', $states->id) }}" method="POST">
        @csrf
        @method('post')
        <div class="form-group">
            <label for="state_name">State Name *</label>
            <input type="text" name="state_name" class="form-control" value="{{ $states->state_name }}"required>
        </div>
        
        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $states->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$states->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('state.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

