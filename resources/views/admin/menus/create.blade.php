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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Add Menu</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <h4 class="fs-18 mb-4">Add New Menu</h4>

                <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="menutitle">Page Language :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input type="radio" name="txtlanguage" value="1">English
                                        <input type="radio" name="txtlanguage" value="2">Hindi
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Menu Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="menutitle"
                                        id="menutitle">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="texttype">Menu Type :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58"
                                        aria-label="Default select example" name="texttype" id="texttype"
                                        autocomplete="off" onchange="addmenutype(this.value)" required>
                                        <option selected class="text-dark">Select</option>
                                        <option value="1" class="text-dark">Content</option>
                                        <option value="2" class="text-dark">PDF file Upload</option>
                                        <option value="3" class="text-dark">Web Site Url</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="display: none;" id="additional-fields">
                            <div class="row" id="content-field">
                                <div class="col-lg-12">
                                    <div class="form-group mb-0">
                                        <label class="label" for="content">Content :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea class="form-control ps-5 text-dark"
                                                placeholder="Some demo text ... " cols="30" rows="5" name="content"
                                                id="content"></textarea>
                                        </div>
                                    </div>
                                </div>
                               <div class="row mt-4">
                               <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="meta_title">Meta Title:</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-58" name="meta_title"
                                                id="meta_title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="meta_keyword">Meta Keyword :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-58"
                                                name="meta_keyword" id="meta_keyword">
                                        </div>
                                    </div>
                                </div>
                               </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-0">
                                        <label class="label" for="meta_description">Meta Description :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea class="form-control ps-5 text-dark"
                                                placeholder="Some demo text ... " cols="30" rows="5"
                                                name="meta_description" id="meta_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: none;" id="pdf-upload-field">
                                <div class="col-lg-12">
                                    <div class="form-group mb-0">
                                        <label class="label" for="pdf_file">Upload PDF</label>
                                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                            <div class="product-upload">
                                                <label for="file-upload" class="file-upload mb-0">
                                                    <i class="ri-upload-cloud-2-line fs-2 text-gray-light"></i>
                                                    <span class="d-block fw-semibold text-body">Drop files here or click
                                                        to upload.</span>
                                                </label>
                                                <input id="file-upload" type="file" name="pdf_file" id="pdf_file"
                                                    accept=".pdf">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="website-url-field">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="website_url">Website URL:</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-58"
                                                name="website_url" id="website_url">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="web_site_target">Web Site Target :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <select class="form-select form-control ps-5 h-58" name="web_site_target"
                                                id="web_site_target" autocomplete="off">
                                                <option selected class="text-dark">Select</option>
                                                <option value="1" class="text-dark">Internal Link</option>
                                                <option value="2" class="text-dark">External Link</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group mb-4">
                                <label class="label" for="menucategory">Primary Link :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="menucategory"
                                        id="menucategory" autocomplete="off">
                                        <option selected class="text-dark">It is Root Category</option>
                                        {!! $menuOptions !!}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group mb-4">
                                <label class="label" for="txtpostion">Content Position :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" id="txtpostion"
                                        autocomplete="off" autocomplete="off" name="txtpostion" required
                                        onchange="showDateFields(this.value)">
                                        <option selected class="text-dark">Select</option>
                                        <option value="1" class="text-dark">Header Menu</option>
                                        <option value="2" class="text-dark">Bottom Menu</option>
                                        <option value="3" class="text-dark">Footer Menu</option>
                                        <option value="4" class="text-dark">Director Message Menu</option>
                                        <option value="5" class="text-dark">Life Academy Menu</option>
                                        <option value="6" class="text-dark">Other Pages</option>
                                        <option value="7" class="text-dark">Latest Updates</option>
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
                                                name="start_date" id="start_date"  onfocus="(this.type='date')"
                                                onblur="(this.type='text')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="termination_date">Termination Date :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-58"
                                                name="termination_date" id="termination_date" placeholder="dd/mm/yyyy"
                                                 onfocus="(this.type='date')" onblur="(this.type='text')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                                <div class="form-group mb-4">
                                    <label class="label" for="menu_status">Status :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" id="menu_status" name="menu_status" required>
                                            <option class="text-dark">Select</option>
                                            <option value="1" class="text-dark" >Active</option>
                                            <option value="2" class="text-dark" >Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
        <script>
        function addmenutype(value) {
            // Hide all additional fields initially
            document.getElementById('additional-fields').style.display = 'block';
            document.getElementById('content-field').style.display = 'none';
            document.getElementById('pdf-upload-field').style.display = 'none';
            document.getElementById('website-url-field').style.display = 'none';

            // Show fields based on the selected menu type
            if (value === '1') { // Content
                document.getElementById('content-field').style.display = 'block';
            } else if (value === '2') { // PDF file upload
                document.getElementById('pdf-upload-field').style.display = 'block';
            } else if (value === '3') { // Website URL
                document.getElementById('website-url-field').style.display = 'block';
            }
        }
        function showDateFields(value) {
                const dateFields = document.getElementById('date-fields');
                if (value === '7') { // Latest Updates
                    dateFields.style.display = 'block';
                } else {
                    dateFields.style.display = 'none';
                }
            }
            
        </script>
        @endsection