@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('admin.index') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.menus.index') }}" class="text-decoration-none">
                    <i class="ri-arrow-right-double-line"></i>
                    <span>Newsletter</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Add Newsletter</span>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Add Newsletter</h4>
                    </div>
                    <form action="{{ route('admin.newsletter.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($newsletter)
                            <input type="hidden" name="id" value="{{ $newsletter->id }}">
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="menutitle">Page Language :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input 
                                            type="radio" 
                                            name="txtlanguage" 
                                            value="1"
                                            @if(old('txtlanguage') == 1) checked @elseif(!empty($newsletter->language) && $newsletter->language == 1) checked @endif
                                        > English
                                        <input 
                                            type="radio" 
                                            name="txtlanguage" 
                                            value="2"
                                            @if(old('txtlanguage') == 2) checked @elseif(!empty($newsletter->language) && $newsletter->language == 2) checked @endif
                                        > Hindi
                                    </div>
                                    @error('txtlanguage')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label" for="newsletterTitle">Newsletter Title :</label>
                                    <span class="star">*</span>
                                    <div class="form-group position-relative">
                                        <input 
                                            type="text" 
                                            class="form-control text-dark h-58" 
                                            name="newsletterTitle"
                                            id="newsletterTitle" 
                                            value="@if(old('newsletterTitle')){{ old('newsletterTitle') }}@elseif(!empty($newsletter->title)) {{ $newsletter->title }} @else {{ '' }} @endif"
                                            placeholder="Enter Newsletter Title"
                                            required>
                                        @error('newsletterTitle')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label" for="img_file">Upload Image</label>
                                    <div class="fomr-group position-relative">
                                        <input 
                                            type="file" 
                                            name="img_file" 
                                            class="form-control text-dark h-58" 
                                            accept="" 
                                            onchange="checkImageUpload()"
                                            @if (!$newsletter)
                                                required
                                            @endif
                                        >
                                        @error('img_file')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        @if (isset($newsletter->images) && $newsletter->images != null)
                                            <img src="{{ asset($newsletter->images) }}" alt="Image" class="img-fluid mt-2" style="width: 100px; height: 100px;">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" id="pdf-upload-field">
                                <div class="form-group mb-4">
                                    <label class="label" for="pdf_file">Upload PDF</label>
                                    <div class="fomr-group position-relative">
                                        <input 
                                            id="pdf_file" 
                                            type="file" 
                                            name="pdf_file" 
                                            accept=".pdf" 
                                            class="form-control text-dark  h-58" 
                                            onchange="checkPDFUpload()"
                                            @if (!$newsletter)
                                                required
                                            @endif
                                        >

                                        @error('pdf_file')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        @if (isset($newsletter->pdf) && $newsletter->pdf != null)
                                            <a href="{{ asset($newsletter->pdf) }}" target="_blank" class="btn btn-primary mt-2">View PDF</a>
                                            
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" id="pdf-upload-field">
                                <div class="form-group mb-4">
                                    <label class="label" for="ebook_file">Upload E-Book</label>
                                    <div class="fomr-group position-relative">
                                        <input 
                                            id="ebook_file" 
                                            type="file" 
                                            name="ebook_file" 
                                            accept=".pdf" 
                                            class="form-control text-dark h-58" 
                                            onchange="checkEbookUpload()"
                                            @if (!$newsletter)
                                                required
                                            @endif
                                        >
                                        @error('ebook_file')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        @if (isset($newsletter->ebook) && $newsletter->ebook != null)
                                            <a href="{{ asset($newsletter->ebook) }}" target="_blank" class="btn btn-primary mt-2">View E-Book</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex ms-sm-3 ms-md-0">
                                <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>&nbsp;
                                <a href="{{ route('admin.newsletter.index') }}"
                                    class="btn btn-secondary text-white">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function checkImageUpload() {
            const imageFileInput = document.getElementById('img_file');
            const form = document.getElementById('newsletter-form');
            if (imageFileInput.files && imageFileInput.files[0]) {
                return true;
            } else {
                return true; // Allow the form submission even if no image is selected.
            }
        }

        function checkPDFUpload() {
            const pdfFileInput = document.getElementById('pdf_file');
            if (pdfFileInput.files && pdfFileInput.files[0]) {
                return true;
            } else {
                return true; // Allow the form submission even if no PDF is selected.
            }
        }
        function checkEbookUpload() {
            const ebookFileInput = document.getElementById('ebook_file');
            if (ebookFileInput.files && ebookFileInput.files[0]) {
                return true;
            } else {
                return true; // Allow the form submission even if no E-Book is selected.
            }
        }
    </script>
@endsection
