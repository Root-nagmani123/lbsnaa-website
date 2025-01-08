@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Media Gallery</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Gallery</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Video Gallery</h4>
            <a href="{{ route('video_gallery.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New Video</span>
                    </span>
                </button>
            </a>
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
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th> <!-- Index column header -->
                            <th class="col">Name</th>
                            <th class="col">Media Category</th>
                            <th class="col">Option</th>
                            <th class="col">Actions</th>
                            <th class="col">Page Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($media as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Display row number here -->
                            <td>{{ $item->audio_title_en }}</td>
                            <td><a href="{{ $item->video_upload }}" target="_blank">Play Video</a></td>
                            <td>
                                <button type="button" class="btn btn-outline-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-category_name="{{ $item->name }}"
                                    data-audio_title_en="{{ $item->audio_title_en }}"
                                    data-audio_title_hi="{{ $item->audio_title_hi }}"
                                    data-video_upload="{{ $item->video_upload }}">

                                    View
                                </button>
                            </td>
                            <td>
                                <div class="d-flex flex-column flex-sm-row gap-2">
                                    <a href="{{ route('video_gallery.edit', $item->id) }}"
                                        class="btn bg-success text-white btn-sm w-auto d-flex align-items-center justify-content-center mb-2 mb-sm-0"
                                        style="height: 30px;">Edit</a>
                                    <form action="{{ route('video_gallery.destroy', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-primary text-white w-auto d-flex align-items-center justify-content-center"
                                            style="height: 30px;"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>

                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="manage_video_centers" data-column="page_status"
                                        data-id="{{$item->id}}" {{$item->page_status ? 'checked' : ''}}>
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
            const video_upload = this.dataset.video_upload;

            // Extract YouTube video ID from the URL
           

            // Update modal content
            modalTitle.textContent = 'Video Gallery Details';
            modalBody.innerHTML = `
                <div>
                    <p><strong>Category Name:</strong> ${category_name}</p>
                    <p><strong>Video Title (Hindi):</strong> ${audio_title_hi}</p>
                    <p><strong>Video Title (English):</strong> ${audio_title_en}</p>
                    <p><strong>Video:</strong></p></strong> <a href="${video_upload}" target="_blanck">${video_upload}</a>
                   
                </div>`;
        });
    });
});
</script>