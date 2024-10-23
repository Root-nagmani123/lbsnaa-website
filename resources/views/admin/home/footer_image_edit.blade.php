@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col">
        <h2>Edit Footer Image</h2>
        <form action="{{ route('admin.footer_images.update', $footerImage->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image">
                <img src="{{ asset('footer-images/' . $footerImage->image) }}" width="100" class="mt-3">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="checkbox" name="status" value="1" {{ $footerImage->status ? 'checked' : '' }}>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
