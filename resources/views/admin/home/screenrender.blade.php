@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Screen Render</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Screen Render</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0"> Screen Render</h4>
                </div>
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form action="{{ route('screenrender.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="heading" class="label">Heading</label>
                        <input type="text" name="heading" id="heading" class="form-control"
                            value="{{ old('heading', $screenRender->heading) }}">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="label">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title', $screenRender->title) }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="label">Description</label>
                        <textarea name="description" id="description" class="form-control"
                            rows="5">{{ old('description', $screenRender->description) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success text-white fw-semibold">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- here this code use for the editer js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$('#description').summernote({
    tabsize: 2,
    height: 300
});
</script>

@endsection