@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Founder</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Founders</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">Add Founders</h4>
            </div>

                <form action="{{ route('founders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label class="label" for="menutitle">Page Language :</label>
                            <span class="star">*</span>
                            <div class="form-group position-relative">
                                <input type="radio" name="language" value="1" {{ old('language') == '1' ? 'checked' : '' }}>English
                                <input type="radio" name="language" value="2" {{ old('language') == '2' ? 'checked' : '' }}>Hindi
                            </div>
                            @error('language')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                       
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="name">Founder Name :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark  h-58" name="name"
                                        id="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="label" for="texttype">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control  h-58" name="status" id="status">
                                    <option value="" class="text-dark" selected>Select</option>
                                        <option value="1" class="text-dark" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" class="text-dark" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button> &nbsp;
                            <a href="{{ route('founders.index') }}" class="btn btn-secondary text-white">Back</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection
