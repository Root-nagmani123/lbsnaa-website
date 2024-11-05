@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Edit Coordinator</h4>
            </div>

                <form action="{{ route('coordinators.update', $coordinator->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="page_language">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input class="form-check-input" type="radio" name="page_language" value="english" {{ $coordinator->page_language === 'English' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="english">
                                        English
                                    </label>
                                    <input class="form-check-input" type="radio" name="page_language" value="hindi" {{ $coordinator->page_language === 'Hindi' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="hindi">
                                        Hindi
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="coordinator_name">Co-ordinators Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="coordinator_name"
                                        id="coordinator_name" value="{{ $coordinator->coordinator_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="texttype">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="status" id="status" required>
                                        <option value="1" class="text-dark" {{ $coordinator->status === '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark" {{ $coordinator->status === '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Update</button> &nbsp;
                            <a href="{{ route('coordinators.index') }}" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection
