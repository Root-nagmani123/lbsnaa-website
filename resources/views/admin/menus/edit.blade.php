@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Menu</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Edit Menu</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Edit Menu</h4>
                    </div>

                    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Use PUT method for updating -->

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group mb-4">
                                    <label class="label" for="txtlanguage">Page Language :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="radio" name="txtlanguage" value="1" {{ $menu->language == '1' ? 'checked' : '' }}> English
                                        <input type="radio" name="txtlanguage" value="2"{{ $menu->language == '2' ? 'checked' : '' }}> Hindi
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group mb-4">
                                    <label class="label" for="menutitle">Menu Title :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-58" name="menutitle"
                                            id="menutitle" value="{{ $menu->menutitle }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group mb-4">
                                    <label class="label" for="texttype">Menu Type :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" name="texttype" id="texttype"
                                            required>
                                            <option class="text-dark">Select</option>
                                            <option value="1" class="text-dark"
                                                {{ $menu->texttype == 1 ? 'selected' : '' }}>Content</option>
                                            <option value="2" class="text-dark"
                                                {{ $menu->texttype == 2 ? 'selected' : '' }}>PDF file Upload</option>
                                            <option value="3" class="text-dark"
                                                {{ $menu->texttype == 3 ? 'selected' : '' }}>Web Site Url</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="content-field"
                                style="display: {{ $menu->texttype == 1 ? 'block' : 'none' }};">
                                <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label" for="content">Content :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea class="form-control ps-5 text-dark"
                                                placeholder="Some demo text ... " cols="30" rows="5" name="content"
                                                id="content">{{ $menu->content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="meta_title">Meta Title:</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-58"
                                                name="meta_title" id="meta_title" value="{{ $menu->meta_title }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="meta_keyword">Meta Keyword :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-58"
                                                name="meta_keyword" id="meta_keyword" value="{{ $menu->meta_keyword }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label" for="meta_description">Meta Description :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea class="form-control ps-5 text-dark"
                                                placeholder="Some demo text ... " cols="30" rows="5"
                                                name="meta_description"
                                                id="meta_description">{{ $menu->meta_description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-6" id="pdf-upload-field"
                                style="display: {{ $menu->texttype == 2 ? 'block' : 'none' }};">
                                <div class="form-group mb-4">
                                    <label class="label" for="pdf-upload-field">Upload PDF</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                    <input id="pdf-upload-field" type="file" name="pdf_file" accept=".pdf" class="form-control text-dark ps-5 h-58">
                                            <p>Current File: <a href="{{ asset($menu->pdf_file) }}"
                                                    target="_blank">{{ $menu->pdf_file }}</a></p>
                                    </div>
                                </div>
                            </div>
                            <div id="website-url-field" style="display: {{ $menu->texttype == 3 ? 'block' : 'none' }};">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label class="label" for="website_url">Website URL:</label>
                                            <span class="star">*</span>
                                            <div class="form-group position-relative">
                                                <input type="text" class="form-control text-dark ps-5 h-58"
                                                    name="website_url" id="website_url"
                                                    value="{{ $menu->website_url }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label class="label" for="web_site_target">Web Site Target :</label>
                                            <span class="star">*</span>
                                            <div class="form-group position-relative">
                                                <select class="form-select form-control ps-5 h-58"
                                                    name="web_site_target" id="web_site_target" autocomplete="off">
                                                    <option class="text-dark"
                                                        {{ $menu->menucategory == 0 ? 'selected' : '' }}>It is Root
                                                        Category
                                                    </option>
                                                    {!! $menuOptions !!}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="menucategory">Primary Link :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" name="menucategory"
                                            id="menucategory" autocomplete="off">
                                            <option selected value="0" class="text-dark">It is Root Category</option>
                                            {!! $menuOptions !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="txtpostion">Content Position :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" id="txtpostion"
                                            name="txtpostion" required>
                                            <option class="text-dark">Select</option>
                                            <option value="1" class="text-dark"
                                                {{ $menu->txtpostion == 1 ? 'selected' : '' }}>Header Menu</option>
                                            <option value="2" class="text-dark"
                                                {{ $menu->txtpostion == 2 ? 'selected' : '' }}>Bottom Menu</option>
                                            <option value="3" class="text-dark"
                                                {{ $menu->txtpostion == 3 ? 'selected' : '' }}>Footer Menu</option>
                                            <option value="4" class="text-dark"
                                                {{ $menu->txtpostion == 4 ? 'selected' : '' }}>Director Message Menu
                                            </option>
                                            <option value="5" class="text-dark"
                                                {{ $menu->txtpostion == 5 ? 'selected' : '' }}>Life Academy Menu
                                            </option>
                                            <option value="6" class="text-dark"
                                                {{ $menu->txtpostion == 6 ? 'selected' : '' }}>Other Pages</option>
                                            <option value="7" class="text-dark"
                                                {{ $menu->txtpostion == 7 ? 'selected' : '' }}>Latest Updates</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="date-fields" style="display: none;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label class="label" for="start_date">Start Date:</label>
                                            <span class="star">*</span>
                                            <div class="form-group position-relative">
                                                <input type="date" class="form-control text-dark ps-5 h-58"
                                                    name="start_date" id="start_date" value="{{ $menu->start_date }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label class="label" for="termination_date">Termination Date :</label>
                                            <span class="star">*</span>
                                            <div class="form-group position-relative">
                                                <input type="text" class="form-control text-dark ps-5 h-58"
                                                    name="termination_date" id="termination_date"
                                                    value="{{ $menu->termination_date }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="menu_status">Status :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" id="menu_status"
                                            name="menu_status" required>
                                            <option value="1" class="text-dark"
                                                {{ $menu->menu_status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" class="text-dark"
                                                {{ $menu->menu_status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex ms-sm-3 ms-md-0">
                                <button class="btn btn-success text-white fw-semibold"
                                    type="submit">Update</button>&nbsp;
                                <a href="{{ route('admin.menus.index') }}"
                                    class="btn btn-secondary text-white">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- here this code use for the editer js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$('#content').summernote({
    tabsize: 2,
    height: 300
});
$('#meta_description').summernote({
    tabsize: 2,
    height: 300
});
</script>  
<!-- here this code end of the editer js -->
<script>
document.getElementById('texttype').addEventListener('change', function() {
    const value = this.value;
    document.getElementById('content-field').style.display = value === '1' ? 'block' : 'none';
    document.getElementById('pdf-upload-field').style.display = value === '2' ? 'block' : 'none';
    document.getElementById('website-url-field').style.display = value === '3' ? 'block' : 'none';
});
</script>
@endsection