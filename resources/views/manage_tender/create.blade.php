@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>Add New Tender/Circular</h2>
    <form action="{{ route('manage_tender.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('manage_tender.form')
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="{{ route('manage_tender.index') }}" class="btn btn-danger">Cancel</a>
    </form>
@endsection
 
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="publish_date"]').setAttribute('min', today);
        document.querySelector('input[name="expiry_date"]').setAttribute('min', today);
    });
</script>