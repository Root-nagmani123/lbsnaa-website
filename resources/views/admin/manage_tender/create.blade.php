@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <h2>Add New Tender/Circular</h2>
                <form action="{{ route('manage_tender.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.manage_tender.form')
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <a href="{{ route('manage_tender.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="publish_date"]').setAttribute('min', today);
        document.querySelector('input[name="expiry_date"]').setAttribute('min', today);
    });
</script>