@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col">
        <h2>Add New Menu</h2>
        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Menu Title Field -->
            <div class="frm_row">
                <span class="label1">
                    <label for="menutitle">Menu Title :</label>
                    <span class="star">*</span>
                </span>
                <span class="input1">
                    <input type="text" name="menutitle" id="menutitle" class="form-control" required>
                </span>
                <div class="clear"></div> 
            </div>
            <!-- Menu Type Dropdown -->
            <div class="frm_row">
                <span class="label1">
                    <label for="texttype">Menu Type :</label>
                    <span class="star">*</span>
                </span>
                <span class="input1">
                    <select name="texttype" id="texttype" class="form-control" autocomplete="off"
                        onchange="addmenutype(this.value)" required>
                        <option value="">Select</option>
                        <option value="1">Content</option>
                        <option value="2">PDF file Upload</option>
                        <option value="3">Web Site Url</option>
                    </select>
                </span>
                <div class="clear"></div>
            </div>
            <!-- Additional Fields Container -->
            <div id="additional-fields" style="display: none;">
                <!-- Content Field -->
                <div class="frm_row" id="content-field" style="display: none;">
                    <span class="label1">
                        <label for="content">Content:</label>
                        <span class="star">*</span>
                    </span>
                    <span class="input1">
                        <textarea name="content" id="content" class="form-control"></textarea>
                    </span>
                    <div class="clear"></div>
                    <div class="frm_row">
                        <span class="label1">
                            <label for="meta_title">Meta Title:</label>
                            <span class="star">*</span>
                        </span>
                        <span class="input1">
                            <input type="text" name="meta_title" id="meta_title" class="form-control" >
                        </span>
                        <div class="clear"></div>
                    </div>
                    <!-- Meta Keyword Field -->
                    <div class="frm_row">
                        <span class="label1">
                            <label for="meta_keyword">Meta Keyword:</label>
                        </span>
                        <span class="input1">
                            <input type="text" name="meta_keyword" id="meta_keyword" class="form-control">
                        </span>
                        <div class="clear"></div>
                    </div>
                    <!-- Meta Description Field -->
                    <div class="frm_row">
                        <span class="label1">
                            <label for="meta_description">Meta Description:</label>
                        </span>
                        <span class="input1">
                            <textarea name="meta_description" id="meta_description" class="form-control"></textarea>
                        </span>
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- PDF File Upload Field -->
                <div class="frm_row" id="pdf-upload-field" style="display: none;">
                    <span class="label1">
                        <label for="pdf_file">Upload PDF:</label>
                        <span class="star">*</span>
                    </span>
                    <span class="input1">
                        <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept=".pdf">
                    </span>
                    <div class="clear"></div>
                </div>
                <!-- Website URL Field -->
                <div class="frm_row" id="website-url-field" style="display: none;">
                    <span class="label1">
                        <label for="website_url">Website URL:</label>
                        <span class="star">*</span>
                    </span>
                    <span class="input1">
                        <input type="text" name="website_url" id="website_url" class="form-control">
                    </span>
                    <div class="clear"></div>
                    <div class="frm_row">
                        <span class="label1">
                            <label for="web_site_target">Web Site Target :</label>
                        </span>
                        <span class="input1">
                            <select name="web_site_target" id="web_site_target" class="form-control" autocomplete="off">
                                <option value="">Select</option>
                                <option value="1">Internal Link</option>
                                <option value="2">External Link</option>
                            </select>
                        </span>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <!-- Primary Link Field with Menu Options -->
            <div class="frm_row">
                <span class="label1">
                    <label for="menucategory">Primary Link:</label>
                    <span class="star">*</span>
                </span>
                <span class="input1">
                    <select name="menucategory" id="menucategory" class="form-control">
                        <option value="0">It is Root Category</option>
                        {!! $menuOptions !!}
                        <!-- Display the options -->
                    </select>
                </span>
            </div>
            <div class="frm_row">
                <span class="label1">
                    <label for="txtpostion">Content Position:</label>
                    <span class="star">*</span>
                </span>
                <span class="input1">
                    <select name="txtpostion" id="txtpostion" class="form-control" autocomplete="off" required onchange="showDateFields(this.value)">
                        <option value="">Select</option>
                        <option value="1">Header Menu</option>
                        <option value="2">Bottom Menu</option>
                        <option value="3">Footer Menu</option>
                        <option value="4">Director Message Menu</option>
                        <option value="5">Life Academy Menu</option>
                        <option value="6">Other Pages</option>
                        <option value="7">Latest Updates</option>
                    </select>
                </span>
                <div class="clear"></div>
            </div>
            <div id="date-fields" style="display: none;">
                <div class="frm_row">
                    <span class="label1">
                        <label for="start_date">Start Date:</label>
                        <span class="star">*</span>
                    </span>
                    <span class="input1">
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="dd/mm/yyyy" required onfocus="(this.type='date')" onblur="(this.type='text')">
                    </span>
                    <div class="clear"></div>
                </div>

                <div class="frm_row">
                    <span class="label1">
                        <label for="termination_date">Termination Date:</label>
                        <span class="star">*</span>
                    </span>
                    <span class="input1">
                        <input type="text" name="termination_date" id="termination_date" class="form-control" placeholder="dd/mm/yyyy" required onfocus="(this.type='date')" onblur="(this.type='text')">
                    </span>
                    <div class="clear"></div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="frm_row">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
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