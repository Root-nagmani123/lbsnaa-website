@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Center</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Audio Gallery</span>
        </li>
    </ul>
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
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Audio Gallery</h4>
            <a href="{{ route('media-center.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Audio</span>
                    </span>
                </button>
            </a>
        </div>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Audio Title (English)</th>
                            <th class="col">Category</th>
                            <th class="col">Option</th>
                            <th class="col">Actions</th>
                            <th class="col">Page Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($audios as $audio)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                            <td>{{ $audio->audio_title_en }}</td>
                            <td>{{ $audio->category_name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-category_name="{{ $audio->category_name }}"
                                    data-audio_title_en="{{ $audio->audio_title_en }}"
                                    data-audio_title_hi="{{ $audio->audio_title_hi }}"
                                    data-audio_upload="{{ asset('uploads/audios/'.$audio->audio_upload) }}">
                                    View
                                </button>
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-start gap-2">
                                    <a href="{{ route('media-center.edit', $audio->id) }}"
                                        class="btn btn-success text-white btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('media-center.destroy', $audio->id) }}" method="POST"
                                        class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary text-white btn-sm"
                                            onclick="return confirm('Are you sure you want to delete?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="manage_media_centers" data-column="page_status"
                                        data-id="{{$audio->id}}" {{$audio->page_status ? 'checked' : ''}}>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal start -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tenders / Circulars Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="sliderText">Title</label>
                    <p id="sliderText"></p> <!-- Text will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderDescription">Type</label>
                    <p id="sliderDescription"></p> <!-- Description will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderDescription">publish_date</label>
                    <p id="sliderDescription"></p> <!-- Description will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderDescription">Type</label>
                    <p id="sliderDescription"></p> <!-- Description will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderImage">Image</label>
                    <img id="sliderImage" src="" width="100" /> <!-- Image will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderLanguage">Language</label>
                    <p id="sliderLanguage"></p> <!-- Language will be injected here -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-slider');
    const modalTitle = document.getElementById('staticBackdropLabel');
    const modalBody = document.querySelector('.modal-body');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Extract data from the button
            const category_name = this.dataset.category_name;
            const audio_title_en = this.dataset.audio_title_en;
            const audio_title_hi = this.dataset.audio_title_hi;
            const audio_upload = this.dataset.audio_upload;

            // Update modal content
            modalTitle.textContent = 'Tenders / Circulars Details';
            modalBody.innerHTML = `<div>
                    <p><strong>Category Name:</strong> ${category_name}</p>
                    <p><strong>Audio Title En:</strong> ${audio_title_en} </p>
                    <p><strong>Audio Title Hi:</strong> ${audio_title_hi}</p>
                    

                    <p><strong>File:</strong></p>
                        @if($audio->audio_upload)
                            @if(pathinfo($audio->audio_upload, PATHINFO_EXTENSION) == 'mp3')
                                <!-- Audio player -->
                                <audio controls class="mb-3" style="width: 100%;">
                                    <source src="{{ asset('uploads/audios/' . $audio->audio_upload) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @elseif(pathinfo($audio->audio_upload, PATHINFO_EXTENSION) == 'mp4')
                                <!-- Video player -->
                                <video controls class="img-fluid mb-3" style="width: 100px; height: 100px;">
                                    <source src="{{ asset('uploads/audios/' . $audio->audio_upload) }}" type="video/mp4">
                                    Your browser does not support the video element.
                                </video>
                            @endif
                        @endif
                    
                    </div>`;
        });
    });
});
</script>